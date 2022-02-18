<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if( ! $config['cf_social_login_use']) {     //소셜 로그인을 사용하지 않으면
    return;
}

$social_pop_once = false;

$self_url = G5_BBS_URL."/login.php";

//새창을 사용한다면
if( G5_SOCIAL_USE_POPUP ) {
    $self_url = G5_SOCIAL_LOGIN_URL.'/popup.php';
}

add_stylesheet('<link rel="stylesheet" href="'.get_social_skin_url().'/style.css">', 10);
?>

<div class="sns_login">
    <h6>SNS 로그인</h6>
    <ul class="sns-wrap">
        <?php if( social_service_check('naver') ) {     //네이버 로그인을 사용한다면 ?>
        <li>
            <a href="<?php echo $self_url;?>?provider=naver&amp;url=<?php echo $urlencode;?>" class="btn_naver sns-icon social_link sns-naver" title="네이버">
                <img src="/img/member/icon_naver.png" />
            </a>
        </li>
        <?php }     //end if ?>
        <?php if( social_service_check('kakao') ) {     //카카오 로그인을 사용한다면 ?>
        <li>
            <a href="<?php echo $self_url;?>?provider=kakao&amp;url=<?php echo $urlencode;?>" class="btn_kakao sns-icon social_link sns-kakao" title="카카오">
                <img src="/img/member/icon_kakao.png" />
            </a>
        </li>
        <?php }     //end if ?>
        <?php if( social_service_check('facebook') ) {     //페이스북 로그인을 사용한다면 ?>
        <li>
            <a href="<?php echo $self_url;?>?provider=facebook&amp;url=<?php echo $urlencode;?>" class="btn_facebook sns-icon social_link sns-facebook" title="페이스북">
                <img src="/img/member/icon_facebook.png" />
            </a>
        </li>
        <?php }     //end if ?>
        <?php if( social_service_check('google') ) {     //구글 로그인을 사용한다면 ?>
        <li>
            <a href="<?php echo $self_url;?>?provider=google&amp;url=<?php echo $urlencode;?>" class="btn_google sns-icon social_link sns-google" title="구글">
                <img src="/img/member/icon_google.png" />
            </a>
        </li>
        <?php }     //end if ?>
        <?php if( social_service_check('twitter') ) {     //트위터 로그인을 사용한다면 ?>
        <li>
            <a href="<?php echo $self_url;?>?provider=twitter&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-twitter" title="트위터">
                <span class="ico"></span>
                <span class="txt">트위터<i> 로그인</i></span>
            </a>
        </li>
        <?php }     //end if ?>
        <?php if( social_service_check('payco') ) {     //페이코 로그인을 사용한다면 ?>
        <li>
            <a href="<?php echo $self_url;?>?provider=payco&amp;url=<?php echo $urlencode;?>" class="sns-icon social_link sns-payco" title="페이코">
                <span class="ico"></span>
                <span class="txt">페이코<i> 로그인</i></span>
            </a>
        </li>
        <?php }     //end if ?>

        <?php if( G5_SOCIAL_USE_POPUP && !$social_pop_once ){
        $social_pop_once = true;
        ?>
        <script>
            jQuery(function($){
                $(".sns-wrap").on("click", "a.social_link", function(e){
                    e.preventDefault();

                    var pop_url = $(this).attr("href");
                    var newWin = window.open(
                        pop_url, 
                        "social_sing_on", 
                        "location=0,status=0,scrollbars=1,width=600,height=500"
                    );

                    if(!newWin || newWin.closed || typeof newWin.closed=='undefined')
                         alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

                    return false;
                });
            });
        </script>
        <?php } ?>
    </ul>
</div>