<?
include('../header.php');
include($ROOT_DIR.'/lib/style_class.php');
//$_GET=&$HTTP_GET_VARS;
$edit_row = $db->object("cs_part", "where idx='$_GET[idx]'");

$fieldArr = explode("@", $edit_row->fieldlist);
?>

<script language="JavaScript">
<!--
function sendit() {
	var form=document.part_form;
	if(form.part_name.value=="") {
		alert("카테고리 이름을 입력해 주십시오.");
		form.part_name.focus();
	} else {
		form.submit();
	}
}

//-->
</script>

<div class="oolimbox-wrapper oolimbox-grid2">

	<article class="oolimbox-grid-box01">
		<?include('inc/category_menu_inc.php');?>
	</article>

	<article class="oolimbox-grid-box02">

		<table border="0"  width="100%">
			<tr>
				<td height="20" class='sub_titleL'><img src="../img/left_menu_2013icon3.gif" align="absmiddle" border="0" hspace="5">카테고리설정</td>
			</tr>
			<tr>
				<td height="1" bgcolor="#dddddd"></td>
			</tr>
			<tr>
				<td height="25" bgColor="white"></td>
			</tr>
			<tr>
				<td class="padding_5">
					<table  width="100%">
						<tr>
							<td>
								<!--콘텐츠출력-->
								<table width="100%">
									<form action="category_edit2_ok.php" method="post" name="part_form" enctype="multipart/form-data">
									<input type="hidden" name="hidden_part_index" value="2">
									<input type="hidden" name="idx" value="<?=$edit_row->idx;?>">
									<tr> 
										<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">

										<table width="100%">
												<tr>
												<td>
													<table width="100%">
														<tr>
															<td height="35">
															<table>
																<tr>
																	<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">2차카테고리수정</td>
																</tr>
															</table>
															</td>
														</tr>
														<tr>
															<td height="20">
																<!--도움말-->
																	<table width="100%" class='tipbox'>
																		<tr>
																			<td bgcolor="#E9F2F8">
																				<table width="100%">
																					<tr>
																						<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																					</tr>
																					<tr>
																						<td>하위카테고리설정 : 2차나 3차 카테고리의 사용 유무를 
																						결정합니다.<br>(1차 카테고리만 등록하셔도 제품등록이 가능합니다)</p>
																						<p>2, 3차 카테고리의 등록방법은 위와 동일합니다.<br><font color="#FF6600">(1차 
																						카테고리를 삭제할 경우 하위의 2,3차 카테고리도 자동으로 삭제됩니다.)</font></td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																<!--//도움말-->
															</td>
														</tr>
														<tr>
															<td height="35"></td>
														</tr>
													</table>
												</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr bgColor="white"> 
													<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>카테고리 상태</td>	
													<td class='tabletd_all tabletd_small'>&nbsp;&nbsp;<font color="#FF0000">2차 카테고리 수정</font></td>
												</tr>
												<tr bgColor="white"> 
													<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>카테고리 이름</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="part_name" type="text" class='formText' maxlength="100" size="30" value="<?=$edit_row->part_name;?>">&nbsp;&nbsp;카테고리 이름을 적어주세요(예:컴퓨터)</td>
												</tr>
												<tr bgColor="white"> 
													<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>카테고리 코드</td>
													<td class='tabletd_all tabletd_small'>&nbsp;1차 코드&nbsp;<input name="part1_code" type="text" class='formText' maxlength="20" size="10" value="<?=$edit_row->part1_code;?>" readonly <? $style->colorAlign('#666666', 0);?>><br>2차 코드&nbsp;<input name="part2_code" type="text" class='formText' maxlength="20" size="10" value="<?=$edit_row->part2_code;?>" readonly <? $style->colorAlign('#666666', 0);?>>&nbsp;&nbsp;카테고리 코드는 수정할수 없습니다.</td>
												</tr>
												<tr bgColor="white"> 
													<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>Category Display </td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input type="radio" name="part_display_check" value="0" <? if( $edit_row->part_display_check == 0 ) { echo( 'checked' ); }?>>&nbsp;미사용&nbsp;&nbsp;<input type="radio" name="part_display_check" value="1" <? if( $edit_row->part_display_check == 1 ) { echo( 'checked' ); }?>>&nbsp;사용&nbsp;&nbsp;&nbsp;(사용자 화면에 Display 유무 설정)</td>
												</tr>
												<tr bgColor="white"> 
													<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>하위 카테고리 설정</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input type="radio" name="part_low_check" value="0" <? if( $edit_row->part_low_check == 0 ) { echo( 'checked' ); }?>>&nbsp;미사용&nbsp;&nbsp;<input type="radio" name="part_low_check" value="1" <? if( $edit_row->part_low_check == 1 ) { echo( 'checked' ); }?>>&nbsp;사용&nbsp;&nbsp;&nbsp;(3차 카테고리를 등록 유무 설정)</td>
												</tr>
												<tr bgColor="white"> 
													<td width="120" height="35" align="center" bgcolor="E4E7EF" class='contenM tabletd_all'>상품 출력수량</td>
													<td class='tabletd_all tabletd_small'>&nbsp;
														<select name="goods_cnt" class='formText'>
															<? for($i=1; $i < 51; $i++) {?>
															<option value="<?=$i;?>" <? if($i==$edit_row->goods_cnt) echo('selected');?>><?=$i;?></option>
															<? }?>
														</select> ◁ 페이지당 상품출력 개수
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="120" height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>기본정렬</td>
													<td class='tabletd_all tabletd_small'>&nbsp;
														<select name="list_base_sort">
															<option value="1" <? if(1==$edit_row->list_base_sort) echo('selected');?>>이름순</option>
															<option value="2" <? if(2==$edit_row->list_base_sort) echo('selected');?>>가격낮은순</option>
															<option value="3" <? if(3==$edit_row->list_base_sort) echo('selected');?>>가격높은순</option>
															<option value="4" <? if(4==$edit_row->list_base_sort) echo('selected');?>>등록순</option>
															<option value="5" <? if(5==$edit_row->list_base_sort) echo('selected');?>>인기순</option>
														</select>
													</td>
												</tr>
												<tr bgColor="white"> 
													<td width="120" height="35" align="center"  bgcolor="E4E7EF" class='contenM tabletd_all'>URL</td>
													<td class='tabletd_all tabletd_small'>&nbsp;<input name="url" type="text" class="formText" style="width:95%" value="<?=$edit_row->url?>"><br>&nbsp;&nbsp;등록시 해당 링크로 설정됩니다.</td>
												</tr>
												</table>
											<table width="100%">
												<tr> 
													<td height="55" align="center"><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
												</tr>
											</table>
											<table width="100%">
												<tr>
													<td height="35">
													</td>
												</tr>
												<tr>
													<td>
													<table>
														<tr>
															<td class="sub_titleM"><a name="teb01"></a><img src="../img/left_menu_2013icon4.gif" align="absmiddle" border="0">필수항목 추가정보 입력</td>
														</tr>
													</table>
													</td>
												</tr>
											</table>
											<!--도움말-->
												<table width="100%" class='tipbox'>
													<tr>
														<td bgcolor="#E9F2F8">
															<table width="100%">
																<tr>
																	<td height="20"><img src="../img/tip_icon.gif" width="28" height="11" border="0"></td>
																</tr>
																<tr>
																	<td>
																		<table width="100%">
																			<tr>
																				<td height="5" colspan="2">
																					전자상거래법 상품정보제공 고시에 대한 추가정보 입력 : ※ <font color="red">공정거래위원회에서 공고한 전자상거래법 상품정보제공 고시</font>에 관한 판매상품의 필수(상세)정보 등록이 필요합니다.
																				</td>
																			</tr>
																			<tr>
																				<td class='noneoolim'>
																					<img src="../images/item_add.jpg" border="0" align="left" style="border:1px solid blue;">
																				</td>
																				<td height="5" valign="top">
																					아래 상품별 고지사항 내용을 참고하여 등록하고자 하시는 상품의 추가 고지사항에 대한 필드명칭을 카테고리에서 먼저 정의를 내리실수 있습니다.<br>
																					이렇게 정의된 내용은 상품을 등록 하실때 추가필드항목에 해당 카테고리에 맞는 <font color="blue">필드명칭이 미리 등록되어 상품등록시 반복적으로 필드명칭을 입력하지
																					않도록</font> 하고 있습니다.<br> 좌측그림은 "품명 및 모델명" 으로 추가필드 명칭을 정의할 경우 하단에 상품등록 페이지에서 추가필드 항목이 자동으로 등록된 예시문입니다.<br><br>
																					전자상거래법 추가자료<br>
																					<a href="http://www.ftc.go.kr/policy/legi/legiView.jsp?lgslt_noti_no=112" target="_new">※ 공정거래위원회에서 공고한 전자상거래법 상품정보제공 고시에 관한 내용</a><br>
																					<a href="http://e-sens.co.kr/download/itemsgroupfield.hwp"><font color="red"><font color="red">※ 상품정보제공의 상품군별 추가필드 항목 알아보기</font> 
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											<!--//도움말-->
											<table width="100%">
												<tr>
													<td height="25">
													</td>
												</tr>
											</table>
											<table width="100%" class="table_all">
												<tr>
													<td width="30%" height="25" class='contenM tabletd_all' bgcolor="E4E7EF">항목이름</td>
													<td width="70% "height="25" class='contenM tabletd_all' bgcolor="E4E7EF">내용</td>
												</tr>
												<?for($i=0;$i<$DEFAULTADDFIELD;$i++){
												$fieldArr2 = explode("^||^", $fieldArr[$i]);
												?>
												<tr id="addlist" name="addlist">
													<td height="25" align="center" class='contenM tabletd_all'>
														<input type="text" name="fieldname[]" class='formText' size="20" value="<?=$fieldArr2[0]?>">
													</td>
													<td height="25" class='contenM tabletd_all'>
														<div id="comment">
														<fieldset>
															<table>
																<colgroup><col width="*" /><col width="131" /></colgroup>
																<tbody>
																	<tr>
																		<td><div class="box" style='height:50px'><textarea name="fielddata[]" style='height:50px'><?=$fieldArr2[1]?></textarea></div></td>
																	</tr>
																</tbody>
															</table>
														</fieldset>
														</div>
													</td>
												</tr>
												<?}?>
											</table>
											<table width="100%">
												<tr> 
													<td height="55" align="center"><a href="javascript:sendit();" class='oolimbtn-botton1'>등록</a></td>
												</tr>
											</table>
										</td>
									</tr>
									</form>
								</table>
								<!--콘텐츠출력-->
							</td>
						</tr>
						<tr>
							<td height="30"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</article>
	
</div>



<? include('../footer.php'); ?>
