<?
include('../../common.php'); 
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '../index.php');}
//$_GET=&$HTTP_GET_VARS;
//$_POST=&$HTTP_POST_VARS;

if($_GET[idx]) {
	// 넘어온 idx 로 삭제 레코드를 검색한다.
	$row = $db->object("cs_banner", "where idx=$_GET[idx]");
	// 파일 삭제
	if( $row->banner_images) { @unlink("../../data/designImages/".$row->banner_images); }
	if( $db->delete("cs_banner", "where idx=$_GET[idx]") ) { $tools->javaGo("banner.php?code=".$_GET[code]); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
