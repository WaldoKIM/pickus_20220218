<?php
	include_once('./_common.php');

	/*if (!$is_member || $member['mb_level'] != "0")
		alert("회원만 가능합니다.", G5_URL);*/

	include_once('./_head.php');
	$email = $member['mb_id'];
	$sql = "select * from {$g5['estimate_match']} as a JOIN {$g5['estimate_match_propose']} AS b ON a.no_estimate = b.no_estimate JOIN g5_estimate_match_propose_detail AS c ON b.no_estimate = c.no_estimate WHERE b.rc_email = '$email' AND a.pay_confirm = 1 AND b.selected = 1 AND a.pay_confirm = 1 order by a.no_estimate desc";
	$result = sql_query($sql);

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
	@media(max-width: 768px){
		.col-md-2{width: 100%;}
	}
	.top_list{border-top: 2px solid #1379cd; background-color: #fff; margin: 20px auto; max-width: 700px;}
	.top_list th{
	    padding: 15px 0;
	    background: #eee;
	    text-align: center;
	}
	.top_list td{border-bottom: 1px solid #ddd;padding: 15px 0;
	    text-align: center;}
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
				<td><?php echo $userInfo_match['pati_qty']; ?></td>
				<td><?php echo $userInfo_match['pati_selected_sty']; ?></td>
				<td><?php echo $userInfo_match['pati_complete_qty']; ?></td>
				<td><?php echo $userInfo_match['mb_biz_score']; ?></td>
			</tr>
		</table>
		<div class="sub_title">
			<h1 class="main_co">정산내역</h1>
			<p class="tit_desc">정산내역을 확인하실 수 있습니다.</p>
		</div>
		<div class="tab_area">
			<ul class="tab">
				<li class="col-xs-6 " style="border-bottom: 1px solid #ececec  !important;">
					<a href="./history_partner.php">
						<h4>매입/철거</h4>
					</a>
				</li>
				<li class="col-xs-6 main_bg on" style="border-bottom:  1px solid #ececec !important;">
					<a href="./history_partner_match.php">
						<h4>구매</h4>
					</a>
				</li>
			</ul>
		</div>
		<a href="#." data-toggle="modal" data-target="#esti_guide" class="guide_estimate"><i class="xi-help main_co"></i> 정산 가이드</a>
		<div class="join_wrap" id="board">
			<div class="view">
				<table class="requst_list">
					<thead>
						<tr>
							<th>내역</th>
							<th>결제금액</th>
							<th>날짜</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						for ($i=0; $row=sql_fetch_array($result); $i++) {
							$price_total = $row['amt0'] + $row['amt1'] + $row['amt2'] + $row['amt3'] + $row['amt4']  + $row['amt5'] + $row['amt6'] + $row['amt7'] + $row['amt8'] + $row['amt9'] + $row['amt10'] + $row['shipping'];
							echo "<tr>";
							echo "<td style='text-align:center'>".$row['title']."</td>";
							echo "<td style='text-align:center'>".$price_total."</td>";
							echo "<td style='text-align:center'>".$row['pay_date']."</td>";
							echo "</tr>";
						} ?>
					</tbody>
				</table>
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
