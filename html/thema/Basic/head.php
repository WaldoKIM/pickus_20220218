<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="/css/menu.css">
<link rel="stylesheet" type="text/css" href="/thema/Basic/css/style.css?after">
<link rel="stylesheet" type="text/css" href="/thema/Basic/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/thema/Basic/css/setting.css?after">
<link rel="stylesheet" type="text/css" href="/thema/Basic/css/shop.css">
<link rel="stylesheet" type="text/css" href="/thema/Basic/css/list.css">
<link rel="stylesheet" type="text/css" href="/thema/Basic/css/widget.css">
<link rel="stylesheet" type="text/css" href="/thema/Basic/css/magic.css">
<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox.css">
<script type="text/javascript" src="/js/load-image.all.min.js"></script>
<script type="text/javascript" src="/js/md5.js"></script>
<script type="text/javascript" src="/js/jquery.lightbox.js"></script>
<script data-ad-client="ca-pub-6324853175392320" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script src="https://www.googleoptimize.com/optimize.js?id=OPT-KJ4LCVM"></script>
<script src="<?php echo THEMA_URL; ?>/assets/bs3/js/bootstrap.min.js"></script>
<!-- Google Tag Manager -->
<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TPKBT67');
</script>
<!-- End Google Tag Manager -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146069223-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-146069223-1');
</script>

<!-- Global site tag (gtag.js) - Google Ads: 715468370 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-715468370"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-715468370', {
        'optimized_id': 'OPT-KJ4LCVM'
    });
</script>

<!-- AceCounter Log Gathering Script V.8.0.AMZ2019080601 -->
<script language='javascript'>
    var _AceGID = (function() {
        var Inf = ['gtp2.acecounter.com', '8080', 'AH5A43258375801', 'AW', '0', 'NaPm,Ncisy', 'ALL', '0'];
        var _CI = (!_AceGID) ? [] : _AceGID.val;
        var _N = 0;
        var _T = new Image(0, 0);
        if (_CI.join('.').indexOf(Inf[3]) < 0) {
            _T.src = "https://" + Inf[0] + '/?cookie';
            _CI.push(Inf);
            _N = _CI.length;
        }
        return {
            o: _N,
            val: _CI
        };
    })();
    var _AceCounter = (function() {
        var G = _AceGID;
        var _sc = document.createElement('script');
        var _sm = document.getElementsByTagName('script')[0];
        if (G.o != 0) {
            var _A = G.val[G.o - 1];
            var _G = (_A[0]).substr(0, _A[0].indexOf('.'));
            var _C = (_A[7] != '0') ? (_A[2]) : _A[3];
            var _U = (_A[5]).replace(/\,/g, '_');
            _sc.src = 'https:' + '//cr.acecounter.com/Web/AceCounter_' + _C + '.js?gc=' + _A[2] + '&py=' + _A[4] + '&gd=' + _G + '&gp=' + _A[1] + '&up=' + _U + '&rd=' + (new Date().getTime());
            _sm.parentNode.insertBefore(_sc, _sm);
            return _sc.src;
        }
    })();
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6324853175392320" crossorigin="anonymous"></script>
<!-- AceCounter Log Gathering Script End -->
<!--[if lt IE 9]>
<script type="text/javascript" src="http://103.55.191.125/thema/Basic/assets/js/respond.js"></script>
<![endif]-->

<?php
if (!defined('_GNUBOARD_')) exit; // ?????? ????????? ?????? ??????
include_once(THEMA_PATH . '/assets/thema.php');
$sql = " select count(*) as cnt from {$g5['notify_table']} where email = '{$member['mb_email']}' AND read_gb = '0'";
$notify = sql_fetch($sql);

$notify_cnt = $notify['cnt'];
?>
<?php
include_once(G5_LIB_PATH . '/popular.lib.php');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.ham_box').unbind('click').bind('click', function(e) {
            $('.sidenav').addClass("opened");
            return false;
        });
        $('#close_menu').click(function() {
            $('.sidenav').removeClass("opened");
        });
    });
</script>
<style type="text/css">
    .comment-btn button:nth-of-type(n+2) {
        display: none !important;
    }

    .sidenav {
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 10;
        top: 0;
        right: -100%;
        background-color: #fff;
        overflow-x: hidden;
        transition: 0.5s;

    }

    .sidenav .items {
        padding: 0 15px;
        padding-top: 60px;
        background-color: #1379cd;
    }

    .sidenav.opened {
        right: 0;
    }

    .sidenav .login {
        margin-top: 20px;
        padding: 15px;
        background-color: #1379cd;
    }

    #close_menu {
        float: right;
        max-width: 50px;
        margin-right: 20px;
        margin-top: 20px;
    }

    #nav-left {
        display: block;
    }

    #nav-left>li {
        text-align: left;
    }

    .login li a {
        overflow: hidden;
    }

    .mobile {
        display: none;
    }

    @media(max-width: 768px) {
        .mobile {
            display: block;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type=number]').keypress(function(e) {
            var txt = String.fromCharCode(e.which);
            if (!txt.match(/[0-9]/)) {
                return false;
            }
        });
    });
</script>
<ul id="quick">
    <li>
        <div>Quick<br>MENU</div>
    </li>
    <li><a href="/estimate/estimate_register.php">??????<br>????????????</a></li>
    <li><a href="/bbs/content.php?co_id=company">?????????<br>??????</a></li>
    <!--<li><a href="#none" onclick="cfnKakaoChat()">?????????</a></li>-->
    <li><a href="#">TOP</a></li>
</ul>
<?php if ($member['mb_level'] == 10) { ?>

    <style type="text/css">
        .nav .gnb_menu .btn {
            padding-left: 0;
            padding-right: 0;
        }
    </style>

<?php } ?>

<?php if ($member['mb_level'] == 2) { ?>

    <style type="text/css">
        #ch-plugin {
            display: none !important;
        }
    </style>

<?php } ?>

<div class="sidenav">
    <span id="close_menu"><img src="/img/White_icon_24_close.png"></span>
    <div class="items">
        <?php
        if (!$is_member) {
        ?>
            <div class="my main_bg">
                <h2>????????? ?????????</h2>
            </div><!-- my -->
            <ul class="login row main_bg">
                <li class="col-xs-6"><a class="white_bg" href="/bbs/login.php">?????????</a></li>
                <li class="col-xs-6"><a class="white_bg" href="/bbs/register_customer_form.php">????????????</a></li>
            </ul><!-- quick_login -->
        <?php
        } else {
        ?>
            <div class="my main_bg">
                <h2><?php echo $member['mb_name']; ?>??? ???????????????</h2>
            </div><!-- my -->
            <ul class="login row main_bg">
                <li class="col-xs-6"><a class="line_bg" href="/bbs/logout.php">????????????</a></li>
                <?php if ($member['mb_level'] == 0 || $member['mb_level'] == 10) { ?>
                    <li class="col-xs-6"><a class="line_bg " href="/bbs/mypage.php">???????????????</a></li>
                    <li class="col-xs-6"><a class="line_bg " href="/bbs/history_member.php">????????????</a></li>
                <?php } ?>
                <?php if ($member['mb_level'] == 2) { ?>
                    <li class="col-xs-6"><a class="line_bg" href="/bbs/mypage_partner.php">???????????????</a></li>
                <?php } ?>
                <?php if ($member['mb_level'] == 8) { ?>
                    <li class="col-xs-6"><a class="line_bg" href="/bbs/mypage_guest.php">???????????????</a></li>
                <?php } ?>
                <?php if ($member['mb_level'] == 10) { ?>
                    <li class="col-xs-6"><a class="line_bg" href="/adm">?????????</a></li>
                <?php } ?>
                <li class="col-xs-6"><a class="line_bg" href="/bbs/notify.php">??????<?php
                                                                                    if ($notify_cnt) {
                                                                                        echo '&nbsp;&nbsp;<span style="vertical-align:top;" class="badge">' . $notify_cnt . '</span>';
                                                                                    }
                                                                                    ?></a></li>
                <?php if (($member['mb_level'] == 2) || ($member['mb_level'] == 10)) : ?>
                    <li class="col-xs-6"><a class="line_bg" href="/bbs/board.php?bo_table=notice_partner">??????????????????</a></li>
                    <li class="col-xs-6"><a class="line_bg" href="/bbs/history_partner.php">????????????</a></li>
                <?php endif; ?>
            </ul>
        <?php
        }
        ?>

    </div>
    <ul class="nav" id="nav-left">
        <?php if ($is_member) { ?>
            <?php if (($member['mb_level'] == 0) || ($member['mb_level'] == 10) || ($member['mb_level'] == 8)) : ?>
                <li style="border-bottom: 0;"><a href="/estimate/my_estimate_list.php">??? ????????????</a></li>
                <li><a href="/estimate/estimate_register.php">?????? ??????</a></li>
            <?php endif; ?>
            <?php if (($member['mb_level'] == 2) || ($member['mb_level'] == 10)) : ?>
                <li style="border-bottom: 0;"><a href="/estimate/estimate_list2.php">???????????????</a></li>
                <li><a href="/estimate/partner_estimate_list.php">??? ????????????</a></li>
                <li><a href="../market/seller/order/trade.php">???????????????</a></li>
            <?php endif; ?>

        <?php } else { ?>
            <?php if ($member['mb_level'] != 2) : ?>
                <li style="border-bottom: 0;"><a href="/estimate/estimate_register.php">?????? ??????</a></li>
            <?php endif; ?>
        <?php } ?>
        <?php if ($member['mb_level'] != 2) : ?>
            <li><a href="/bbs/guide.php">??????????????????</a></li>
            <li style="display:none !important;"><a href="../market">???????????????</a></li>
        <?php endif; ?>
        <li><a href="/bbs/pick.php">???????????????</a></li>
        <li><a href="/bbs/board_pick.php">????????? ???</a></li>
        <li><a href="https://blog.naver.com/pickus">??????</a></li>
        <li><a href="/bbs/faq.php">????????????</a></li>
        <?php if (($member['mb_level'] == 2) || ($member['mb_level'] == 10)) : ?>
            <li><a href="http://pf.kakao.com/_qBNaxl/chat">?????? ????????????</a></li>
            <!-- <li><a class="devtemp" href="http://repickus.com:8090">??????</a></li> -->
        <?php endif; ?>

        <div class="coll">
            <h2>?????? ?????? ??? ????????? ??????</h2>
            <h1 class="main_co">1800-5528</h1>
            <p>????????????: 09:00 ~ 18:00</p>
            <p>(???/????????? ??????)</p>
        </div>
    </ul>
</div>
<div id="thema_wrapper" class="wrapper <?php echo $is_thema_layout; ?> <?php echo $is_thema_font; ?>">

    <!-- LNB -->
    

    <!-- PC Header -->
    <header class="header">
        <div class="layout_fix">
            <div class="at-container">
                <ul class="ul">
                    <!-- PC Logo -->
                    <div class="mob_back mobile" style="margin-top: 4px;" onclick="goMove_()">
                        <img src="/img/arr_before.JPG" style="max-width: 85%">
                    </div>
                    <li class="li logo">
                        <div class="logo_box">
                            <a href="/">
                                <img src="/img/pickus_logo.png">
                            </a>
                        </div>
                    </li>
                    <!--????????? ??????-->
                    <div class="ham_menu">
                        <div class="ham_box">
                            <input type="checkbox" id="menuicon">
                            <label for="menuicon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <!-- PC Search -->
                    <li class="li right">
                        <aside class="at-lnb">
        <div class="at-container">
            <div class="top layout_fix">
                <ul class="top_left">
                    <li><a href="#">????????? ?????????</a></li>
                </ul>
                <ul class="top_right">
                    <style type="text/css">
                        .top li+li:before {
                            display: none;
                        }
                    </style>
                    <ul>
                        <?php if ($is_member) { // ????????? ?????? 
                        ?>

                            <?php if ($member['admin']) { ?>
                                <li><a href="<?php echo G5_ADMIN_URL; ?>">??????</a></li>
                            <?php } ?>
                            <?php if ($member['partner']) { ?>
                                <li><a href="<?php echo $at_href['myshop']; ?>">?????????</a></li>
                            <?php } ?>
                            <li class="sidebarLabel" style="display: none;">
                                <a href="javascript:;" onclick="sidebar_open('sidebar-response');">
                                    ?????? <b class="orangered sidebarCount"><?php echo $member['response'] + $member['memo']; ?></b>
                                </a>
                            </li>
                            <li><b><a href="#"><?php echo $member['mb_name']; ?>???</a></b></li>
                            <?php if ($member['mb_level'] == 0 || $member['mb_level'] == 10) { ?>
                                <li><a class="small_nav" href="/bbs/mypage.php">???????????????</a></li>
                                <li><a class="small_nav" href="/bbs/history_member.php">????????????</a></li>
                            <?php } ?>

                            <?php if ($member['mb_level'] == 2) { ?>
                                <li><a class="small_nav" href="/bbs/mypage_partner.php">???????????????</a></li>
                                <li><a class="small_nav" href="/bbs/history_partner.php">????????????</a></li>
                            <?php } ?>
                            <?php if ($member['mb_level'] == 8) { ?>
                                <li><a class="small_nav" href="/bbs/mypage_guest.php">???????????????</a></li>
                                <li><a class="small_nav" href="/bbs/history_member.php">????????????</a></li>
                            <?php } ?>
                            <li><a class="small_nav" href="/bbs/notify.php">??????<?php
                                                            if ($notify_cnt) {
                                                                echo '&nbsp;&nbsp;<span class="badge">' . $notify_cnt . '</span>';
                                                            }
                                                            ?></a></li>


                        <?php } else { // ???????????? ?????? 
                        ?>
                            <li><a href="/bbs/login.php">?????????</a></li>
                            <li><a href="/bbs/register_customer_form.php">????????????</a></li>
                        <?php } ?>
                        <?php if (IS_YC) { // ????????? ???????????? 
                        ?>
                            <?php if ($member['cart'] || $member['today']) { ?>
                                <li>
                                    <a href="<?php echo $at_href['cart']; ?>" onclick="sidebar_open('sidebar-cart'); return false;">
                                        ?????? <b class="blue"><?php echo number_format($member['cart'] + $member['today']); ?></b>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="commu"><a href="<?php echo $at_href['change']; ?>"><?php echo (IS_SHOP) ? '????????????' : '?????????'; ?></a></li>
                        <?php } ?>
                        <li class="loged"><a href="<?php echo $at_href['connect']; ?>">?????? <?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb']) ? ' (<b class="orangered">' . number_format($stats['now_mb']) . '</b>)' : ''; ?></a></li>
                        <?php if ($is_member) { ?>
                            <li><a href="<?php echo $at_href['logout']; ?>">???????????? </a></li>

                        <?php } ?>
                    </ul>
            </div>


            <!-- LNB Left -->
            <div class="pull-left displaynone">
                <ul>
                    <li><a href="javascript:;" id="favorite">????????????</a></li>
                    <li><a href="<?php echo $at_href['rss']; ?>" target="_blank">RSS ??????</a></li>
                    <?php
                    $tweek = array("???", "???", "???", "???", "???", "???", "???");
                    ?>
                    <li><a><?php echo date('m??? d???'); ?>(<?php echo $tweek[date("w")]; ?>)</a></li>
                </ul>
            </div>
            <!-- LNB Right -->
            <div class="pull-right displaynone">
                <ul>
                    <?php if ($is_member) { // ????????? ?????? 
                    ?>
                        <li><a href="javascript:;" onclick="sidebar_open('sidebar-user');"><b><?php echo $member['mb_nick']; ?></b></a></li>
                        <?php if ($member['admin']) { ?>
                            <li><a href="<?php echo G5_ADMIN_URL; ?>">??????</a></li>
                        <?php } ?>
                        <?php if ($member['partner']) { ?>
                            <li><a href="<?php echo $at_href['myshop']; ?>">?????????</a></li>
                        <?php } ?>
                        <li class="sidebarLabel" <?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"'; ?>>
                            <a href="javascript:;" onclick="sidebar_open('sidebar-response');">
                                ?????? <b class="orangered sidebarCount"><?php echo $member['response'] + $member['memo']; ?></b>
                            </a>
                        </li>
                    <?php } else { // ???????????? ?????? 
                    ?>
                        <li><a href="/bbs/login.php" onclick="sidebar_open('sidebar-user'); return false;">?????????</a></li>
                        <li><a href="/bbs/register_customer_form.php">????????????</a></li>
                        <!-- <li><a href="<?php echo $at_href['lost']; ?>" class="win_password_lost">???????????? </a></li> -->
                    <?php } ?>
                    <?php if (IS_YC) { // ????????? ???????????? 
                    ?>
                        <?php if ($member['cart'] || $member['today']) { ?>
                            <li>
                                <a href="<?php echo $at_href['cart']; ?>" onclick="sidebar_open('sidebar-cart'); return false;">
                                    ?????? <b class="blue"><?php echo number_format($member['cart'] + $member['today']); ?></b>
                                </a>
                            </li>
                        <?php } ?>
                        <li><a href="<?php echo $at_href['change']; ?>"><?php echo (IS_SHOP) ? '????????????' : '?????????'; ?></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $at_href['connect']; ?>">?????? <?php echo number_format($stats['now_total']); ?><?php echo ($stats['now_mb']) ? ' (<b class="orangered">' . number_format($stats['now_mb']) . '</b>)' : ''; ?></a></li>
                    <?php if ($is_member) { ?>
                        <li><a href="<?php echo $at_href['logout']; ?>">???????????? </a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </aside>
                    </li>
                    <div class="clearfix"></div>
                </ul>
            </div>
        </div>
    </header>

    <!-- Mobile Header -->
    <header class="m-header">
        <div class="at-container">
            <div class="header-wrap">
                <div class="header-icon">
                    <a href="javascript:;" onclick="sidebar_open('sidebar-user');">
                        <i class="fa fa-user"></i>
                    </a>
                </div>
                <div class="header-logo en">
                    <!-- Mobile Logo -->
                    <a href="<?php echo $at_href['home']; ?>">
                        <b>?????????</b>
                    </a>
                </div>
                <div class="header-icon">
                    <a href="javascript:;" onclick="sidebar_open('sidebar-search');">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </header>

    <!-- Menu -->
    <div class="nav if_main  ">
        <div class="layout_fix">
            <ul class="table">
                <!--<li class="td this_ctg js_box_navctg ">

                 <div class="ctg_all js_btn_navctg" onclick="return false;">
                    <span class="btn_all">
                        <span class="img_btn">
                            <span class="img_off"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/menu_ic.gif" alt=""></span>
                            <span class="img_over"><img src="//dehuv.onedaynet.co.kr/skin/site/basic/images/dehuv/menu_ic2.gif" alt=""></span>
                        </span>
                        <span class="tx">?????? ????????????</span>
                    </span>
                </div> -->

                <!-- ????????? ?????????????????? ?????? / 3??? ?????? ????????? dd??? if_ctg3 ????????? ?????? -->
                <!-- <div class="all_open">
                    <div class="in_box">

                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=147" class="ctg1 js_slide_cate_more">
                                <span class="tit">??????</span>
                            </a>
                        </dt>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=206" class="ctg2">?????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=203" class="ctg2">?????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=217" class="ctg2">?????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=205" class="ctg2">
                                ?????????/PC ????????????                         </a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=204" class="ctg2">
                                ?????????                         </a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=207" class="ctg2">????????????/????????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=246" class="ctg2">??????/?????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=434" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=147" class="ctg2 js_slide_cate_more">?????? ?????? ??????</a></dd>
                    </dl>


                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=1" class="ctg1 js_slide_cate_more">
                                <span class="tit">??????                                </span>
                            </a>
                        </dt>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=155" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=219" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=213" class="ctg2">????????????/??????</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=1" class="ctg2 js_slide_cate_more">?????? ?????? ??????</a></dd>
                    </dl>


                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=2" class="ctg1 js_slide_cate_more">
                                <span class="tit">????????????                              </span>
                            </a>
                        </dt>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=145" class="ctg2">??????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=195" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=197" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=198" class="ctg2">??????</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=2" class="ctg2 js_slide_cate_more">?????? ?????? ??????</a></dd>
                    </dl>


                    <dl>
                        <dt>
                            <a href="/?pn=product.list&amp;cuid=438" class="ctg1 js_slide_cate_more">
                                <span class="tit">??????/????????????</span>
                            </a>
                        </dt>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=439" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real">
                            <a href="/?pn=product.list&amp;cuid=440" class="ctg2">??????/????????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=441" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=442" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=443" class="ctg2">??????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=444" class="ctg2">??????/???????????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=445" class="ctg2">DIY??????/??????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=446" class="ctg2">????????????</a>
                        </dd>
                        <dd class="next_real ">
                            <a href="/?pn=product.list&amp;cuid=447" class="ctg2">??????/???????????????</a>
                        </dd>
                        <dd class="next_fake"><a href="/?pn=product.list&amp;cuid=438" class="ctg2 js_slide_cate_more">?????? ?????? ??????</a></dd>
                    </dl>

                    <dl></dl><dl></dl>

                </div>
                <script>
                    $(document).on('click','.js_btn_navctg',function(){
                        var chk = $(targetClass).hasClass(addClassName);
                        if( chk == false){ $(targetClass).addClass(addClassName); }
                        else {  $(targetClass).removeClass(addClassName);  }
                    });
                </script>


            </div></li> -->
                <li class="td this_gnb">


                    <!-- ????????? ???????????? -->
                    <div class="gnb_menu">
                        <ul style="display: flex;flex-direction: row;flex-wrap: nowrap;"class="myMenu">
                            <?php if ($is_member) : ?>
                                <?php if ($member['mb_level'] == 0 || $member['mb_level'] == 10 || $member['mb_level'] == 8) : ?>
                                    <li><a class="btn" href="/estimate/my_estimate_list.php"><span class="tx">??? ????????????</span></a>
                                        <ul style="width:100%;"class="submenu">
                                            <li><a href="/estimate/my_estimate_list.php" class="">??????/??????</a></li>
                                            <li><a href="/estimate/my_estimate_list_match.php" class="">??????</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($member['mb_level'] == 2 || $member['mb_level'] == 10) : ?>
                                <li><a class="btn" href="/estimate/estimate_list2.php"><span class="tx">???????????????</span></a>
                                    <ul class="submenu">
                                    <li><a href="/estimate/estimate_list2.php" class="">??????/??????</a></li>
                                    <li><a href="/estimate/estimate_list3.php" class="">????????????</a></li>
                                    <li><a href="/estimate/estimate_list1.php" class="">????????????</a></li>
                                </ul>
                                </li>
                                <li><a class="btn" href="/estimate/partner_estimate_list.php"><span class="tx">??? ????????????</span></a>
                                    <ul class="submenu">
                                    <li><a href="/estimate/partner_estimate_list.php" class="">??????/??????</a></li>
                                    <li><a href="/estimate/partner_estimate_list.php?gubun=6" class="">??????</a></li>
                                    </ul>
                                </li>
                                <li><a class="btn" href="../market/seller/order/trade.php"><span class="tx">???????????????</span></a></li>
                            <?php endif; ?>
                            <?php if ($member['mb_level'] != 2) : ?>
                                <li><a href="/estimate/estimate_register.php" class="btn"><span class="tx">?????? ??????</span></a>
                                <ul class="submenu">
                                    <li><a href="/estimate/estimate_register1B.php" class="">??????/?????? ??????</a></li>
                                    <li><a href="/estimate/estimate_register2D.php" class="">????????????</a></li>
                                    <li><a href="/estimate/estimate_register3B.php" class="">??????/????????????</a></li>
                                    <li><a href="/estimate/estimate_register4.php" class="">????????????</a></li>
                                    <li><a href="/estimate/estimate_match.php" class="">??????????????????</a></li>
                                </ul>
                                </li>
                                <li style="display:none !important;"><a href="../market" class="btn"><span class="tx">???????????????</span></a></li>
                            <?php endif; ?>
  
                            <?php if ($member['mb_level'] == 10) : ?>
                                <li><a href="/estimate/partner_estimate_list.php?gubun=3" class="btn"><span class="tx">????????????</span></a></li>
                            <?php endif; ?>

                            <li><a href="/bbs/pick.php" class="btn"><span class="tx">???????????????</span></a></li>
                            <li><a href="/bbs/board_pick.php" class="btn"><span class="tx">????????? ???</span></a></li>
                            <li><a href="https://blog.naver.com/pickus" class="btn"><span class="tx">??????</span></a></li>
                            <li><a href="/bbs/faq.php" class="btn"><span class="tx">????????????</span></a></li>
                            <?php if (($member['mb_level'] == 2) || ($member['mb_level'] == 10)) : ?>
                                <li><a class="btn" href="http://pf.kakao.com/_qBNaxl/chat" target="_blank"><span class="tx">?????? ????????????</span></a></li>
                                <!-- <li class="devtemps"><a class="devtemp" href="http://repickus.com:8090">??????</a></li>-->
                            <?php endif; ?>
                            <!-- <?php if ($member['mb_level'] != 2) : ?>
                            <li><a href="http://dehuv.onedaynet.co.kr/" class="btn"><span class="tx">????????? ??????</span></a></li>
                        <?php endif; ?> -->

                        </ul>
                    </div>
                    <!-- / ???????????? -->




                </li>
            </ul>
        </div>
    </div>




    <nav class="at-menu displaynone">
        <!-- PC Menu -->
        <div class="pc-menu">
            <!-- Menu Button & Right Icon Menu -->
            <div class="at-container">
                <div class="nav-right nav-rw nav-height">
                    <ul>
                        <?php if (IS_YC) { //????????? 
                        ?>
                            <li class="nav-show">
                                <a href="<?php echo $at_href['cart']; ?>" onclick="sidebar_open('sidebar-cart'); return false;" <?php echo tooltip('??????'); ?>>
                                    <i class="fa fa-shopping-bag"></i>
                                    <?php if ($member['cart'] || $member['today']) { ?>
                                        <span class="label bg-green en">
                                            <?php echo number_format($member['cart'] + $member['today']); ?>
                                        </span>
                                    <?php } ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="javascript:;" onclick="sidebar_open('sidebar-response');" <?php echo tooltip('??????'); ?>>
                                <i class="fa fa-bell"></i>
                                <span class="label bg-orangered en" <?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"'; ?>>
                                    <span class="msgCount"><?php echo number_format($member['response'] + $member['memo']); ?></span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" onclick="sidebar_open('sidebar-search');" <?php echo tooltip('??????'); ?>>
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="menu-all-icon" <?php echo tooltip('????????????'); ?>>
                            <a href="javascript:;" data-toggle="collapse" data-target="#menu-all">
                                <i class="fa fa-th"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php include_once(THEMA_PATH . '/menu.php');    // ?????? ???????????? 
            ?>
            <div class="clearfix"></div>
            <div class="nav-back"></div>
        </div><!-- .pc-menu -->

        <!-- PC All Menu -->
        <div class="pc-menu-all">
            <div id="menu-all" class="collapse">
                <div class="at-container table-responsive">
                    <table class="table">
                        <tr>
                            <?php
                            $az = 0;
                            for ($i = 1; $i < $menu_cnt; $i++) {

                                if (!$menu[$i]['gr_id']) continue;

                                // ?????????
                                if ($az && $az % $is_allm == 0) {
                                    echo '</tr><tr>' . PHP_EOL;
                                }
                            ?>
                                <td class="<?php echo $menu[$i]['on']; ?>">
                                    <a class="menu-a" href="<?php echo $menu[$i]['href']; ?>" <?php echo $menu[$i]['target']; ?>>
                                        <?php echo $menu[$i]['name']; ?>
                                        <?php if ($menu[$i]['new'] == "new") { ?>
                                            <i class="fa fa-bolt new"></i>
                                        <?php } ?>
                                    </a>
                                    <?php if ($menu[$i]['is_sub']) { //Is Sub Menu 
                                    ?>
                                        <div class="sub-1div">
                                            <ul class="sub-1dul">
                                                <?php for ($j = 0; $j < count($menu[$i]['sub']); $j++) { ?>

                                                    <?php if ($menu[$i]['sub'][$j]['line']) { //???????????? 
                                                    ?>
                                                        <li class="sub-1line"><a><?php echo $menu[$i]['sub'][$j]['line']; ?></a></li>
                                                    <?php } ?>

                                                    <li class="sub-1dli <?php echo $menu[$i]['sub'][$j]['on']; ?>">
                                                        <a href="<?php echo $menu[$i]['sub'][$j]['href']; ?>" class="sub-1da<?php echo ($menu[$i]['sub'][$j]['is_sub']) ? ' sub-icon' : ''; ?>" <?php echo $menu[$i]['sub'][$j]['target']; ?>>
                                                            <?php echo $menu[$i]['sub'][$j]['name']; ?>
                                                            <?php if ($menu[$i]['sub'][$j]['new'] == "new") { ?>
                                                                <i class="fa fa-bolt sub-1new"></i>
                                                            <?php } ?>
                                                        </a>
                                                    </li>
                                                <?php } //for 
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </td>
                            <?php $az++;
                            } //for 
                            ?>
                        </tr>
                    </table>
                    <div class="menu-all-btn">
                        <div class="btn-group">
                            <a class="btn btn-lightgray" href="<?php echo $at_href['main']; ?>"><i class="fa fa-home"></i></a>
                            <a href="javascript:;" class="btn btn-lightgray" data-toggle="collapse" data-target="#menu-all"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .pc-menu-all -->

        <!-- Mobile Menu -->
        <div class="m-menu">
            <?php include_once(THEMA_PATH . '/menu-m.php');    // ?????? ???????????? 
            ?>
        </div><!-- .m-menu -->
    </nav><!-- .at-menu -->

    <div class="clearfix"></div>

    <?php if ($page_title) { // ????????? ????????? 
    ?>
        <div class="at-title">
            <div class="at-container">
                <div class="page-title en">
                    <strong<?php echo ($bo_table) ? " class=\"cursor\" onclick=\"go_page('" . G5_BBS_URL . "/board.php?bo_table=" . $bo_table . "');\"" : ""; ?>>
                        <?php echo $page_title; ?>
                        </strong>
                </div>
                <?php if ($page_desc) { // ????????? ????????? 
                ?>
                    <div class="page-desc hidden-xs">
                        <?php echo $page_desc; ?>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php } ?>

    <div class="at-body">
        <?php if ($col_name) { ?>
            <div class="at-container">
                <?php if ($col_name == "two") { ?>
                    <div class="row at-row">
                        <div class="col-md-<?php echo $col_content; ?><?php echo ($at_set['side']) ? ' pull-right' : ''; ?> at-col at-main">
                        <?php } else { ?>
                            <div class="at-content">
                            <?php } ?>
                        <?php } ?>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                if (window.location.href.indexOf("www") > -1) {

                                    window.location.href = 'https://repickus.com' + window.location.pathname;
                                }
                            });

                            function goMove_() {
                                /*if (window.location.pathname == "/estimate/estimate_form.php" || window.location.pathname == "/estimate/estimate_form_match.php" || location.pathname == "/estimate/partner_estimate_form.php" || location.pathname == "/estimate/partner_estimate_match_form.php"){

                                    window.location.href = "/estimate/partner_estimate_list.php";

                                }else */
                                if (window.location.pathname == "/estimate/my_estimate_form.php" || window.location.pathname == "/estimate/my_estimate_form_match_sa.php") {

                                    window.location.href = "/estimate/my_estimate_list.php";

                                } else {
                                    history.back();
                                }
                            }
                        </script>