<?
include('../../common.php');

if( !$_SESSION["ADMIN_USERID"] || !$_SESSION["ADMIN_PASSWD"]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
$shop_link = $db->object("cs_admin", "", "shop_domain, shop_name");
$admin_stat = $db->object("cs_admin", "");
$design_stat = $db->object("cs_design", "");

$fl_name = explode("/",$_SERVER["SCRIPT_NAME"]); 
$arr_no = count($fl_name)-2;

?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>『 <?=$shop_link->shop_name;?> 쇼핑몰 관리자 페이지』</title>
<LINK REL="stylesheet" HREF="../css/admin_style.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../css/joinform_layout.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../css/joinform_style.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../../lib/oolim_button_style.css" TYPE="TEXT/CSS">
<LINK REL="stylesheet" HREF="../css/calendar_add_poll.css" TYPE="TEXT/CSS">


<script type="text/javascript" src="../../lib/jquery.min.js"></script>
<script type="text/javascript" src="../../lib/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../../lib/jquery.lightbox.js"></script>
<script type="text/javascript">
	function lightboxLoad(){
		jQuery(function() {
			jQuery("a[rel=lightbox]").slightbox();
		});
	}
	lightboxLoad();
</script>

<script type="text/javascript" language="javascript" src="../../cheditor/cheditor.js"></script>
<script type="text/javascript" language="javascript" src="../../lib/flash.js"></script>

<!--상단메뉴-->
<link rel="stylesheet" type="text/css" href="../css/component.css" />
<script src="../js/flaunt.js"></script> 
<!--상단메뉴-->

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

//서브메뉴 설정
function menu_view() {
	if(document.all.menu1.style.display=="") {
		view_flag	=	"none";
	} else {
		view_flag	=	"";
	}
	document.all.menu1.style.display	=	view_flag;
	document.all.menu2.style.display	=	view_flag;
	document.all.menu3.style.display	=	view_flag;
	document.all.btn_off.style.display	=	view_flag;
	(view_flag)?document.all.btn_on.style.display="":document.all.btn_on.style.display="none";
}

//-->
</script>
<script language="JavaScript">
<!--
function na_open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
  toolbar_str = toolbar ? 'yes' : 'no';
  menubar_str = menubar ? 'yes' : 'no';
  statusbar_str = statusbar ? 'yes' : 'no';
  scrollbar_str = scrollbar ? 'yes' : 'no';
  resizable_str = resizable ? 'yes' : 'no';
  window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}

// -->
</script>
<script language="JavaScript">
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;

//서브메뉴 전체 열기
function open_cenlayer(value) {
	document.all[value].style.visibility='visible';
}
//서브메뉴 전체 닫기
function close_cenlayer(value) {
	document.all[value].style.visibility='hidden';
}
//숫자만 입력받도록하기
function onlyNumber(event) { 
	var key = window.event ? event.keyCode : event.which;     

	if ((event.shiftKey == false) && ((key  > 47 && key  < 58) || (key  > 95 && key  < 106) 
	|| key  == 35 || key  == 36 || key  == 37 || key  == 39 || key  == 9  // 방향키 좌우,home,end,tab   
	|| key  == 8  || key  == 46 ) // del, back space 
	) { 
		return true; 
	}else { 
		return false; 
	}     
}; 
</script>

<style type="text/css"> 
#BoxCenter { width:100%;}
#Main_cont3 { width:100%; background-color:#495164;} 
#Main_cont4 { width:100%; background-color:#495164;text-align: center;} 
</style> 


<!-- 모달팡업창 -->
<script src="../js/modal_js/jquery.rimodal.js"></script>
<link rel="stylesheet" href="../css/modal_css/jquery.rimodal.css">

<!--모달팝업창-->
<script>
	$(document).riModal({delegate:'.modal'});
	var logElement = $('#Log').get(0);
	function logFiring(text, props) {
		return function(event) {
			if (props && event.data) {
				console.log('event.data =', event);
			}
			logElement.innerHTML += 'Fired `' + text + '` event<br>';
		};
	}
	var example4 = new $.RiModal({
		text: '',
		ajax: function() {
			return 'index.php';
		},
		width: 300,
		height: 200,
		cover: false,
		draggable: true,
		destroy_on_close: false
	});
	example4
	.on('Init', logFiring('Init'))
	.on('Rendered', logFiring('Rendered'))
	.on('Calculated', logFiring('Calculated', ['size']))
	.on('Opening', logFiring('Opening'))
	.on('Opened', logFiring('Opened'))
	.on('Loading', logFiring('Loading'))
	.on('Loaded', logFiring('Loaded'))
	.on('Dragging', logFiring('Dragging', ['mousedown']))
	.on('Dragged', logFiring('Dragged', ['mouseup']))
	.on('Resizing', logFiring('Resizing', ['size']))
	.on('Resized', logFiring('Resized', ['size']))
	.on('Closing', logFiring('Closing'))
	.on('Closed', logFiring('Closed'))
	;
	$('#TextExample').on('click', function(evt) {
		evt.preventDefault();
		example4.open();
	});
</script>
<!--모달팝업창 End-->
</head>
<body>
<iframe src='' name='dynamic' style="display:none"></iframe>

<div id="BoxCenter">
<div id="Main_cont4">
<table width='100%'>
<tr>
	<td width='50%' align='left' style='padding-left:30px; padding-top:10px;padding-bottom:10px;'><a href="../basic/main.php"><img src="../img/top_logo.gif" border="0"></a></td>
	<td width='50%' align='right' style='padding-right:30px;'>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td STYLE='float:right; padding-right:10px'>				
				<!---------상단 가이드 메뉴--------->
				<a href="../basic/main.php" title="메인페이지 이동"  class='btn_guide1 noneoolim'>관리자메인</a><a href="http://<?=$shop_link->shop_domain;?>" target="_new" title="내 쇼핑몰 바로가기"  class='btn_guide1'>쇼핑몰바로가기</a><a href="../admin_login_ok.php?logout=1" title="로그아웃" class='btn_guide2'>로그아웃</a>
				<!---------상단 가이드 메뉴--------->
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</div>


<!-- Nav -->
<nav class="nav">
<ul class="nav-list">

		<li class='nav-item'><a href='../basic/basic_setup.php' class='cbp-tm-menu_linkM'>기본설정</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../basic/basic_setup.php'>관리자기본정보설정</a></li>
				<li class="nav-submenu-item"><a href='../basic/account_page.php'>결제시스템설정</a></li>
				<li class="nav-submenu-item"><a href='../basic/delivery.php'>배송설정</a></li>
				<?/*<li class="nav-submenu-item"><a href='../basic/overexpress.php'>도서산간지역</a></li>//오픈마켓에서는 사용안함*/?>
				<li class="nav-submenu-item"><a href='../basic/basic_setup_member.php'>회원부가설정</a></li>
				<li class="nav-submenu-item"><a href='../basic/etc.php'>기타설정</a></li>
				<li class="nav-submenu-item"><a href='../basic/agreement.php'>이용약관</a></li>
				<li class="nav-submenu-item"><a href='../basic/memberinfoadmin.php'>개인정보보호정책</a></li>
				<li class="nav-submenu-item"><a href='../basic/smspage.php'>SMS관리</a></li>
				<li class="nav-submenu-item"><a href='../basic/sms_list.php'>SMS문구관리</a></li>
				<li class="nav-submenu-item"><a href='../basic/securitypage.php'>보안서버설정</a></li>
			</ul>
		</li>


		<li class="nav-item"><a href='../design/display.php' class='cbp-tm-menu_linkM'>디자인설정</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../design/display.php'>웹브라우저 타이틀 관리</a></li> 
				<li class="nav-submenu-item"><a href='../design/design.php'>로고 및 ICO파일 관리</a></li>
				<li class="nav-submenu-item"><a href='../design/main_flash.php'>이벤트 설정</a></li>
				<li class="nav-submenu-item"><a href='../design/popup.php'>팝업창관리</a></li>
				<li class="nav-submenu-item"><a href='../design/icon_list.php'>SNS아이콘관리 </a></li>
				<li class="nav-submenu-item"><a href='../design/content.php'>SNS설정 </a></li>
				<li class="nav-submenu-item"><a href='../design/banner.php'>배너관리</a></li>
			</ul>
		</li>


		<li class="nav-item"><a href='../bbs/bbs_admin.php' class='cbp-tm-menu_linkM'>게시판설정</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../bbs/bbs_admin.php'>게시판 관리</a></li>
				<li class="nav-submenu-item"><a href='../bbs/content.php'>게시판SNS설정</a></li>
			</ul>
		</li>


		<li class="nav-item"><a href='../other/qna.php' class='cbp-tm-menu_linkM'>후기 및 문의관리</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../other/review.php'>구매후기</a></li>
				<li class="nav-submenu-item"><a href='../other/qna.php'>상품 문의</a></li>
			</ul>
		</li>



		<li class="nav-item"><a href='../order/trade.php?trade_stat=1' class='cbp-tm-menu_linkM'>주문관리</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../order/trade.php?trade_stat=1'>결제대기</a></li>
				<li class="nav-submenu-item"><a href='../order/trade.php?trade_stat=2'>결제확인</a></li>
				<li class="nav-submenu-item"><a href='../order/trade.php?trade_stat=3'>작업물 전송</a></li>
				<li class="nav-submenu-item"><a href='../order/trade.php?trade_stat=4'>판매완료</a></li>
				<li class="nav-submenu-item"><a href='../order/trade.php?trade_stat=5'>취소요청</a></li>
				<li class="nav-submenu-item"><a href='../order/trade.php?trade_stat=51'>환불대기</a></li>
				<li class="nav-submenu-item"><a href='../order/trade.php?trade_stat=52'>환불완료</a></li>
				<li class="nav-submenu-item"><a href='../order/trade.php'>전체검색</a></li>
			</ul>
		</li>



		<li class="nav-item"><a href='../category/category_list.php' class='cbp-tm-menu_linkM'>샵 카테고리/상단 메뉴설정</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../category/navigation.php'>주메뉴관리</a></li>
				<li class="nav-submenu-item"><a href='../category/menudesign.php'>주메뉴 디자인 관리</a></li>
				<li class="nav-submenu-item"><a href='../category/category_list.php'>카테고리 등록&목록</a></li>
				<li class="nav-submenu-item"><a href='../category/category_ranking.php'>카테고리 순위</a></li>
				<li class="nav-submenu-item"><a href='../category/specialcate.php'>스패셜카테고리목록</a></li>
				<li class="nav-submenu-item"><a href='../category/page.php'>HTML페이지관리</a></li>
			</ul>
		</li>



		<li class="nav-item"><a href='../product/product_list.php' class='cbp-tm-menu_linkM'>상품 관리</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../product/product_list.php'>상품목록</a></li>
				<li class="nav-submenu-item"><a href='../product/product_add.php'>상품등록</a></li>
				<li class="nav-submenu-item"><a href='../product/product_total.php'>상품통합관리</a></li>
				<li class="nav-submenu-item"><a href='../product/product_move.php'>상품이동.복사.삭제</a></li>
				<li class="nav-submenu-item"><a href='../product/icon_list.php'>상품아이콘관리</a></li>
				<li class="nav-submenu-item"><a href='../product/icon_list.php?code=2'>가격대체아이콘</a></li>
			</ul>
		</li>


		<li class="nav-item"><a href='../member/member.php' class='cbp-tm-menu_linkM'>회원관리</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../member/member.php'>회원관리</a></li>
				<li class="nav-submenu-item"><a href='../member/user_list.php'>회원등급</a></li>
				<li class="nav-submenu-item"><a href='../member/mailform.php'>메일폼설정</a></li>
				<li class="nav-submenu-item"><a href='../member/groupmail.php'>그룹메일발송</a></li>
			</ul>
		</li>

		<li class="nav-item"><a href='../wallet/wallet_settle.php' class='cbp-tm-menu_linkM'>출금 신청 내역</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../wallet/wallet_settle.php'>출금 신청 내역</a></li>
			</ul>
		</li>

		<li class="nav-item"><a href='../stat/crm0.php' class='cbp-tm-menu_linkM'>통계관리</a>
			<ul class="nav-submenu">
				<li class="nav-submenu-item"><a href='../stat/crm0.php'>인기상품</a></li>
				<li class="nav-submenu-item"><a href='../stat/crm1.php'>상품별매출</a></li>
				<li class="nav-submenu-item"><a href='../stat/crm2.php'>기간별매출</a></li>
				<li class="nav-submenu-item"><a href='../stat/crm3.php'>우수고객</a></li>
				<li class="nav-submenu-item"><a href='../stat/crm4.php'>지역별통계</a></li>
				<li class="nav-submenu-item"><a href='../stat/crm5.php'>접속로그</a></li>
			</ul>
		</li>



</ul>
</nav>
<!-- /Nav -->





<table style='margin:0 auto;' width="98%">
<tr>
	<td style='padding-top:20px;'>

