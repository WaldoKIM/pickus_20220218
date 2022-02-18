<?php
include_once('./_common.php');


$g5['title'] = '견적신청';
include_once('./_head.php');

$gubun = $_GET['gubun'];

if(!$gubun)
	$gubun = "";
	$class_on1 = "on";
if($gubun == "1")
{
	$class_on1 = "on";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "";
}else if($gubun == "2"){
	$class_on1 = "";
	$class_on2 = "on";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "";
}else if($gubun == "3"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "on";
	$class_on4 = "";
	$class_on5 = "";
}else if($gubun == "4"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "on";
	$class_on5 = "";
}else if($gubun == "5"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "on";

}else if($gubun == "6"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "on";
	$class_on5 = "";

	/*$other = "on";*/
}else if($gubun == "7"){
	$class_on1 = "";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "on";
	$class_on5 = "";

}else{
	$class_on1 = "on";
	$class_on2 = "";
	$class_on3 = "";
	$class_on4 = "";
	$class_on5 = "";
}

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

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

?> 
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<style type="text/css">
	.member h3{width:100%}
	.row{margin: 0;}
	.tab_area{margin-bottom: 40px;}
	.tab_area .tab li{border-bottom: 1px solid #ececec; border-radius: 18px;}
	.tab_area .tab{max-width: 800px; margin: 0 auto;}
	.tab_area .tab .main_bg.on h4{color: #fff;}
	.tab_area .tab .on{background-color: #1379cd; }
	.tab_area .tab .on a{color: #fff;}
	#btn_more{display: none;}
	#tableList h3{text-align: center  !important; position: relative;}
	#tableList h3 span{position: absolute; right: 15px;}
	@media(min-width: 768px){
		#btn_more{box-shadow: none; border:0; color: transparent;}	
		#btn_more a{color: transparent;}
	}
	@media(max-width: 768px){
		.req_list{width: 100%; margin-left: 0 !important;} 
		#btn_more img{display: none;}
		.btm_quick ul li{width: 50%;}
	}
</style>
<!-- <div class="sub_title login">
	<h5>내견적현황</h5>
	<h1>피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</h1>
</div> --><!-- sub_title -->
<script type="text/javascript">
	$(".mob_back").hide();
	var gubun = "<?php echo $gubun; ?>";
	function doChangePatiGubun(v_gubun)
	{
		if(v_gubun != gubun)
		{
			location.href = "./partner_estimate_list.php?gubun="+v_gubun;
		}
	}
	function doDetail(idx)
	{
		location.href = "./partner_estimate_form.php?idx="+idx+"&&gubun="+gubun+"&&page=<?php echo $page; ?>";
	}
	function doDetail_match(no_estimate)
	{
		location.href = "./partner_estimate_match_form.php?no_estimate="+no_estimate+"&&gubun="+gubun+"&&page=<?php echo $page; ?>";
	}
</script>
<style>
	@media(max-width:1024px){
		#board{
			margin-bottom: 50% !important;
		}
	}
</style>
<!-- <div class="btm_quick">
	<ul>
		<li style="background-color: #1379cd; color: #fff;"><a href="/estimate/partner_estimate_list.php?gubun=1" style="color: #fff;">내견적현황</a></li>
		<li style="background-color: #fff;"><a href="/estimate/estimate_list2.php">견적리스트</a></li>
		<li id="btn_more"><a href="/estimate/partner_estimate_list.php?gubun=2"><img src="/img/show_more.png" title="">진행일정</a></li>
	</ul>
</div> -->
<div class="member com_pd" style="margin-top: 0;">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">견적 현황</h1>
			<p class="tit_desc">진행 여부와 견적 현황, 총 금액을 체크할 수 있습니다.</p>
		</div>
		<div id="board">
			<div class="list_info">
				<div class="tab_area">
					<div class="tab">
						<ul class="row">
							<li id="patiGubun1" class="col-xs-6 <?php echo $class_on1; ?> <?php echo $class_on2; ?> <?php echo $class_on3; ?>">
								<a href="/estimate/partner_estimate_list.php">매입/철거</a>
							</li>
							<li id="patiGubun1" class="col-xs-6 <?php echo $class_on4; ?> <?php echo $class_on5; ?>">
								<a href="/estimate/partner_estimate_list.php?gubun=6">구매</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- <div class="list_total">
					<table id="total_price">
						<tr>
							<th><h3>총 완료(누적) 금액</h3></th>
							<td><h3><strong>13,000,000원(샘플입니다.)</strong></h3></td>
						</tr>
						<tr>
							<th><h3>출금 신청 가능 금액</h3></th>
							<td><h3><strong><?php echo $userInfo['mb_point'] . '원(실제 보유포인트)'; ?></strong></h3></td>
						</tr>
					</table>
					
				</div> -->
				<?php if(isset($_GET['gubun'])){ ?>
				<?php if($_GET['gubun'] != 4 && $_GET['gubun'] != 5 && $_GET['gubun'] != 6){ ?>
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
			<?php }else{ ?>
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
			<?php } ?>
			<?php } ?>
			</div>
			<div style="display: none;" class="tab">
				<ul class="row">
					<?php if($_GET['gubun'] == 4 || $_GET['gubun'] == 5){ ?>
						<li id="patiGubun1" class="col-md-2 col-xs-6 <?php echo $class_on1; ?><?php echo $class_on4; ?><?php echo $other; ?>">
							<a href="javascript:doChangePatiGubun('4');">참여견적</a>
						</li>
					<?php }else{ ?>
						<li id="patiGubun1" class="col-md-2 col-xs-6 <?php echo $class_on1; ?><?php echo $class_on4; ?><?php echo $other; ?>">
							<a href="javascript:doChangePatiGubun('1');">참여견적</a>
						</li>
					<?php } ?>
					
					<li style="display: none;" id="patiGubun1" class="col-md-2 col-xs-6 <?php echo $class_on4; ?>">
						<a href="javascript:doChangePatiGubun('4');">중고매칭</a>
					</li>
					<li id="patiGubun3" class="col-md-2 col-xs-6 <?php echo $class_on3; ?>  ?>">
						<a href="javascript:doChangePatiGubun('3');">고객문의</a>
					</li>
					<?php if($_GET['gubun'] == 4 || $_GET['gubun'] == 5){ ?>
						<li id="patiGubun2" class="col-md-2 col-xs-6 <?php echo $class_on5; ?>">
							<a href="javascript:doChangePatiGubun('5');">선택견적</a>
						</li>
					<?php }else{ ?>
						<li id="patiGubun2" class="col-md-2 col-xs-6 <?php echo $class_on2; ?>">
							<a href="javascript:doChangePatiGubun('2');">선택견적</a>
						</li>
					<?php } ?>
				</ul>
				<br/>
			</div>
			
			<?php
				include_once('./partner_estimate_list.skin'.$gubun.'.php');
			?>
		</div><!-- board -->

	</div><!-- container -->
</div><!-- member -->

<?php

include_once('./_tail.php');
?>