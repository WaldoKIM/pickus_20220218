<table width="180">
	<tr>
		<td>

			<table width="180">
			<tr>
				<td><img src="../img/admin_main.gif" border="0"></td>
			</tr>
			<tr>
				<td class='table_border1'>
					<!----------메뉴시작------->
					<table width="100%">
						<tr class='table_border1'>
							<td class='table_padding1 table_border2'>
							<table border="0" width="96%">
									<?
										$totalCnt1	= $db->cnt( cs_trade_goods, "where trade_stat<2" );
										$totalCnt2	= $db->cnt( cs_trade_goods, "where trade_stat=2" );
										$totalCnt3	= $db->cnt( cs_trade_goods, "where trade_stat=3" );
										$totalCnt4	= $db->cnt( cs_trade_goods, "where trade_stat=4" );
										$totalCnt5	= $db->cnt( cs_trade_goods, "where trade_stat=5" );
										$totalCnt51	= $db->cnt( cs_trade_goods, "where trade_stat=51" );
										$totalCnt52	= $db->cnt( cs_trade_goods, "where trade_stat=52" );
										$totalCnt	= $db->cnt( cs_trade_goods, "" );										
									?>							
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=1">결제대기</a>(<span style="color:red;"><?=$totalCnt1;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="1" bgcolor='C9CED1'></td>
								</tr>
								<tr>
									<td height="1" bgcolor='F5F5F5'></td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=2">결제확인</a>(<span style="color:red;"><?=$totalCnt2;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="1" bgcolor='C9CED1'></td>
								</tr>
								<tr>
									<td height="1" bgcolor='F5F5F5'></td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=3">배송중</a>(<span style="color:red;"><?=$totalCnt3;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="1" bgcolor='C9CED1'></td>
								</tr>
								<tr>
									<td height="1" bgcolor='F5F5F5'></td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=4">판매완료</a>(<span style="color:red;"><?=$totalCnt4;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="1" bgcolor='C9CED1'></td>
								</tr>
								<tr>
									<td height="1" bgcolor='F5F5F5'></td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=5">취소요청</a>(<span style="color:red;"><?=$totalCnt5;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="1" bgcolor='C9CED1'></td>
								</tr>
								<tr>
									<td height="1" bgcolor='F5F5F5'></td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=51">환불대기</a>(<span style="color:red;"><?=$totalCnt51;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="1" bgcolor='C9CED1'></td>
								</tr>
								<tr>
									<td height="1" bgcolor='F5F5F5'></td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php?trade_stat=52">환불완료</a>(<span style="color:red;"><?=$totalCnt52;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
								<tr>
									<td height="1" bgcolor='C9CED1'></td>
								</tr>
								<tr>
									<td height="1" bgcolor='F5F5F5'></td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>								
								<tr>
									<td height="17" class='leftmenu_icon1'><a href="../order/trade.php">전체검색</a>(<span style="color:red;"><?=$totalCnt;?></span>)</td>
								</tr>
								<tr>
									<td height="3"></td>
								</tr>
							</table>
						</td>
					</tr>
					</table>

					<!----------메뉴끝------->
				</td>
			</tr>
			</table>


		</td>
	</tr>
	<tr>
		<td height="17"></td>
	</tr>
	<tr>
		<td><? include('../lefttable.php');?></td>
	</tr>
	<tr>
		<td height="17"></td>
	</tr>
</table>
