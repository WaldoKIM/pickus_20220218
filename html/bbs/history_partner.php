<?php
	include_once('./_common.php');

	/*if (!$is_member || $member['mb_level'] != "0")
		alert("회원만 가능합니다.", G5_URL);*/

	include_once('./_head.php');
	$email = $member['mb_id'];
	$sql = "select * from g5_estimate_list AS a JOIN g5_estimate_propose AS b ON a.idx = b.estimate_idx WHERE b.rc_email = '$email' AND b.selected = 1 order by a.idx desc";
	$result = sql_query($sql);

	$sql = " select
			a.rc_email as rc_email,
			count(*) as pati_qty,
			sum(case when a.selected = '1' then 1 else 0 end) as pati_selected_sty,
			sum(case when b.state = '5' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
			c.mb_biz_score,
			format(ifnull(c.mb_point,0),0) as mb_point
		from
			{$g5['estimate_propose']} a
			join {$g5['estimate_list']} b on a.estimate_idx = b.idx
			join {$g5['member_table']} c on a.rc_email = c.mb_email
		where
			a.rc_email = '{$member['mb_email']}'
		group by a.rc_email	 ";

	$userInfo = sql_fetch($sql);

	$sql = " select
				a.rc_email as rc_email,
				count(*) as pati_qty,
				sum(case when a.selected = '1' then 1 else 0 end) as pati_selected_sty,
				sum(case when b.state = '5' and a.selected = '1' then 1 else 0 end) as pati_complete_qty,
				c.mb_biz_score,
				format(ifnull(c.mb_point,0),0) as mb_point
			from
				{$g5['estimate_match_propose']} a
				join {$g5['estimate_match']} b on a.no_estimate = b.no_estimate
				join {$g5['member_table']} c on a.rc_email = c.mb_email
			where
				a.rc_email = '{$member['mb_email']}'
			group by a.rc_email	 ";

	$userInfo_match = sql_fetch($sql);

	$sql = "select * from g5_member where mb_email = '{$member['mb_email']}'";
	$cli_biz_info = sql_fetch($sql);
?>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.mob_back{display: none !important;}
	.requst_list{margin: 0 auto; background-color: #fff; padding: 30px;}  
	.at-body{background-color:#f4f5f9; }
	input[type=text], input[type=password], input[type=search], input[type=email], input[type=number], input[type=tel]:focus{border:0 !important;}
	.col-md-2{width: 30%;}
	.col-md-10{width: 70%;}
	.tab li{border-bottom: 3px solid #ccc !important;}
	.tab li.on a h4{color: #fff !important;}
	.tab_area{margin-bottom: 40px;}
	.tab_area .tab li{border-bottom: 1px solid #ececec; border-radius: 18px;}
	.tab_area .tab{max-width: 800px; margin: 0 auto;}
	.tab_area .tab .main_bg.on h4{color: #fff;}
	.tab_area .tab .on{background-color: #1379cd; }
	.tab_area .tab .on a{color: #fff;}
	.top_list{border-top: 2px solid #1379cd; background-color: #fff; margin: 20px auto; max-width: 700px;}
	.top_list th{
	    padding: 15px 0;
	    background: #eee;
	    text-align: center;
	}
	.top_list td{border-bottom: 1px solid #ddd;padding: 15px 0;
	    text-align: center;}
	#board .view table th{padding: 15px 0;
	    background: #eee;
	    text-align: center;}
	#board .view table td{text-align: center;}
	.esti_list .req_list p{margin-bottom: 10px;}
</style>

<div class="member com_pd">
	<div class="container">
		<table class="top_list">
			<colgroup>
				<col style="width: 25%" />
				<col style="width: 25%" />
				<col style="width: 25%" />
				<col style="width: 25%" />
			</colgroup>
			<tr>
				<th>넣은 견적수</th>
				<th>견적 선택수</th>
				<th>견적 완료수</th>
				<th>평점별표</th>
			</tr>
			<tr>
				<td><?php echo $userInfo['pati_qty']; ?></td>
				<td><?php echo $userInfo['pati_selected_sty']; ?></td>
				<td><?php echo $userInfo['pati_complete_qty']; ?></td>
				<td><?php echo $userInfo['mb_biz_score']; ?></td>
			</tr>
		</table>
			
		<div class="sub_title">
			<h1 class="main_co">정산내역</h1>
			<p class="tit_desc">정산내역을 확인하실 수 있습니다.</p>
		</div>
		<div class="tab_area">
			<ul class="tab">
				<li class="col-xs-6  main_bg on"  style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_partner.php">
						<h4>매입/철거</h4>
					</a>
				</li>
				<li class="col-xs-6" style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_partner_match.php">
						<h4>구매</h4>
					</a>
				</li>
			</ul>
		</div>
		<a href="#." data-toggle="modal" data-target="#esti_guide" class="guide_estimate"><i class="xi-help main_co"></i> 정산 가이드</a>
		<div class="join_wrap esti_list" id="board">
			<div class="view">
				<?php
					for ($i=0; $row=sql_fetch_array($result); $i++)
					{
					?>
						<div class='req_list'>
							<?php 
								if(!empty($row['completetime'])){
									echo "<p>".date('Y-m-d',strtotime($row['completetime']))."</p>";
								}else if(!empty($row['selecttime'])){
									echo "<p >".date('Y-m-d' , strtotime($row['selecttime']))."</p>";
								}else{
									echo "<p>-</p>";
								}
							?>
							<!-- <h4 class='title_req subject'><?php echo $row['title'] ?></h4> -->
							<div>
								<table>
									<tr>
										<th>내역</th>
										<th>견적가</th>
										<th>업체입금가</th>
										<th>피커스지급가</th>
									</tr>
									<tr>
										<td><?php echo '매입(철거)'; ?></td>
										<td><?php echo number_format($row['price'])."원"; ?></td>
										<td><span class="main_co" style="font-weight: bold;"><?php
											if($cli_biz_info['mb_biz_charge_rate'] != 0){
												$price_amt = $row['price'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
												$last_price = $price_amt + ($price_amt / 10);
											}else{
												$last_price = $row['price'];
											}

											if($last_price == 0){
											 echo '무료수거';
											}else{
											 echo number_format(floor($last_price)) . '원';
											}
											?>
										</span></td>
										<td><?php echo '-' ?></td>
									</tr>
									<tr>
										<td><?php echo '폐기'; ?></td>
										<td><?php echo number_format($row['price_minus'])."원"; ?></td>
										<td><span class="main_co" style="font-weight: bold;">
										<?php if($cli_biz_info['mb_biz_charge_rate'] != 0){
										$price_amt = $row['price_minus'] * ($cli_biz_info['mb_biz_charge_rate'] / 100);
										$last_price = $price_amt + ($price_amt / 10);
									}else{
										$last_price = $row['price_minus'];
									}
									 echo number_format(floor($last_price)) . '원<br/>';
									?></span></td>
									<td><?php echo '-' ?></td>
									</tr>
								</table>
							</div>
						</div>
					<?php }
					if($i==0){
						echo '<p>정산 내역이 없습니다</p>';
					}
				?>
			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">정산 가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<ul class="row">
						<img class="web" src="/images/pc_history.png">
						<img class="mobile" src="/images/m_history.png">
					</ul>
					<div class="btn_wrap">
						<ul class="row">
							<li class="col-xs-4 col-xs-offset-4"><a class="line_bg" href="#" data-dismiss="modal">닫기</a></li>
						</ul>
					</div><!-- btn_wrap -->
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- 견적 가이드 -->
<?php
include_once('./_tail.php');
?>
