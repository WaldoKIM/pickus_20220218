<?
$part1_result = $db->select( "cs_part", "where part_index=1 and part_display_check=1 order by part_ranking asc");
// 주메뉴
while( $part1_row = @mysqli_fetch_object($part1_result) ) {
$depth2_cnt = $db->cnt("cs_part", "where part_index=2 and part_display_check=1 and part1_code='$part1_row->part1_code'");
// 카테고리 이미지 출력
if( $part1_row->list_display_check == 1 ) {	$P1_images = "../data/designImages/".$part1_row->list_display_images1; }
// 카테고리 목록이미지 출력(마우스 롤오버)
if( $part1_row->list_display_check == 2 ) {	$P1_images = "../data/designImages/".$part1_row->list_display_images1; $P2_images = "../data/designImages/".$part1_row->list_display_images2; }
if(!$depth2_cnt){
?>
<li class="menu-item">
	<a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>" class="menu-link">
	<?if($part1_row->list_display_check==1) {?><img src="<?=$P1_images;?>" border="0" align="absmiddle" >
	<?}else if($part1_row->list_display_check==2){?><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>" onMouseOver='rollover<?=$part1_row->idx?>.src="<?=$P2_images;?>"' onMouseOut='rollover<?=$part1_row->idx?>.src="<?=$P1_images;?>"'><img src="<?=$P1_images;?>" name="rollover<?=$part1_row->idx?>" border="0" align="absmiddle">
	<?}else{?><?=$part1_row->part_name;?><?}?>
	</a>
</li>
<?}else{?>
<li class="menu-item has-dropdown">
<a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>" class="menu-link">
<?if($part1_row->list_display_check==1) {?><img src="<?=$P1_images;?>" border="0" align="absmiddle" >
<?}else if($part1_row->list_display_check==2){?><a href="<?if($part1_row->url){?><?=$part1_row->url?><?}else{?>product_list.php?part_idx=<?=$part1_row->idx;?><?}?>" onMouseOver='rollover<?=$part1_row->idx?>.src="<?=$P2_images;?>"' onMouseOut='rollover<?=$part1_row->idx?>.src="<?=$P1_images;?>"'><img src="<?=$P1_images;?>" name="rollover<?=$part1_row->idx?>" border="0" align="absmiddle">
<?}else{?><?=$part1_row->part_name;?><?}?>
</a>
</li>
<?}}?>