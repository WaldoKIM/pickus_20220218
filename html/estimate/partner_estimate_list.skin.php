<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql_req = "update g5_notify SET read_gb = 1 where email = '{$member['mb_email']}' AND estimate_idx in (select a.estimate_idx from g5_estimate_request as a JOIN g5_estimate_list as b ON a.estimate_idx = b.idx where deadline <= now())";
sql_query($sql_req);


$sql_noti_req = "select count(*) as cnt from g5_notify where category = 'p2' AND email = '{$member['mb_email']}' AND read_gb = 0";
$sql_noti_choice = "select count(*) as cnt from g5_notify where category = 'p3' AND email = '{$member['mb_email']}' AND read_gb = 0";

$fet_noti_req = sql_fetch($sql_noti_req);
$fet_noti_choice = sql_fetch($sql_noti_choice);

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_list']} a ";
$sql_common .= " 	join {$g5['estimate_propose']} b on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}' and b.selected = '0' ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx ";
$sql_common .= " 	) c on a.idx = c.estimate_idx ";
$sql_common .= " where ";
$sql_common .= " 	a.state in ('0', '1') ";

$sql = " select count(*) as cnt " . $sql_common;

$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select
			a.*,
			b.idx as sub_idx,
			date_format(a.writetime, '%Y.%m.%d') as writetime,
			a.e_type as e_type,
			a.title,
			b.price,
			b.meet,
			b.selected,
			a.state as state,
			a.simple_yn as simple_yn ";
$sql .= "from
	{$g5['estimate_list']} a
	join {$g5['estimate_propose']} b on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}' and (b.selected = '0' OR b.selected = '2')
	left join (
		select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx
	) c on a.idx = c.estimate_idx
where
	a.state in ('0', '1')";
$sql .= " order by a.idx desc ";
$sql .= " limit 2";

$result = sql_query($sql);

$sql  = "select 
			a.idx, 
			concat(substr(a.nickname,1,1),'**') as nickname, 
			case when length(a.title) <= 20 then title else concat(substr(a.title,1,10),'...') end as title, 
			a.*,
			b.*,
			date_format(a.writetime, '%Y.%m.%d') as writetime ";
$sql .= "from {$g5['estimate_list']} a join {$g5['estimate_request']} b on a.idx = b.estimate_idx and b.rc_email = '{$member['mb_email']}'
				where
					a.idx not in (
						select estimate_idx from {$g5['estimate_propose']} where rc_email = '{$member['mb_email']}'
					)
					and state in ('1','2')";
$sql .= " order by a.idx desc ";
$sql .= " limit 2";

$result_req = sql_query($sql);

$sql_list = "select 
			idx, 
			concat(substr(nickname,1,1),'**') as nickname, 
			case when length(title) <= 20 then title else concat(substr(title,1,10),'...') end as title, 
			area1,
			area2,
			state,
			e_type,
			deadline,
			date_format(writetime, '%Y.%m.%d') as writetime 
		  from {$g5['estimate_list']} where state = '1' and simple_yn != '1' and e_type in ('0','1','2') and idx not in ( select estimate_idx from {$g5['estimate_propose']} where rc_email = '{$member['mb_email']}' ) ORDER BY idx desc limit 2";

$result_list = sql_query($sql_list);

$sql_common  = " from ";
$sql_common .= " 	{$g5['estimate_list']} a ";
$sql_common .= " 	join {$g5['estimate_propose']} b on a.idx = b.estimate_idx ";
$sql_common .= " 	left join ( ";
$sql_common .= " 		select estimate_idx, count(*) as cnt from {$g5['estimate_propose']} group by estimate_idx ";
$sql_common .= " 	) c on a.idx = c.estimate_idx ";
$sql_common .= " where ";
$sql_common .= " 	b.rc_email = '{$member['mb_email']}' ";
$sql_common .= " 	and b.selected = '1'";

$sql_select  = " select
			a.*,
			b.idx as sub_idx,
			date_format(a.writetime, '%y.%m.%d') as writetime,
			case when b.requesttime is null then '-' else date_format(b.requesttime, '%y.%m.%d') end as requesttime,
			case when b.completetime is null then '-' else date_format(b.completetime, '%y.%m.%d') end as completetime,	
			a.e_type as e_type,
			a.title,
			b.meet,
			b.price,
			a.state as state,
			a.simple_yn as simple_yn ";
$sql_select .= $sql_common;
$sql_select .= " order by a.idx desc ";
$sql_select .= " limit 2";

$result_select = sql_query($sql_select);
?>
<style type="text/css">
	.title_req{padding: 10px 0;}
	.partner_li li{border-bottom: 1px solid #ddd; font-size: 20px; padding: 10px 0;}
	.partner_li li a{width: 100%;}
	.partner_li li span{float: right; color: #999;}
	.req_lists{width:100%; display: block; overflow: hidden;}
	.req_list{width: 49%; float: left; overflow: hidden; box-shadow: 2px 3px 5px #ccc; border-radius: 20px; margin: 2% 0; padding: 15px; border:1px solid #ededed;}
	.req_list + .req_list:nth-of-type(2n){margin-left: 2%;}
	.status_req{width: 80px; text-align: center; border-radius: 20px; background-color: #1379cd; color: #fff; font-size: 12px; padding: 5px 0;}
	.esti_list .status_req div{padding-bottom: 0 !important;}
	.thumb_area{width: 20%; float: left;}
	.info_area{width: 76%; float: left; margin-left: 4%;}
	.end_req{color: #fe8e3a; font-weight: 600; font-size: 14px; margin-bottom: 5px;}
	.ea_req{line-height: 21px; font-size: 16px;}
	.btn_req{text-align: center; overflow: hidden; width: 100%; font-size: 18px; margin-top: 20px;}
	.btn_req a{background-color:#1379cd; color: #fff; text-align: center; max-width: 450px; margin: 0 auto; display: block; padding: 10px;margin-top: 20px; border-radius: 10px;}
	.btn_show_more{width: 100%; max-width: 150px; background-color: #1379cd; padding: 15px; color: #fff;}
	.member{margin-top: 20px;}
	#page{display: none;}
	#board{padding-bottom: 40px;}
		#tableList h3{border:1px solid #ededed; border-radius: 5px; padding: 10px 15px; font-size: 20px; }
		.btn_show_more{display: none;}
		.req_list{width: 100%; margin-left: 0 !important;} 
		.list_0,
		.list_1{display: none;}
		.btm_quick{z-index: 10}
		.top_list{display: none;}
	#esti_guide li{margin-bottom: 30px;}
	#esti_guide h4{margin-bottom: 10px;}
	#esti_guide strong{margin: 5px 0;display: block;}
	@media(max-width: 768px){
		
		.member{margin-top: 20px;}
	}
</style>
<a href="#." data-toggle="modal" data-target="#esti_guide" class="guide_estimate"><i class="xi-help main_co"></i> 견적참여 가이드</a>
<div class="modal fade guide" id="esti_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">견적참여 가이드</h4>
			</div>
			<div class="modal-body">
				<div>
					<ul class="row">
						<img class="web" src="/img/p_web.png">
						<img class="mobile" src="/img/p_mobile.png">
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
<div class="list esti_list" id="tableList">
	<div class="member">
		<div class="req_lists">
		<h3><a style="display:inline" href='/estimate/estimate_list2.php'>견적리스트</a></h3>
		<?php
			for ($i=0; $row_list=sql_fetch_array($result_list); $i++)
			{
				$state = $row_list['state'];
				$e_type1 = $row_list['e_type'];
				$img_path = estimate_img($row_list['idx']);
			?>
				<div class='req_list list_<?php echo $i ?>'>
					<div class='status_req'>
    					<div class='sub_tt white'><?php echo get_estimate_state($state); ?></div>
    				</div>
					<a class="subject" href='javascript:doDetailEstimate(<?php echo $row_list['idx'] ?>);'> <h4 class='title_req'><?php echo $row_list['title'] ?></h4></a>
    				<div class="thumb_area">
    				<?php echo estimate_img_thumbnail($img_path, 350, 350); ?>
    				</div>
					<div class='info_area'>
						<div class="end_req">견적마감일 : <?php 
						if(intval(strtotime($row_list['deadline'])-strtotime(date("Y-m-d"))) == 0){
							echo $row_list['date_close'];
						}else{
							echo 'D-' . intval(strtotime($row_list['deadline'])-strtotime(date("Y-m-d"))) / 86400;
						} ?></div>
						<div class="ea_req">지역 : <?php echo $row_list['area1'] . ' '. $row_list['area2'] ?></div>
						<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
					</div>
				</div>
			<?php } ?>
		</div>
			<button class="btn_show_more" onclick="location.href='/estimate/estimate_list2.php'">더보기</button>
	</div><!-- list -->	
	<div class="member">
		<h3><a href='/estimate/partner_estimate_list.php?gubun=1'>참여견적</a></h3>
		<div class="req_lists">
	<?php
		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
			$state = $row['state'];
			$e_type1 = $row['e_type'];
			$selected = $row['selected'];
			$img_path = estimate_img($row['idx']);
		?>
			<div class='req_list list_<?php echo $i ?>'>
				<div class='status_req'>
					<div class='sub_tt white'><?php 

					if($selected == 2){
						echo '<div class="status_req" style="padding-top:0;">
								<div class="sub_tt white">수거취소</div>
							</div>';
					}else{
						echo get_estimate_state($state); 
					}

					?></div>
				</div>
				<?php if($selected == 2){ ?>

				<a class="subject" href='#none'> <h4 class='title_req'><?php echo $row['title'] ?></h4></a>

				<?php }else{ ?>
					<a class="subject" href='javascript:doDetail(<?php echo $row['idx'] ?>);'> <h4 class='title_req'><?php echo $row['title'] ?></h4></a>
				<?php } ?>
				<div class="end_req">견적마감일 : <?php 
						if(intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) == 0){
							echo $row['date_close'];
						}else{
							echo 'D-' . intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) / 86400;
						} ?></div>
				<div class='info_req'>
					<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
					<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
				</div>
			</div>
		<?php } ?>
	</div>
		<button class="btn_show_more" onclick="location.href='/estimate/partner_estimate_list.php?gubun=1'">더보기</button>
		

	</div><!-- list -->
	<div class="member">
		<div class="req_lists">
		<h3><a href='/estimate/partner_estimate_list.php?gubun=3'>문의현황</a><?php echo '<span style="float : right; padding:5px;background-color:red; color:#fff;">' .$fet_noti_req['cnt'] . '<span>'; ?></h3>
	<?php
		for ($i=0; $row=sql_fetch_array($result_req); $i++)
		{
			$state = $row['state'];
			$e_type1 = $row['e_type'];
			$selected = $row['selected'];
			$img_path = estimate_img($row['idx']);
		?>
			<div class='req_list list_<?php echo $i ?>'>
				<div class='status_req'>
					<div class='sub_tt white'><?php 

					if($selected == 2){
						echo '<div class="status_req" style="padding-top:0;">
								<div class="sub_tt white">수거취소</div>
							</div>';
					}else{
						echo get_estimate_state($state); 
					}

					?></div>
				</div>
				<?php if($selected == 2){ ?>

				<a class="subject" href='#none'> <h4 class='title_req'><?php echo $row['title'] ?></h4></a>

				<?php }else{ ?>
					<a class="subject" href='javascript:doDetail(<?php echo $row['idx'] ?>);'> <h4 class='title_req'><?php echo $row['title'] ?></h4></a>
				<?php } ?>
				<div class="end_req">견적마감일 : <?php 
						if(intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) == 0){
							echo $row['date_close'];
						}else{
							echo 'D-' . intval(strtotime($row['deadline'])-strtotime(date("Y-m-d"))) / 86400;
						} ?></div>
				<div class='info_req'>
					<div class="ea_req">지역 : <?php echo $row['area1'] . ' '. $row['area2'] ?></div>
					<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
				</div>
			</div>
		<?php } ?>
	</div>
		<button class="btn_show_more" onclick="location.href='/estimate/partner_estimate_list.php?gubun=3'">더보기</button>
		
	</div><!-- list -->
	<div class="member list esti_list" id="tableList">
		<div class="req_lists">
		<h3><a href='/estimate/partner_estimate_list.php?gubun=2'>선택견적</a><?php echo '<span style="float : right; padding:5px; background-color:red; color:#fff;">' . $fet_noti_choice['cnt'] . '</span>'; ?></h3>
	<?php
		for ($i=0; $row_select=sql_fetch_array($result_select); $i++)
		{
			$state = $row_select['state'];
			$e_type1 = $row_select['e_type'];
			$img_path = estimate_img($row_select['idx']);
		?>
			<div class='req_list list_<?php echo $i ?>'>
				<div class='status_req'>
					<div class='sub_tt white' style="padding-bottom: 0;"><?php 
					if($e_type1==2 && $state == 4){
						echo '철거중';
					}else if($e_type1==2 && $state == 5){
						echo '철거완료';
					}else{
						echo get_estimate_state($state);
					}?></div>
				</div>
				<a class="subject" href='javascript:doDetail(<?php echo $row_select['idx'] ?>);'> <h4 class='title_req'><?php echo $row_select['title'] ?></h4></a>
				<div class="end_req">견적마감일 : <?php 
						if(intval(strtotime($row_select['deadline'])-strtotime(date("Y-m-d"))) == 0){
							echo $row_select['date_close'];
						}else{
							echo 'D-' . intval(strtotime($row_select['deadline'])-strtotime(date("Y-m-d"))) / 86400;
						} ?></div>
				<div class='info_req'>
					<div class="ea_req">지역 : <?php echo $row_select['area1'] . ' '. $row_select['area2'] ?></div>
					<div class="ea_req">분류 : <?php echo get_etype($e_type1); ?></div>
				</div>
			</div>
		<?php } ?>
	</div>
		<button class="btn_show_more" onclick="location.href='/estimate/partner_estimate_list.php?gubun=2'">더보기</button>
		
	</div><!-- list -->

<div id="page">
	<?php echo get_paging_estimate(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?gubun=1&&page="); ?>
</div><!-- page -->
<script type="text/javascript">
	function doDetailEstimate(idx)
{
	location.href = "estimate_form.php?idx="+idx;
}	
</script>