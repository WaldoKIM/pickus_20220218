<?php
include_once('./_common.php');

if (!$is_member || $member['mb_level'] != "2")
	alert("회원만 가능합니다.", G5_URL);

include_once('./_head.php');

?>
<style type="text/css">
	#fregisterform{max-width: 585px; margin: 0 auto; background-color: #fff; padding: 30px; border-top: 0;} 
	.at-body{background-color: #f4f5f9;}
	input[type="button"]{margin-top: 0;}
	.form-group{border-bottom: 0;}
	.col-xs-4{padding: 0;}
	#divGoodsItem .col-md-2, #divGoodsItem .col-md-4{width: 20%;}
	@media(max-width: 480px){
		.full_mobile,
		.full_mobile p,
		.full_mobile .col-xs-4,
		.full_mobile .text-right{width: 100%}
		#divGoodsItem .col-md-2, #divGoodsItem .col-md-4{width: 100% !important;}
	}
	@media(max-width:1024px){
		.header{
			display:none !important;
		}
	}

	/*마이페이지이동버튼*/
.mypage_btn_header{
	display: none;
}

@media(max-width:1024px){
	.mypage_btn_header{
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		align-items: center;
		padding: 4% 5%;
		border-bottom: 1px solid #ddd;
		color: #666 !important;
		font-family: nanumsquare;
		background: #fff;
	}

	.back_btn{
		position: absolute;
	}

	.back_btn > img{
		width: 25px;
	}

	.title{
		width: 100%;
		font-size: 18px;
		font-weight: bold;
		text-align: center;
	}
	.sub_title{
		display: none;
	}
}
/*마이페이지이동버튼끝*/
</style>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<link rel="stylesheet" type="text/css" href="/css/member.css"/>
<div class="mypage_btn_header">
    <a href="javascript:history.back();" class="back_btn"><img src="../img/back.png" alt=""></a>
    <div class="title">후기내역</div>
</div>
<div class="member com_pd">
	<div class="container">
		<div class="sub_title">
			<h1 class="main_co">후기내역</h1>
			<p class="tit_desc">피커스의 차별화된 서비스를 더욱 편리하게 이용하실 수 있습니다.</p>
		</div>
		<div class="join_wrap">
			<div class="form_wrap">
				
				<form id="fregisterform" name="fregisterform" action="/bbs/mypage_update.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="u">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" id="mb_biz_type" name="mb_biz_type" value="<?php echo $member['mb_biz_type'];?>">
					<input type="hidden" id="mb_level" name="mb_level" value="<?php echo $member['mb_level'];?>">		
					<input type="hidden" id="mb_id" name="mb_id" value="<?php echo $member['mb_id'];?>">
					<input type="hidden" id="mb_name" name="mb_name" value="<?php echo $member['mb_name'];?>">					
					<input type="hidden" id="mb_biz_name" name="mb_biz_name" value="<?php echo $member['mb_biz_name'];?>">					
					<input type="hidden" id="mb_email" name="mb_email" value="<?php echo $member['mb_email'];?>">					
					<input type="hidden" id="mb_password" name="mb_password">
					<input type="hidden" id="mb_password_type" name="mb_password_type" value="<?php echo $member['mb_password_type'];?>">			
					<input type="hidden" id="mb_biz_goods_item" name="mb_biz_goods_item" value="<?php echo $member['mb_biz_goods_item'];?>">
					<input type="hidden" id="mb_biz_goods_year" name="mb_biz_goods_year" value="<?php echo $member['mb_biz_goods_year'];?>">
					<input type="hidden" id="mb_biz_remove_item" name="mb_biz_remove_item" value="<?php echo $member['mb_biz_remove_item'];?>">
					<input type="hidden" id="mb_biz_remove_etc" name="mb_biz_remove_etc" value="<?php echo $member['mb_biz_remove_etc'];?>">
					<input type="hidden" id="mb_biz_charge_rate" name="mb_biz_charge_rate" value="<?php echo $member['mb_biz_charge_rate'];?>">
					<div class="form-group">
						<ul class="tab">
							<li class="col-xs-6">
								<a href="/bbs/mypage_partner.php">마이페이지</a>
							</li>
							<li class="col-xs-6 on">
								<a href="./mypage_review.php">후기내역</a>
							</li>
						</ul>
					</div>
					<?php 
						$sql = " select
									a.rc_email,
									round(avg(a.score),1) as score,
									round(avg(a.score)/5 * 100,0) as rate,
									count(*) as cnt
								from 
									g5_estimate_propose a
									join g5_estimate_list b on a.estimate_idx = b.idx
								where 
									ifnull(a.review,'') !=  '' 
									and a.rc_email = '{$member['mb_email']}'
								group by a.rc_email ";

						$score_row = sql_fetch($sql);

						$review_cnt = $score_row['cnt'];
						$score = $score_row['score'];
						$sql = " select
									a.idx,
									a.estimate_idx,
									b.e_type,
									b.item_cat,
									concat(substr(a.nickname,1,1),'**') AS nickname,
									b.area1,
									b.area2,
									a.score,
									b.goods_state,
									b.title,
									a.review,
									date_format(a.updatetime,'%Y.%m.%d') as updatetime,
									case when ifnull(a.review,'') !=  ''  then 'Y' else 'N' end as reviewYn
								from 
									g5_estimate_propose a
									join g5_estimate_list b on a.estimate_idx = b.idx
								where 
									ifnull(a.review,'') !=  '' 
									and a.rc_email = '{$member['mb_email']}'
								order by a.estimate_idx desc ";

						$result = sql_query($sql);

						echo '<div id="board">';
						echo '<div class="form-group">';
						echo '<p class="text-right" id="reviewTitle">';
						echo "평점 <span class='main_co'>".$score."</span> / 5.0";
						echo "<span class='icon_star'>";
						if($score < 1){
							echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 2){
							echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 3){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 4){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
						}else if($score < 5){
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
						}else{
							echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
						}
						echo '</span>';
						echo '</p>';
						echo '</div>';
						echo '<div id="board">';
						echo '<div class="photo_list">';
						echo '<table id="reviewList">';
						if($review_cnt > 0){
							for ($i=0; $row=sql_fetch_array($result); $i++){
								$img_path = estimate_img($row['estimate_idx']);
								$score = $row['score'];
								echo "<tr>";
								echo "<td>";
								echo "<a href='#.'>";
								echo "<div class='title'>";
								echo "<p class='type'>".get_etype($row['e_type'])."</p>";
								echo "<p class='date'>".$row['updatetime']."</p>";
								echo "</div>";
								echo "<div class='con_wrap'>";
								echo "<div class='img'><".estimate_img_thumbnail($img_path, 70, 70)."</div>";
								echo "<div class='con'>";
								echo "<h5 class='main_co'>".$row['title']."</h5>";
								echo "<span class='name'>".$row['nickname']."</span>&nbsp;&nbsp;";
								echo "<span class='icon_star'>";
								if($score < 1){
									echo "<i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								}else if($score < 2){
									echo "<i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								}else if($score < 3){
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								}else if($score < 4){
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i><i class='xi-star-o'></i>";
								}else if($score < 5){
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star-o'></i>";
								}else{
									echo "<i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i><i class='xi-star'></i>";
								}
								echo "</span>";
								echo "<div class='subject2' href='javascript:'>".$row['review']."</div>";
								echo "</div>";
								echo "</div>";
								echo "</a>";
								echo "</td>";
								echo "</tr>";
							}
						}else{
							echo "<tr><td colspan='2' class='no_data'><div><i class='xi-error-o'></i>이용후기가 없습니다.</div></td></tr>";
						}
						echo '</table>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					?>
					
				</form>

			</div><!-- form_wrap -->
		</div><!-- login_wrap -->

	</div><!-- container -->
</div><!-- member -->

<?php
include_once('./_tail.php');
?>
