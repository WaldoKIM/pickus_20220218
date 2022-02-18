<?php include_once('./_common.php'); ?>

<section class="cont_01">
          <div class="contico_t">
            <ul>
              <li>
                <a href="https://repickus.com/estimate/estimate_list2.php">
                  <img src="../img/mbtn_list.png" alt="">
                  <p class="contico_t_title">견적리스트</p>
                  <p class="contico_t_subtitle">현재 견적들을 확인 할 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="https://repickus.com/estimate/partner_estimate_list.php">
                  <img src="../img/mbtn_estimate.png" alt="">
                  <p class="contico_t_title">내견적현황</p>
                  <p class="contico_t_subtitle">내 견적 현황들을 확인 할 수 있습니다.</p>
                </a>
              </li>
              <li>
                <a href="https://repickus.com/bbs/mypage_btn.php">
                  <img src="../img/mbtn_seller.png" alt="">
                  <p class="contico_t_title">마이페이지</p>
                  <p class="contico_t_subtitle">마켓 오픈 준비중입니다. 베타버전</p>
                </a>
              </li>
              <li>
                <a href="https://repickus.com/market/seller/product/product_add.php">
                  <img src="../img/mbtn_register.png" alt="">
                  <p class="contico_t_title">물품등록</p>
                  <p class="contico_t_subtitle">마켓 오픈 준비중입니다. 베타버전</p>
                </a>
              </li>
            </ul>
          </div>
</section>

<section class="cont_01">
    <div style="border:none;" class="est est_design">
          <div class="Brea">
            <div>
              <span class="ico01">icon</span>
              <h4 class="tit">판매 견적리스트</h4>
              <div class="swiper-req" style="height: 82px; overflow: hidden;">
                <div class="list swiper-wrapper">
                  <?php for ($i = 0; $row = sql_fetch_array($fec_union); $i++) {
                    $type = '';
                    if ($row['e_type'] == '0') {
                      $type = '<li class="first01">매입</li>';
                    } else if ($row['e_type'] == '1') {
                      $type = '<li class="first02">다량</li>';
                    } else if ($row['e_type'] == '2') {
                      $type = '<li class="first03">철거</li>';
                    }
                    echo "<ul class='swiper-slide' style='min-width:300px'>";
                    echo $type;
                    echo "<li>" . mb_substr($row['area1'], 0, 2) . "</li>";
                    echo "<li>" . mb_substr($row['title'], 0, 6) . "</li>";
                    echo "</ul>";
                  } ?>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="Brea">
            <div>
              <span class="ico02">icon</span>
              <h4 class="tit">구매 견적리스트</h4>
              <div class="swiper-req" style="height: 82px; overflow: hidden;">
                <div class="list swiper-wrapper">
                  <?php for ($i = 0; $row = sql_fetch_array($fec_union_match); $i++) {
                    
                   
                    $type = '<li class="first02">구매</li>';
                    
                    echo "<ul class='swiper-slide' style='min-width:300px'>";
                    echo $type;
                    echo "<li>" . mb_substr($row['area1'], 0, 2) . "</li>";
                    echo "<li>" . mb_substr($row['title'], 0, 6) . "</li>";
                    echo "</ul>";
                  } ?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
</section>

<section class="cont_03">
  <?include_once('./main_seller_guide.php');?>  
        <!-- <div class="how">
          <h2 class="how_bar">업체 이용가이드</h2>
          <div class="how_slider">
            <div class="service swiper-container swiper1">
              <div class="btn">
                <a href="" class="prev swiper-button-prev">이전</a>
                <a href="" class="next swiper-button-next">다음</a>
              </div>
              <div class="serv_box swiper-wrapper">
                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      
                    </div>
                    <div class="con_step_title">
                        <span>STEP 1</span>
                         <h3>신청 견적 참여</h3>
                    </div>
                    <div class="serv_con tab" id="tabs1">
                      <ul>
                        <li class="on"><span></span><a href="#tabs-1">가전/가구 구매</a></li>
                        <li><span></span><a href="#tabs-2">다량매입</a></li>
                        <li><span></span><a href="#tabs-3">철거/원상복구</a></li>
                        <li><span></span><a href="#tabs-4">중고 구매 매칭</a></li>
                        <li><span></span><a href="#tabs-5">피커스 마켓</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_01 conbox on">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 가전/가구 구매견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-2" class="conbox_02 conbox">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 다량 매입 견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-3" class="conbox_03 conbox">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 철거/원상복구 견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-4" class="conbox_04 conbox">
                        
                        <div class="conbox_txt">
                          <p>고객님이 신청하신 가전/가구 구매 견적에 참여합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                      <div id="tabs-5" class="conbox_05 conbox">
                        
                        <div class="conbox_txt">
                          <p>마켓을 이용하여 중고 가전/가구를 판매합니다</p>
                        </div>
                        <span class="con_img01n">icon</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      
                    </div>
                    <div class="con_step_title">
                        <span>STEP 2</span>
                        <h3>업체 선정</h3>
                    </div>
                    <div class="serv_con tab" id="tabs2">
                      <ul>
                        <li class="on"><span></span><a href="#tabs-1">업체 선정</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_07 conbox on">
                        <div class="conbox_txt">
                          <p>고객님이 견적을 확인하고 선택합니다</p>
                        </div>
                        <span class="con_img02n">icon</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                      
                    </div>
                    <div class="con_step_title">
                        <span>STEP 3</span>
                        <h3>일정조율</h3>
                    </div>
                    <div class="serv_con tab" id="tabs3">
                      <ul>
                        <li id="txt_last" data-id="con1" class="on"><span></span><a href="#tabs-1">일정 조율</a></li>
                      </ul>
                      <div id="tabs-1" class="conbox_10 conbox on">
                        
                        <div class="conbox_txt">
                          <p>참여한 견적이 선택되면 고객님과 상세 일정을 조율합니다</p>
                        </div>
                        <span class="con_img03n">icon</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="swiper_box">
                    <div class="tit">
                    </div>
                    <div class="con_step_title">
                        <span>STEP 4</span>
                      <h3>작업 후 정산</h3>
                    </div>
                    <div class="serv_con tab" id="tabs4">
                      <ul>
                        <li id="txt_last" data-id="con1" class="on"><span></span><a href="#tabs-1">작업 후 정산</a></li>

                      </ul>
                      <div id="tabs-1" class="conbox_11 conbox on">
                        <div class="conbox_txt">
                          <p>조율한 일정에 맞춰서 방문 수거/철거 및 배송 후 정산을 받습니다</p>
                         </div>
                         <span class="con_img04n">icon</span>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
</section>

<div style="margin-top:5%;" id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!-- 슬라이드 쇼 -->
          <div class="carousel-item active">
            <!-- <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div> -->
            <!--가로-->
            <picture>
              <source media="(max-width: 321px)" srcset="/bbs/images/i5.png">
              <source media="(max-width: 376px)" srcset="/bbs/images/i678.png">
              <source media="(max-width: 415px)" srcset="/bbs/images/iplus.png">
              <img style="width:100% !important" src="/bbs/images/web1.png" class="d-block w-100">
            </picture>

          </div>
          <div class="carousel-item ">
            <picture>
              <source media="(max-width: 321px)" srcset="/bbs/images/i52.png">
              <source media="(max-width: 376px)" srcset="/bbs/images/i6782.png">
              <source media="(max-width: 415px)" srcset="/bbs/images/iplus2.png">
              <img style="width:100% !important" src="/bbs/images/web2.png" class="d-block w-100">
            </picture>

          </div>
          <div class="carousel-item ">
            <div class="txt">
              <span><em class="txt01">우리동네 재활용센터 </em><em class="txt02">피커스</em><em class="txt03">중고전문가와 함께 하는 안심거래부터 공간정리까지</em></span>
            </div>
            <!--가로--> <img style="width:100% !important" class="d-block w-100" src="/bbs/images/main_banner.png" alt="비쥬얼이미지1">

          </div>

          <!-- / 슬라이드 쇼 끝 -->
          <!-- 왼쪽 오른쪽 화살표 버튼 -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <!-- <span>Previous</span> -->
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <!-- <span>Next</span> -->
          </a> <!-- / 화살표 버튼 끝 -->
          <!-- 인디케이터 -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <!--0번부터시작-->
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul> <!-- 인디케이터 끝 -->
        </div>
      </div>