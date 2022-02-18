<?
    /* ============================================================================== */
    /* =   PAGE : 결제 요청 PAGE                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* =   아래의 ※ 필수, ※ 옵션 부분과 매뉴얼을 참조하셔서 연동을   = */
    /* =   진행하여 주시기 바랍니다.                                          = */
    /* = -------------------------------------------------------------------------- = */
    /* =   연동시 오류가 발생하는 경우 아래의 주소로 접속하셔서 확인하시기 바랍니다.= */
    /* =   접속 주소 : http://kcp.co.kr/technique.requestcode.do			        = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2016  NHN KCP Inc.   All Rights Reserverd.                = */
    /* ============================================================================== */
?>
<?
    /* ============================================================================== */
    /* =   환경 설정 파일 Include                                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수                                                                  = */
    /* =   테스트 및 실결제 연동시 site_conf_inc.jsp 파일을 수정하시기 바랍니다.    = */
    /* = -------------------------------------------------------------------------- = */

     include "../cfg/site_conf_inc.php";       // 환경설정 파일 include

?>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   환경 설정 파일 Include END                                               = */
    /* ============================================================================== */
?>
<?
    /* kcp와 통신후 kcp 서버에서 전송되는 결제 요청 정보 */
    $req_tx          = $_POST[ "req_tx"         ]; // 요청 종류         
    $res_cd          = $_POST[ "res_cd"         ]; // 응답 코드         
    $tran_cd         = $_POST[ "tran_cd"        ]; // 트랜잭션 코드     
    $ordr_idxx       = $_POST[ "ordr_idxx"      ]; // 쇼핑몰 주문번호   
    $good_name       = $_POST[ "good_name"      ]; // 상품명            
    $good_mny        = $_POST[ "good_mny"       ]; // 결제 총금액       
    $buyr_name       = $_POST[ "buyr_name"      ]; // 주문자명          
    $buyr_tel1       = $_POST[ "buyr_tel1"      ]; // 주문자 전화번호   
    $buyr_tel2       = $_POST[ "buyr_tel2"      ]; // 주문자 핸드폰 번호
    $buyr_mail       = $_POST[ "buyr_mail"      ]; // 주문자 E-mail 주소
    $use_pay_method  = $_POST[ "use_pay_method" ]; // 결제 방법         
	$enc_info        = $_POST[ "enc_info"       ]; // 암호화 정보       
    $enc_data        = $_POST[ "enc_data"       ]; // 암호화 데이터     
    $cash_yn         = $_POST[ "cash_yn"        ];
    $cash_tr_code    = $_POST[ "cash_tr_code"   ];
    /* 기타 파라메터 추가 부분 - Start - */
    $param_opt_1    = $_POST[ "param_opt_1"     ]; // 기타 파라메터 추가 부분
    $param_opt_2    = $_POST[ "param_opt_2"     ]; // 기타 파라메터 추가 부분
    $param_opt_3    = $_POST[ "param_opt_3"     ]; // 기타 파라메터 추가 부분
    /* 기타 파라메터 추가 부분 - End -   */

  $tablet_size     = "1.0"; // 화면 사이즈 고정
  $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<title>유전체연합심포지엄</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="No-Cache">
<meta http-equiv="Pragma" content="No-Cache">

<meta name="viewport" content="width=device-width, user-scalable=<?=$tablet_size?>, initial-scale=<?=$tablet_size?>, maximum-scale=<?=$tablet_size?>, minimum-scale=<?=$tablet_size?>">

<link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>
<link href="css/payment.css" type="text/css" rel="stylesheet" />

<!-- 거래등록 하는 kcp 서버와 통신을 위한 스크립트-->
<script type="text/javascript" src="js/approval_key.js"></script>

<script type="text/javascript">
  var controlCss = "css/style_mobile.css";
  var isMobile = {
    Android: function() {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
      return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };

  if( isMobile.any() )
    document.getElementById("cssLink").setAttribute("href", controlCss);
</script>
<script type="text/javascript">
   /* 주문번호 생성 예제 */
  function init_orderid()
  {
    var today = new Date();
    var year  = today.getFullYear();
    var month = today.getMonth() + 1;
    var date  = today.getDate();
    var time  = today.getTime();

    if (parseInt(month) < 10)
      month = "0" + month;

    if (parseInt(date) < 10)
      date  = "0" + date;

    var order_idxx = "TEST" + year + "" + month + "" + date + "" + time;
    var ipgm_date  = year + "" + month + "" + date;

    document.order_info.ordr_idxx.value = order_idxx;
    document.order_info.ipgm_date.value = ipgm_date;
  }

   /* kcp web 결제창 호츨 (변경불가) */
  function call_pay_form()
  {
    var v_frm = document.order_info; 
    
    v_frm.action = PayUrl;

    if (v_frm.Ret_URL.value == "")
    {
	  /* Ret_URL값은 현 페이지의 URL 입니다. */
	  alert("연동시 Ret_URL을 반드시 설정하셔야 됩니다.");
      return false;
    }
    else
    {
      v_frm.submit();
    }
  }

   /* kcp 통신을 통해 받은 암호화 정보 체크 후 결제 요청 (변경불가) */
  function chk_pay()
  {
    self.name = "tar_opener";
    var pay_form = document.pay_form;

    if (pay_form.res_cd.value == "3001" )
    {
      alert("사용자가 취소하였습니다.");
      pay_form.res_cd.value = "";
    }
    
    if (pay_form.enc_info.value)
      pay_form.submit();
  }

  function jsf__chk_type()
  {
    if ( document.order_info.ActionResult.value == "card" )
    {
      document.order_info.pay_method.value = "CARD";
    }
    else if ( document.order_info.ActionResult.value == "acnt" )
    {
      document.order_info.pay_method.value = "BANK";
    }
    else if ( document.order_info.ActionResult.value == "vcnt" )
    {
      document.order_info.pay_method.value = "VCNT";
    }
    else if ( document.order_info.ActionResult.value == "mobx" )
    {
      document.order_info.pay_method.value = "MOBX";
    }
    else if ( document.order_info.ActionResult.value == "ocb" )
    {
      document.order_info.pay_method.value = "TPNT";
      document.order_info.van_code.value = "SCSK";
    }
    else if ( document.order_info.ActionResult.value == "tpnt" )
    {
      document.order_info.pay_method.value = "TPNT";
      document.order_info.van_code.value = "SCWB";
    }
    else if ( document.order_info.ActionResult.value == "scbl" )
    {
      document.order_info.pay_method.value = "GIFT";
      document.order_info.van_code.value = "SCBL";
    }
    else if ( document.order_info.ActionResult.value == "sccl" )
    {
      document.order_info.pay_method.value = "GIFT";
      document.order_info.van_code.value = "SCCL";
    }
    else if ( document.order_info.ActionResult.value == "schm" )
    {
      document.order_info.pay_method.value = "GIFT";
      document.order_info.van_code.value = "SCHM";
    }
  }
</script>
    <script type="text/javascript">
		function mny_input()
		{
			var frm = document.order_info;
			var good_mny2 = "";
			if(frm.good_name1.value==190000 && frm.good_name2.value == "Y"){
				good_mny2 = 100000;
			}else if(frm.good_name1.value==50000 && frm.good_name2.value == "Y"){
				good_mny2 = 10000;
			}
			frm.good_mny.value = Number(frm.good_name1.value)+Number(good_mny2);
		}
	</script>
</head>

<body onload="jsf__chk_type();init_orderid();chk_pay();">
<div id="sample_wrap">
<form name="order_info" method="post">
  <!-- 타이틀 -->
	<div class="title">
	   유전체 연합 심포지엄 등록
	</div>
	<div class="payform_div">
	<table class="payform_wrap" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
				<table class="payform" width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tr>
						<td>
							<table class="payform_inner" width="100%" align="center" >
								<!-- 주문번호(ordr_idxx) -->								
								<input type="hidden" name="ordr_idxx" value="" maxlength="40"/>	
								
								<!-- 상품명(good_name) -->								
								<input type="hidden" name="good_name" value="유전체 연합 심포지엄 등록비"/>
								
								<!-- 주문자명(buyr_name) -->
								<input type="hidden" name="buyr_name" value="<?=$_POST['buyr_name'];?>"/>									
								
								<!-- 주문자 E-mail(buyr_mail) -->
								<input type="hidden" name="buyr_mail"value="<?=$_POST['buyr_mail'];?>" maxlength="30" />									
								
								<!-- 주문자 연락처1(buyr_tel1) -->
								<input type="hidden" name="buyr_tel1" value="<?=$_POST['buyr_tel1'];?>"/>							
								
								<!-- 휴대폰번호(buyr_tel2) -->
								<input type="hidden" name="buyr_tel2"value="<?=$_POST['buyr_tel2'];?>"/>								
							  <tr>
								<td>
									<b>결제방법</b>
									<br/>
									<input type="radio" name="ActionResult" value="card" checked onclick="jsf__chk_type();" > 신용카드
									<input type="radio" name="ActionResult" value="acnt" onclick="jsf__chk_type();"> 계좌이체
									<input type="radio" name="ActionResult" value="vcnt" onclick="jsf__chk_type();" > 가상계좌
									<?/*	
									<select name="ActionResult" onchange="jsf__chk_type();">
										<option value="" selected>선택하십시오</option>
										<option value="card">신용카드</option>
										<option value="acnt">계좌이체</option>
										<option value="vcnt">가상계좌</option>
										<option value="mobx">휴대폰</option>
										<option value="ocb">OK캐쉬백</option>
										<option value="tpnt">복지포인트</option>
										<option value="scbl">도서상품권</option>
										<option value="sccl">문화상품권</option>
										<option value="schm">해피머니</option>
									</select>
									*/?>
									<br/><b>유전체 연합 심포지엄 등록</b>
									<br/>
									<input type="radio" name="good_name1" value="190000"  checked onclick="mny_input();"> 박사이상 일반(200,000원)
									<input type="radio" name="good_name1" value="50000" onclick="mny_input();"> 학생(50,000원)
									
									<br/><b>튜토리얼 세션 참석 여부</b>
									<br>박사이상 일반(100,000원), 학생(10,000원)
									<br/>
									<input type="radio" name="good_name2" value="Y"  checked onclick="mny_input();"> 예
									<input type="radio" name="good_name2" value="N"  onclick="mny_input();"> 아니오 

							<!-- 결제금액(good_mny) - ※ 필수 : 값 설정시 ,(콤마)를 제외한 숫자만 입력하여 주십시오. -->
									<br/><b>결제금액</b>
									<br/><input type="text" name="good_mny" class="w100" style="max-width:100px; text-align:right;" value="1000" maxlength="9" readonly />원(숫자만 입력)							

								</td>
							  </tr>
							</table>
						</td>
					</tr>				
				</table>
			</td>
		</tr>		
	</table>
	
	<!-- 결제 요청/처음으로 이미지 -->
	<div class="btnset" id="display_pay_button" style="display:block">
		<div class="paybtn">
			<input name="" type="button"  class="pay_start" value="결제요청" onclick="kcp_AJAX();" />
			<?/*<a href="../" class="back" >처음으로</a>	*/?>			
		</div>
	</div>
	<br>
  <div class="footer" style="text-align:center;">
	유전체 연합 심포지엄.
  </div>			  

</div>
						  <!--footer-->
						  <div class="footer">
							Copyright (c) NHN KCP INC. All Rights reserved.
						  </div>
						  <!--//footer-->
						  
						  <!-- 공통정보 -->
						  <input type="hidden" name="req_tx"          value="pay">                           <!-- 요청 구분 -->
						  <input type="hidden" name="shop_name"       value="<?= $g_conf_site_name ?>">      <!-- 사이트 이름 --> 
						  <input type="hidden" name="site_cd"         value="<?= $g_conf_site_cd   ?>">      <!-- 사이트 코드 -->
						  <input type="hidden" name="currency"        value="410"/>                          <!-- 통화 코드 -->
						  <input type="hidden" name="eng_flag"        value="N"/>                            <!-- 한 / 영 -->
						  <!-- 결제등록 키 -->
						  <input type="hidden" name="approval_key"    id="approval">
						  <!-- 인증시 필요한 파라미터(변경불가)-->
						  <input type="hidden" name="escw_used"       value="N">
						  <input type="hidden" name="pay_method"      value="">
						  <input type="hidden" name="van_code"        value="">
						  <!-- 신용카드 설정 -->
						  <input type="hidden" name="quotaopt"        value="12"/>                           <!-- 최대 할부개월수 -->
						  <!-- 가상계좌 설정 -->
						  <input type="hidden" name="ipgm_date"       value=""/>
						  <!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다.(필수 설정) -->
						  <input type="hidden" name="shop_user_id"    value=""/>
						  <!-- 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.(필수 설정) -->
						  <input type="hidden" name="pt_memcorp_cd"   value=""/>
						  <!-- 현금영수증 설정 -->
						  <input type="hidden" name="disp_tax_yn"     value="Y"/>
						  <!-- 리턴 URL (kcp와 통신후 결제를 요청할 수 있는 암호화 데이터를 전송 받을 가맹점의 주문페이지 URL) -->
						  <input type="hidden" name="Ret_URL"         value="<?=$url?>">
						  <!-- 화면 크기조정 -->
						  <input type="hidden" name="tablet_size"     value="<?=$tablet_size?>">

						  <!-- 추가 파라미터 ( 가맹점에서 별도의 값전달시 param_opt 를 사용하여 값 전달 ) -->
						  <input type="hidden" name="param_opt_1"     value="">
						  <input type="hidden" name="param_opt_2"     value="">
						  <input type="hidden" name="param_opt_3"     value="">

						<?
							/* ============================================================================== */
							/* =   옵션 정보                                                                = */
							/* = -------------------------------------------------------------------------- = */
							/* =   ※ 옵션 - 결제에 필요한 추가 옵션 정보를 입력 및 설정합니다.             = */
							/* = -------------------------------------------------------------------------- = */
							/* 카드사 리스트 설정
							예) 비씨카드와 신한카드 사용 설정시
							<input type="hidden" name='used_card'    value="CCBC:CCLG">

							/*  무이자 옵션
									※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다)                             - "" 로 설정
									※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다)                           - "N" 로 설정
									※ 무이자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다)   - "Y" 로 설정
							<input type="hidden" name="kcp_noint"       value=""/> */

							/*  무이자 설정
									※ 주의 1 : 할부는 결제금액이 50,000 원 이상일 경우에만 가능
									※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용
									예) BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04
							<input type="hidden" name="kcp_noint_quota" value="CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09"/> */

							/* KCP는 과세상품과 비과세상품을 동시에 판매하는 업체들의 결제관리에 대한 편의성을 제공해드리고자, 
							   복합과세 전용 사이트코드를 지원해 드리며 총 금액에 대해 복합과세 처리가 가능하도록 제공하고 있습니다
							   복합과세 전용 사이트 코드로 계약하신 가맹점에만 해당이 됩니다
							   상품별이 아니라 금액으로 구분하여 요청하셔야 합니다
							   총결제 금액은 과세금액 + 부과세 + 비과세금액의 합과 같아야 합니다. 
							   (good_mny = comm_tax_mny + comm_vat_mny + comm_free_mny)
							
								<input type="hidden" name="tax_flag"       value="TG03">  <!-- 변경불가	   -->
								<input type="hidden" name="comm_tax_mny"   value=""    >  <!-- 과세금액	   --> 
								<input type="hidden" name="comm_vat_mny"   value=""    >  <!-- 부가세	   -->
								<input type="hidden" name="comm_free_mny"  value=""    >  <!-- 비과세 금액 --> */
							/* = -------------------------------------------------------------------------- = */
							/* =   옵션 정보 END                                                            = */
							/* ============================================================================== */
						?>

	</form>
</div>

<form name="pay_form" method="post" action="pp_cli_hub.php">
    <input type="hidden" name="req_tx"         value="<?=$req_tx?>">               <!-- 요청 구분          -->
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">               <!-- 결과 코드          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">              <!-- 트랜잭션 코드      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">            <!-- 주문번호           -->
    <input type="hidden" name="good_mny"       value="<?=$good_mny?>">             <!-- 휴대폰 결제금액    -->
    <input type="hidden" name="good_name"      value="<?=$good_name?>">            <!-- 상품명             -->
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">            <!-- 주문자명           -->
    <input type="hidden" name="buyr_tel1"      value="<?=$buyr_tel1?>">            <!-- 주문자 전화번호    -->
    <input type="hidden" name="buyr_tel2"      value="<?=$buyr_tel2?>">            <!-- 주문자 휴대폰번호  -->
    <input type="hidden" name="buyr_mail"      value="<?=$buyr_mail?>">            <!-- 주문자 E-mail      -->
	<input type="hidden" name="cash_yn"		   value="<?=$cash_yn?>">              <!-- 현금영수증 등록여부-->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">
    <input type="hidden" name="use_pay_method" value="<?=$use_pay_method?>">
    <input type="hidden" name="cash_tr_code"   value="<?=$cash_tr_code?>">

    <!-- 추가 파라미터 -->
	<input type="hidden" name="param_opt_1"	   value="<?=$param_opt_1?>">
	<input type="hidden" name="param_opt_2"	   value="<?=$param_opt_2?>">
	<input type="hidden" name="param_opt_3"	   value="<?=$param_opt_3?>">
</form>
</body>
</html>
