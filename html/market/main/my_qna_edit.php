<? include('./include/head.inc.php');?>
<? include($ROOT_DIR.'/lib/page_class.php');
//게시판에 필요한 값들
$MV_DATA	= $_GET[board_data];
$BOARD_DATA	= $tools->decode( $_GET[board_data] );
if($_GET[idx] )					{ $idx = $_GET[idx]; }					else { $idx = $BOARD_DATA[idx]; }
if($_GET[listNo] )				{ $listNo = $_GET[listNo]; }			else { $listNo = $BOARD_DATA[listNo]; }
if($_GET[startPage] )			{ $startPage = $_GET[startPage]; }		else { $startPage	= $BOARD_DATA[startPage]; }
if($_GET[totalList] )			{ $totalList = $_GET[totalList]; }		else { $totalList	= $BOARD_DATA[totalList]; }
$MV_SEARCH_ITEM	= $_GET[search_items];
$SEARCH_ITEM	= $tools->decode( $_GET[search_items] );
if($_GET[code] )			{ $code = $_GET[code]; }		else { $code = $SEARCH_ITEM[code]; }
if($_GET[search_item] )			{ $search_item = $_GET[search_item]; }		else { $search_item	= $SEARCH_ITEM[search_item]; }
if($_GET[search_order] )			{ $search_order = $_GET[search_order]; }		else { $search_order	= urldecode($SEARCH_ITEM[search_order]); }
if($_GET[boardT] )			{ $boardT = $_GET[boardT]; }		else { $boardT = $_POST[boardT]; }
if($_GET[goods_idx] )			{ $goods_idx = $_GET[goods_idx]; }		else { $goods_idx = $SEARCH_ITEM[goods_idx]; }
$SEARCH_DATA = $tools->encode("search_item=".$search_item."&search_order=".urlencode($search_order)."&goods_idx=".$goods_idx);
$review=$db->object("cs_goods_qna", "where idx='$idx'");
?>
<? include('./include/top_menu.inc.php');?>
<!-- // 상단테이블 끝-->
<script language="JavaScript">
<!--
function sendit() {
	var form=document.review_form;
	if(form.name.value=="") {
		alert("이름을 입력해 주십시오.");
		form.name.focus();
	}else if(form.title.value=="") {
		alert("제목을 입력해 주십시오.");
		form.title.focus();
	} else if( form.content.value=="") {
		alert("내용을 입력해 주십시오.");
		form.content.focus();
	} else {
		form.submit();
	}
}
//-->
</script>
<div class="site-wrapper" id="box_wrapper">
	<!--상단로고, 가이드메뉴-->
	<? include('./include/top_guide.inc.php');?>
	<!--상단메뉴, 로테이트베너-->
	<? include('./include/top_menu.inc.php');?>
		<!--페이지 위치-->
		<div class="my_location">
			<ol class="breadcrumb titletxt_B">
				<li><a href="index.php" class="titletxt_A">Home</a></li>
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>마이페이지</li>				
				<li class="arrow"><i class="fas fa-angle-right"></i></li>
				<li><i class="fas fa-arrow-left"></i>상품문의</li>
			</ol>
		</div>
		<!--//페이지 위치-->
	</section>
	<!--컨텐츠 출력1 시작-->
	<section id="blog" class="section order_check login_check_area">
		<div class="container-fluid">
			<div class="row">
				<div class="to_animate">
					<!--********************내용영역 출력 시작********************-->
					<!--페이지서브메뉴-->
					<? include('./include/mymenu.inc.php');?>
					<!--페이지서브메뉴-->
					<div class="main">
						<h2 class="tit">상품문의</h2>
						
						<form name="review_form" action="my_qna_edit_ok.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="board_data" value="<?=$MV_DATA;?>">
						<table width="100%">
							<tr>
								<td width="7" colspan="2" height="2" bgColor='#333333'></td>
							</tr>
							<tr bgColor="white"<?if($_SESSION[USERID]){?> style="display:none"<?}?>>
								<td width='20%' height="65" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>이 름</td>
								<td height="45" style="padding-left:3px" align="left"><input type="text" name="name" class="formText" maxlength="15" value="<?=$review->name?>"><br>(예 : 홍길동)</td>
							</tr>
							<?if(!$_SESSION[USERID]){?>
							<tr>
								<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
							</tr>
							<?}?>
							<tr bgColor="white"<?if($_SESSION[USERID]){?> style="display:none"<?}?>>
								<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀번호</td>
								<td height="45" style="padding-left:3px" align="left"><input type="password" name="pwd" class="formText"><br>(수정 및 삭제시 필요합니다)</td>
							</tr>
							<?if(!$_SESSION[USERID]){?>
							<tr>
								<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
							</tr>
							<?}?>
							<tr bgColor="white">
								<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>비밀글</td>
								<td height="45" style="padding-left:3px" align="left" class='email'><input type="checkbox" name="hold" value="1" <?if($review->hold==1){?>checked<?}?>> <img src="images/key_icon2.gif" border="0"></td>
							</tr>
							<tr>
								<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
							</tr>
							<tr bgColor="white">
								<td width='20%' height="45" align="center" bgcolor="#F2F2F2" class='oolimmobilemenuM'>제 목</td>
								<td height="45" style="padding-left:3px" align="left" class='email'><input type="text" name="title" class="formText formText_subject" value="<?=$review->title?>"></td>
							</tr>
							<tr>
								<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
							</tr>
							<tr bgColor="white">
								<td width="'20%'" align="center" bgcolor="F4F4F4" class="bbs2">내용</td>
								<td>
									<div id="comment">
									<fieldset>
										<table>
											<colgroup><col width="*" /><col width="131" /></colgroup>
											<tbody>
												<tr>
													<td><div class="box"><textarea name="content"  class="formText box"><?=$review->content?></textarea></div></td>
												</tr>
											</tbody>
										</table>
									</fieldset>
									</div>
								</td>
							</tr>
							<tr>
								<td width="7" colspan="2" height="1" bgColor='#dddddd'></td>
							</tr>
						</table>
						<table width="100%" border="0">
							<tr>
								<td align='center' style="padding-top:15px;">
									<div id='btncenter_warp'>
										<div class='btncenter_container'>
											<a href="javascript:sendit();" class='oolimbtn-botton2'>글쓰기</a>
											<a href="javascript:history.go(-1);" class='oolimbtn-botton3'>취소</a>
										</div>
									</div>
								<tr>
							</tr>
						</table>
						</form>
					</div>
					<!--********************내용영역 출력 끝********************-->
				</div><!--to_animate-->
			</div><!--row-->
		</div><!--container-->
	</section>
	<!--컨텐츠 출력2 End-->
	<!--하단-->
	<? include('./include/footer.inc.php');?>
	<!--하단-->
</div><!--site-wrapper End-->