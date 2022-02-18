
<?


    /* ============================================================================== */
    /* =   PAGE : 지불 요청 및 결과 처리 PAGE                                       = */
    /* = -------------------------------------------------------------------------- = */
    /* =   연동시 오류가 발생하는 경우 아래의 주소로 접속하셔서 확인하시기 바랍니다.= */
    /* =   접속 주소 : http://kcp.co.kr/technique.requestcode.do			        = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2013   KCP Inc.   All Rights Reserverd.                   = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   환경 설정 파일 Include                                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수                                                                  = */
    /* =   테스트 및 실결제 연동시 site_conf_inc.php파일을 수정하시기 바랍니다.     = */
    /* = -------------------------------------------------------------------------- = */
    // include "../common.php";
    include "./cfg/site_conf_inc.php";       // 환경설정 파일 include
    require "pp_ax_hub_lib.php";              // library [수정불가]

    /* = -------------------------------------------------------------------------- = */
    /* =   환경 설정 파일 Include END                                               = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   01. 지불 요청 정보 설정                                                  = */
    /* = -------------------------------------------------------------------------- = */
    $req_tx         = $_POST[ "req_tx"         ]; // 요청 종류
    $tran_cd        = $_POST[ "tran_cd"        ]; // 처리 종류
    /* = -------------------------------------------------------------------------- = */
    $cust_ip        = getenv( "REMOTE_ADDR"    ); // 요청 IP
    $ordr_idxx      = $_POST[ "ordr_idxx"      ]; // 쇼핑몰 주문번호
    $good_name      = $_POST[ "good_name"      ]; // 상품명
    $good_mny       = $_POST[ "good_mny"       ]; // 결제 총금액
    /* = -------------------------------------------------------------------------- = */
    $res_cd         = "";                         // 응답코드
    $res_msg        = "";                         // 응답메시지
    $tno            = $_POST[ "tno"            ]; // KCP 거래 고유 번호
    $escw_yn        = "";                         // 에스크로 여부
    $vcnt_yn        = $_POST[ "vcnt_yn"        ]; // 가상계좌 에스크로 사용 유무
    /* = -------------------------------------------------------------------------- = */
    $buyr_name      = $_POST[ "buyr_name"      ]; // 주문자명
    $buyr_tel1      = $_POST[ "buyr_tel1"      ]; // 주문자 전화번호
    $buyr_tel2      = $_POST[ "buyr_tel2"      ]; // 주문자 핸드폰 번호
    $buyr_mail      = $_POST[ "buyr_mail"      ]; // 주문자 E-mail 주소
    /* = -------------------------------------------------------------------------- = */
    $mod_type       = $_POST[ "mod_type"       ]; // 변경TYPE VALUE 승인취소시 필요
    $mod_desc       = $_POST[ "mod_desc"       ]; // 변경사유
    $panc_mod_mny   = "";                         // 부분취소 금액
    $panc_rem_mny   = "";                         // 부분취소 가능 금액
    $mod_tax_mny    = $_POST[ "mod_tax_mny"    ]; // 공급가 부분 취소 요청 금액
    $mod_vat_mny    = $_POST[ "mod_vat_mny"    ]; // 부과세 부분 취소 요청 금액
    $mod_free_mny   = $_POST[ "mod_free_mny"   ]; // 비과세 부분 취소 요청 금액
    /* = -------------------------------------------------------------------------- = */
    $use_pay_method = $_POST[ "use_pay_method" ]; // 결제 방법
    $bSucc          = "";                         // 업체 DB 처리 성공 여부
    /* = -------------------------------------------------------------------------- = */
    $app_time       = "";                         // 승인시간 (모든 결제 수단 공통)
    $amount         = "";                         // KCP 실제 거래 금액
    $coupon_mny     = "";                         // 쿠폰금액
    /* = -------------------------------------------------------------------------- = */
    $card_cd        = "";                         // 신용카드 코드
    $card_name      = "";                         // 신용카드 명
    $app_no         = "";                         // 신용카드 승인번호
    $noinf          = "";                         // 신용카드 무이자 여부
    $quota          = "";                         // 신용카드 할부개월
    $partcanc_yn    = "";                         // 부분취소 가능유무
    $card_bin_type_01 = "";                       // 카드구분1
    $card_bin_type_02 = "";                       // 카드구분2
    $card_mny       = "";                         // 카드금액
    /* = -------------------------------------------------------------------------- = */
    $bank_name      = "";                         // 은행명
    $bank_code      = "";                         // 은행코드
    $bk_mny         = "";                         // 계좌이체결제금액
    /* = -------------------------------------------------------------------------- = */
    $bankname       = "";                         // 입금할 은행명
    $depositor      = "";                         // 입금할 계좌 예금주 성명
    $account        = "";                         // 입금할 계좌 번호
    $va_date        = "";                         // 가상계좌 입금마감시간
    /* = -------------------------------------------------------------------------- = */
    $pnt_issue      = "";                         // 결제 포인트사 코드
    $pnt_amount     = "";                         // 적립금액 or 사용금액
    $pnt_app_time   = "";                         // 승인시간
    $pnt_app_no     = "";                         // 승인번호
    $add_pnt        = "";                         // 발생 포인트
    $use_pnt        = "";                         // 사용가능 포인트
    $rsv_pnt        = "";                         // 적립 포인트
    /* = -------------------------------------------------------------------------- = */
    $commid         = "";                         // 통신사 코드
    $mobile_no      = "";                         // 휴대폰 번호
    /* = -------------------------------------------------------------------------- = */
    $tk_van_code    = "";                         // 발급사 코드
    $tk_van_code    = "";                         // 발급사코드
    $tk_app_no      = "";                         // 상품권 승인 번호
    /* = -------------------------------------------------------------------------- = */
    $cash_yn        = $_POST[ "cash_yn"        ]; // 현금영수증 등록 여부
    $cash_authno    = "";                         // 현금 영수증 승인 번호
    $cash_tr_code   = $_POST[ "cash_tr_code"   ]; // 현금 영수증 발행 구분
    $cash_id_info   = $_POST[ "cash_id_info"   ]; // 현금 영수증 등록 번호
    /* ============================================================================== */
    /* =   01-1. 에스크로 지불 요청 정보 설정                                       = */
    /* = -------------------------------------------------------------------------- = */
    $escw_used      = $_POST[ "escw_used"      ]; // 에스크로 사용 여부
    $pay_mod        = $_POST[ "pay_mod"        ]; // 에스크로 결제처리 모드
    $deli_term      = $_POST[ "deli_term"      ]; // 배송 소요일
    $bask_cntx      = $_POST[ "bask_cntx"      ]; // 장바구니 상품 개수
    $good_info      = $_POST[ "good_info"      ]; // 장바구니 상품 상세 정보
    $rcvr_name      = $_POST[ "rcvr_name"      ]; // 수취인 이름
    $rcvr_tel1      = $_POST[ "rcvr_tel1"      ]; // 수취인 전화번호
    $rcvr_tel2      = $_POST[ "rcvr_tel2"      ]; // 수취인 휴대폰번호
    $rcvr_mail      = $_POST[ "rcvr_mail"      ]; // 수취인 E-Mail
    $rcvr_zipx      = $_POST[ "rcvr_zipx"      ]; // 수취인 우편번호
    $rcvr_add1      = $_POST[ "rcvr_add1"      ]; // 수취인 주소
    $rcvr_add2      = $_POST[ "rcvr_add2"      ]; // 수취인 상세주소
    /* ============================================================================== */
    /* =   01-1. 에스크로 지불 요청 정보 설정 End                                   = */
    /* = -------------------------------------------------------------------------- = */
    $param_opt_1    = $_POST[ "param_opt_1" ];
    $param_opt_2    = $_POST[ "param_opt_2" ];
    $param_opt_3    = $_POST[ "param_opt_3" ];

    /* ============================================================================== */
    /* =   01. 지불 요청 정보 설정 END												= */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   02. 인스턴스 생성 및 초기화                                              = */
    /* = -------------------------------------------------------------------------- = */
    /* =       결제에 필요한 인스턴스를 생성하고 초기화 합니다.                     = */
    /* = -------------------------------------------------------------------------- = */
    $c_PayPlus = new C_PP_CLI;

    $c_PayPlus->mf_clear();
    /* ------------------------------------------------------------------------------ */
	/* =   02. 인스턴스 생성 및 초기화 END											= */
	/* ============================================================================== */


    /* ============================================================================== */
    /* =   03. 처리 요청 정보 설정                                                  = */
    /* = -------------------------------------------------------------------------- = */

    /* = -------------------------------------------------------------------------- = */
    /* =   03-1. 승인 요청                                                          = */
    /* = -------------------------------------------------------------------------- = */
    if ( $req_tx == "pay" )
    {
            /* 1004원은 실제로 업체에서 결제하셔야 될 원 금액을 넣어주셔야 합니다. 결제금액 유효성 검증 */
            /* $c_PayPlus->mf_set_ordr_data( "ordr_mony",  "1004" );                                    */

            $c_PayPlus->mf_set_encx_data( $_POST[ "enc_data" ], $_POST[ "enc_info" ] );
    }

    /* = -------------------------------------------------------------------------- = */
    /* =   03-2. 취소/매입 요청                                                     = */
    /* = -------------------------------------------------------------------------- = */
    else if ( $req_tx == "mod" )
    {
        $tran_cd = "00200000";

        $c_PayPlus->mf_set_modx_data( "tno",      $tno      ); // KCP 원거래 거래번호
        $c_PayPlus->mf_set_modx_data( "mod_type", $mod_type ); // 원거래 변경 요청 종류
        $c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip  ); // 변경 요청자 IP
        $c_PayPlus->mf_set_modx_data( "mod_desc", $mod_desc ); // 변경 사유

        if ( $mod_type == "STPC" )
        {
           $c_PayPlus->mf_set_modx_data( "mod_mny", $_POST[ "mod_mny" ] ); // 취소요청금액
           $c_PayPlus->mf_set_modx_data( "rem_mny", $_POST[ "rem_mny" ] ); // 취소가능잔액

            //복합거래 부분 취소시 주석을 풀어 주시기 바랍니다.
	        //$c_PayPlus->mf_set_modx_data( "tax_flag",     "TG03"        ); // 복합과세 구분
            //$c_PayPlus->mf_set_modx_data( "mod_tax_mny",  $mod_tax_mny  ); // 공급가 부분 취소 요청 금액
            //$c_PayPlus->mf_set_modx_data( "mod_vat_mny",  $mod_vat_mny  ); // 부과세 부분 취소 요청 금액
            //$c_PayPlus->mf_set_modx_data( "mod_free_mny", $mod_free_mny ); // 비과세 부분 취소 요청 금액
        }
    }
	/* = -------------------------------------------------------------------------- = */
    /* =   03-3. 에스크로 상태변경 요청                                             = */
    /* = -------------------------------------------------------------------------- = */
    else if ($req_tx = "mod_escrow")
    {
        $tran_cd = "00200000";

        $c_PayPlus->mf_set_modx_data( "tno",      $tno      );                      // KCP 원거래 거래번호
        $c_PayPlus->mf_set_modx_data( "mod_type", $mod_type );                      // 원거래 변경 요청 종류
        $c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip  );                      // 변경 요청자 IP
        $c_PayPlus->mf_set_modx_data( "mod_desc", $mod_desc );                      // 변경 사유 
        
        if ($mod_type == "STE1")                                                    // 상태변경 타입이 [배송요청]인 경우
        {
            $c_PayPlus->mf_set_modx_data( "deli_numb",   $_POST[ "deli_numb" ] );   // 운송장 번호
            $c_PayPlus->mf_set_modx_data( "deli_corp",   $_POST[ "deli_corp" ] );   // 택배 업체명
        }
        else if ($mod_type == "STE2" || $mod_type == "STE4") // 상태변경 타입이 [즉시취소] 또는 [취소]인 계좌이체, 가상계좌의 경우
        {
            if ($vcnt_yn == "Y")
            {
                $c_PayPlus->mf_set_modx_data( "refund_account",   $_POST[ "refund_account" ] );      // 환불수취계좌번호
                $c_PayPlus->mf_set_modx_data( "refund_nm",        $_POST[ "refund_nm"      ] );      // 환불수취계좌주명
                $c_PayPlus->mf_set_modx_data( "bank_code",        $_POST[ "bank_code"      ] );      // 환불수취은행코드
            }
        }
    }
	/* ------------------------------------------------------------------------------ */
	/* =   03.  처리 요청 정보 설정 END  											= */
	/* ============================================================================== */



    /* ============================================================================== */
    /* =   04. 실행                                                                 = */
    /* = -------------------------------------------------------------------------- = */
    if ( $tran_cd != "" )
    {
        $c_PayPlus->mf_do_tx( $trace_no, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
                              $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
                              $cust_ip, $g_conf_log_level, 0, 0 ); // 응답 전문 처리
		
		$res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
		$res_msg = $c_PayPlus->m_res_msg; // 결과 메시지
    }
    else
    {
        $c_PayPlus->m_res_cd  = "9562";
        $c_PayPlus->m_res_msg = "연동 오류|tran_cd값이 설정되지 않았습니다.";
    }

    
    /* = -------------------------------------------------------------------------- = */
    /* =   04. 실행 END                                                             = */
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   05. 승인 결과 값 추출                                                    = */
    /* = -------------------------------------------------------------------------- = */
    if ( $req_tx == "pay" )
    {
        if( $res_cd == "0000" )
        {
            $tno        = $c_PayPlus->mf_get_res_data( "tno"       );   // KCP 거래 고유 번호
            $amount     = $c_PayPlus->mf_get_res_data( "amount"    );   // KCP 실제 거래 금액
            $app_time   = $c_PayPlus->mf_get_res_data( "app_time"  );   // 승인시간
            $pnt_issue  = $c_PayPlus->mf_get_res_data( "pnt_issue" );   // 결제 포인트사 코드
            $coupon_mny = $c_PayPlus->mf_get_res_data( "coupon_mny" );  // 쿠폰금액

    /* = -------------------------------------------------------------------------- = */
    /* =   05-1. 신용카드 승인 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "100000000000" )
            {
                $card_cd     = $c_PayPlus->mf_get_res_data( "card_cd"   ); // 카드사 코드
                $card_name   = $c_PayPlus->mf_get_res_data( "card_name" ); // 카드 종류
                $app_no      = $c_PayPlus->mf_get_res_data( "app_no"    ); // 승인 번호
                $noinf       = $c_PayPlus->mf_get_res_data( "noinf"     ); // 무이자 여부 ( 'Y' : 무이자 )
                $quota       = $c_PayPlus->mf_get_res_data( "quota"     ); // 할부 개월 수
                $partcanc_yn = $c_PayPlus->mf_get_res_data( "partcanc_yn" );           // 부분취소 가능유무
                $card_bin_type_01 = $c_PayPlus->mf_get_res_data( "card_bin_type_01" ); // 카드구분1
                $card_bin_type_02 = $c_PayPlus->mf_get_res_data( "card_bin_type_02" ); // 카드구분2
                $card_mny    = $c_PayPlus->mf_get_res_data( "card_mny"  ); // 카드결제금액
            }

	/* = -------------------------------------------------------------------------- = */
    /* =   05-2. 계좌이체 승인 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "010000000000" )
            {
                $bank_name = $c_PayPlus->mf_get_res_data( "bank_name"  ); // 은행명
                $bank_code = $c_PayPlus->mf_get_res_data( "bank_code"  ); // 은행코드
                $bk_mny    = $c_PayPlus->mf_get_res_data( "bk_mny"     ); // 계좌이체결제금액
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-3. 가상계좌 승인 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "001000000000" )
            {
                $bankname  = $c_PayPlus->mf_get_res_data( "bankname"  ); // 입금할 은행 이름
                $depositor = $c_PayPlus->mf_get_res_data( "depositor" ); // 입금할 계좌 예금주
                $account   = $c_PayPlus->mf_get_res_data( "account"   ); // 입금할 계좌 번호
                $va_date   = $c_PayPlus->mf_get_res_data( "va_date"   ); // 가상계좌 입금마감시간
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-4. 포인트 승인 결과 처리                                               = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "000100000000" )
            {
                $pnt_amount   = $c_PayPlus->mf_get_res_data( "pnt_amount"   ); // 적립금액 or 사용금액
                $pnt_app_time = $c_PayPlus->mf_get_res_data( "pnt_app_time" ); // 승인시간
                $pnt_app_no   = $c_PayPlus->mf_get_res_data( "pnt_app_no"   ); // 승인번호 
                $add_pnt      = $c_PayPlus->mf_get_res_data( "add_pnt"      ); // 발생 포인트
                $use_pnt      = $c_PayPlus->mf_get_res_data( "use_pnt"      ); // 사용가능 포인트
                $rsv_pnt      = $c_PayPlus->mf_get_res_data( "rsv_pnt"      ); // 적립 포인트
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-5. 휴대폰 승인 결과 처리                                              = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "000010000000" )
            {
                $app_time  = $c_PayPlus->mf_get_res_data( "hp_app_time"  ); // 승인 시간
                $commid    = $c_PayPlus->mf_get_res_data( "commid"	     ); // 통신사 코드
                $mobile_no = $c_PayPlus->mf_get_res_data( "mobile_no"	 ); // 휴대폰 번호
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-6. 상품권 승인 결과 처리                                              = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "000000001000" )
            {
                $app_time    = $c_PayPlus->mf_get_res_data( "tk_app_time"  ); // 승인 시간
                $tk_van_code = $c_PayPlus->mf_get_res_data( "tk_van_code"  ); // 발급사 코드
                $tk_app_no   = $c_PayPlus->mf_get_res_data( "tk_app_no"    ); // 승인 번호
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-7. 현금영수증 결과 처리                                               = */
    /* = -------------------------------------------------------------------------- = */
            $cash_authno  = $c_PayPlus->mf_get_res_data( "cash_authno"  ); // 현금 영수증 승인 번호

        }
    /* = -------------------------------------------------------------------------- = */
    /* =   05-8. 에스크로 여부 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */
        $escw_yn   = $c_PayPlus->mf_get_res_data( "escw_yn"   ); // 에스크로 여부
    }
    /* = -------------------------------------------------------------------------- = */
    /* =   05-9. 부분취소 결과 처리                                                 = */
    /* = -------------------------------------------------------------------------- = */
    if ( $req_tx == "mod" )
    {
        if ( $res_cd == "0000" )
        {
            if ( $mod_type == "STPC" )
            {
                $amount       = $c_PayPlus->mf_get_res_data( "amount"       ); // 총 금액
                $panc_mod_mny = $c_PayPlus->mf_get_res_data( "panc_mod_mny" ); // 부분취소 요청금액
                $panc_rem_mny = $c_PayPlus->mf_get_res_data( "panc_rem_mny" ); // 부분취소 가능금액
            }
        }
    }
    /* = -------------------------------------------------------------------------- = */
    /* =   05. 승인 결과 처리 END                                                   = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   06. 승인 및 실패 결과 DB처리                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* =       결과를 업체 자체적으로 DB처리 작업하시는 부분입니다.                 = */
    /* = -------------------------------------------------------------------------- = */

    if ( $req_tx == "pay" )
    {
        if( $res_cd == "0000" )
        {
            // 06-1-1. 신용카드
            if ( $use_pay_method == "100000000000" )
            {
            }
            // 06-1-2. 계좌이체
            if ( $use_pay_method == "010000000000" )
            {
            }
            // 06-1-3. 가상계좌
            if ( $use_pay_method == "001000000000" )
            {
            }
            // 06-1-4. 포인트
            if ( $use_pay_method == "000100000000" )
            {
            }
            // 06-1-5. 휴대폰
            if ( $use_pay_method == "000010000000" )
            {
            }
            // 06-1-6. 상품권
             if ( $use_pay_method == "000000001000" )
            {
            }
        }

    /* = -------------------------------------------------------------------------- = */
    /* =   06. 승인 및 실패 결과 DB처리                                             = */
    /* ============================================================================== */
        else if ( $res_cd != "0000" )
        {
        }
    }
    
    /* ============================================================================== */
    /* =   07. 승인 결과 DB처리 실패시 : 자동취소                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =         승인 결과를 DB 작업 하는 과정에서 정상적으로 승인된 건에 대해      = */
    /* =         DB 작업을 실패하여 DB update 가 완료되지 않은 경우, 자동으로       = */
    /* =         승인 취소 요청을 하는 프로세스가 구성되어 있습니다.                = */
    /* =                                                                            = */
    /* =         DB 작업이 실패 한 경우, bSucc 라는 변수(String)의 값을 "false"     = */
    /* =         로 설정해 주시기 바랍니다. (DB 작업 성공의 경우에는 "false" 이외의 = */
    /* =         값을 설정하시면 됩니다.)                                           = */
    /* = -------------------------------------------------------------------------- = */
    
    $bSucc = ""; // DB 작업 실패 또는 금액 불일치의 경우 "false" 로 세팅

    /* = -------------------------------------------------------------------------- = */
    /* =   07-1. DB 작업 실패일 경우 자동 승인 취소                                 = */
    /* = -------------------------------------------------------------------------- = */
    if ( $req_tx == "pay" )
    {
        if( $res_cd == "0000" )
        {
            if ( $bSucc == "false" )
            {
                $c_PayPlus->mf_clear();

                $tran_cd = "00200000";

	/* ============================================================================== */
    /* =   07-1.자동취소시 에스크로 거래인 경우                                     = */
    /* = -------------------------------------------------------------------------- = */
                // 취소시 사용하는 mod_type
                $bSucc_mod_type = "";

                // 에스크로 가상계좌 건의 경우 가상계좌 발급취소(STE5)
                if ( $escw_yn == "Y" && $use_pay_method == "001000000000" )
                {
                    $bSucc_mod_type = "STE5";
                }
                // 에스크로 가상계좌 이외 건은 즉시취소(STE2)
                else if ( $escw_yn == "Y" )
                {
                    $bSucc_mod_type = "STE2";
                }
                // 에스크로 거래 건이 아닌 경우(일반건)(STSC)
                else
                {
                    $bSucc_mod_type = "STSC"; 
                }
	/* = -------------------------------------------------------------------------- = */
	/* =   07-1. 자동취소시 에스크로 거래인 경우 처리 END                           = */
    /* = ========================================================================== = */
                
                $c_PayPlus->mf_set_modx_data( "tno",      $tno                         );  // KCP 원거래 거래번호
                $c_PayPlus->mf_set_modx_data( "mod_type", $bSucc_mod_type              );  // 원거래 변경 요청 종류
                $c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip                     );  // 변경 요청자 IP
                $c_PayPlus->mf_set_modx_data( "mod_desc", "가맹점 결과 처리 오류 - 가맹점에서 취소 요청" );  // 변경 사유

                $c_PayPlus->mf_do_tx( "",  $g_conf_home_dir, $g_conf_site_cd,
                                      $g_conf_site_key,  $tran_cd,    "",
                                      $g_conf_gw_url,  $g_conf_gw_port,  "payplus_cli_slib",
                                      $ordr_idxx, $cust_ip,    $g_conf_log_level,
                                      0, 0 );

                $res_cd  = $c_PayPlus->m_res_cd;
                $res_msg = $c_PayPlus->m_res_msg;
            }else{

				if($ordr_idxx){
					$_POST[TRADE_CODE]=$ordr_idxx;

					if(!$_POST[TRADE_CODE]) { $tools->alertJavaGo('결제 오류 입니다.\n\n처음부터 다시 주문하세요\\n오류코드 : '.$res_cd, 'cart.php');}

					// 구매 상품 입력
					$cnt1=$db->cnt("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]'");
					if($cnt1){
						$trade1_result=$db->select("cs_trade_tmp", "where item=0 and code is not null and code='$_POST[TRADE_CODE]' order by idx asc");
						while($trade1_row=@mysqli_fetch_object($trade1_result)) {
							$trade1_data	= $tools->decode( $trade1_row->data );
							$trade1_data[goods_name]=$db->addSlash(urldecode($trade1_data[goods_name]));
							//$db->insert("cs_trade_goods", "trade_code='$trade1_data[trade_code]', part_idx='$trade1_data[part_idx]', goods_idx='$trade1_data[goods_idx]', goods_code='$trade1_data[goods_code]', goods_name='$trade1_data[goods_name]', goods_price='$trade1_data[goods_price]', goods_cnt='$trade1_data[goods_cnt]', goods_point='$trade1_data[goods_point]', opt_data='$trade1_data[opt_data]', trade_day=now()");
                            $db->insert("cs_trade_goods", "trade_code='$trade1_data[trade_code]', part_idx='$trade1_data[part_idx]', goods_idx='$trade1_data[goods_idx]', goods_code='$trade1_data[goods_code]', goods_name='$trade1_data[goods_name]', goods_price='$trade1_data[goods_price]', trade_price='$trade1_data[trade_price]',  goods_cnt='$trade1_data[goods_cnt]', goods_point='$trade1_data[goods_point]', opt_data='$trade1_data[opt_data]', seller='$trade1_data[seller]', order_userid='$trade1_data[order_userid]', order_name='$trade1_data[order_name]', trade_deliv_price='$trade1_data[deliv_fee]', trade_day=now()");
							// 주문한 상품에서 수량을 삭제
							$goods_stat =$db->object("cs_goods", "where idx='$trade1_data[goods_idx]'");
							if($goods_stat->unlimit!=1) {
								$number=$goods_stat->number - $trade1_data[goods_cnt];
								$db->update("cs_goods", "number=$number where idx='$trade1_data[goods_idx]'");
							}

							//상품의 재구매처리가안되게 결과물 아이템변경
							$db->update("cs_trade_tmp", "item=5 where item=0 and code is not null and code='$_POST[TRADE_CODE]'");
						}
					}

					$cnt2=$db->cnt("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
					if($cnt2){
						$trade2_data_stat = $db->object("cs_trade_tmp", "where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
						$trade2_data	= $tools->decode( $trade2_data_stat->data );
						$db->insert("cs_trade", "trade_code='$trade2_data[trade_code]', order_userid='$trade2_data[order_userid]', order_name='$trade2_data[order_name]', order_email='$trade2_data[order_email]', order_tel1='$trade2_data[order_tel1]', order_tel2='$trade2_data[order_tel2]', order_tel3='$trade2_data[order_tel3]', deliv_name='$trade2_data[deliv_name]', deliv_email='$trade2_data[deliv_email]', deliv_tel1='$trade2_data[deliv_tel1]', deliv_tel2='$trade2_data[deliv_tel2]', deliv_tel3='$trade2_data[deliv_tel3]', deliv_phone1='$trade2_data[deliv_phone1]', deliv_phone2='$trade2_data[deliv_phone2]', deliv_phone3='$trade2_data[deliv_phone3]', deliv_zip='$trade2_data[deliv_zip]', deliv_add1='$trade2_data[deliv_add1]', deliv_add2='$trade2_data[deliv_add2]', deliv_content='$trade2_data[deliv_content]', deliv_pree_day='$trade2_data[deliv_pree_day]',tno = '$tno'");
						
						//상품의 재구매처리가안되게 결과물 아이템변경
						$db->update("cs_trade_tmp", "item=6 where item=1 and code is not null and code='$_POST[TRADE_CODE]'");
					}
					// 결제 정보 입력
					$cnt3=$db->cnt("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
					if($cnt3){
						$trade3_data_stat = $db->object("cs_trade_tmp", "where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
						$trade3_data	= $tools->decode( $trade3_data_stat->data );
						
						
						if ( $trade3_data[trade_method] == 4){
							$trade_method_info = $depositor.":".$bankname." [".$account."]";
						}else{
							$trade_method_info = $trade3_data[trade_method_info];
						}	
						
						$db->update("cs_trade", "trade_code='$trade3_data[trade_code]', trade_total_price='$trade3_data[trade_total_price]', trade_price='$trade3_data[trade_price]', trade_use_point='$trade3_data[trade_use_point]', trade_save_point='$trade3_data[trade_save_point]', trade_member_dc='$trade3_data[trade_member_dc]', trade_deliv_price='$trade3_data[trade_deliv_price]', trade_method='$trade3_data[trade_method]', trade_method_info='$trade_method_info', trade_day=now(), trade_stat=1 where trade_code='$trade2_data[trade_code]'");
						
						// 사용한 포인트를 삭제 사용포인트가 있을때만 이용
						if($trade3_data[trade_use_point] !=0 && $trade2_data[order_userid]) {
							$title="상품구입사용 거래번호 : ".$_POST[TRADE_CODE];
							$db->insert("cs_point", "userid='$trade2_data[order_userid]', title='$title', point='-$trade3_data[trade_use_point]', register=now()");
						}
						
						//상품의 재구매처리가안되게 결과물 아이템변경
						$db->update("cs_trade_tmp", "item=7 where item=2 and code is not null and code='$_POST[TRADE_CODE]'");
					}
				}
            }
        }
    } // End of [res_cd = "0000"]
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   08. 폼 구성 및 결과페이지 호출                                           = */
    /* ============================================================================== */
?>
    <html>
    <head>
        <title>스마트폰 웹 결제창</title>
        <script type="text/javascript">
            function goResult()
            {
                
                document.pay_info.submit()
            }

            // 결제 중 새로고침 방지 샘플 스크립트 (중복결제 방지)
            function noRefresh()
            {
                /* CTRL + N키 막음. */
                if ((event.keyCode == 78) && (event.ctrlKey == true))
                {
                    event.keyCode = 0;
                    return false;
                }
                /* F5 번키 막음. */
                if(event.keyCode == 116)
                {
                    event.keyCode = 0;
                    return false;
                }
            }
            document.onkeydown = noRefresh ;
        </script>
    </head>

    <body onload="goResult()">
    <form name="pay_info" method="post" action="../<?=$skin_url?>/order_trade_end_ok.php">
        <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd   ?>">    <!-- 사이트 코드 -->
        <input type="hidden" name="req_tx"          value="<?=$req_tx           ?>">    <!-- 요청 구분 -->
        <input type="hidden" name="use_pay_method"  value="<?=$use_pay_method	?>">    <!-- 사용한 결제 수단 -->
        <input type="hidden" name="bSucc"           value="<?=$bSucc            ?>">    <!-- 쇼핑몰 DB 처리 성공 여부 -->
        <input type="hidden" name="panc_mod_mny"    value="<?=$panc_mod_mny     ?>">    <!-- 부분취소 금액 -->
        <input type="hidden" name="panc_rem_mny"    value="<?=$panc_rem_mny     ?>">    <!-- 부분취소 가능금액 -->
        <input type="hidden" name="mod_type"        value="<?=$mod_type         ?>">    <!-- 취소 타입 -->

        <input type="hidden" name="amount"          value="<?=$amount           ?>">    <!-- 금액 -->
        <input type="hidden" name="res_cd"          value="<?=$res_cd           ?>">    <!-- 결과 코드 -->
        <input type="hidden" name="res_msg"         value="<?=$res_msg          ?>">    <!-- 결과 메세지 -->
        <input type="hidden" name="ordr_idxx"       value="<?=$ordr_idxx        ?>">    <!-- 주문번호 -->
        <input type="hidden" name="tno"             value="<?=$tno              ?>">    <!-- KCP 거래번호 -->
        <input type="hidden" name="good_mny"        value="<?=$good_mny         ?>">    <!-- 결제금액 -->
        <input type="hidden" name="good_name"       value="<?=$good_name        ?>">    <!-- 상품명 -->
        <input type="hidden" name="buyr_name"       value="<?=$buyr_name        ?>">    <!-- 주문자명 -->
        <input type="hidden" name="buyr_tel1"       value="<?=$buyr_tel1        ?>">    <!-- 주문자 전화번호 -->
        <input type="hidden" name="buyr_tel2"       value="<?=$buyr_tel2        ?>">    <!-- 주문자 휴대폰번호 -->
        <input type="hidden" name="buyr_mail"       value="<?=$buyr_mail        ?>">    <!-- 주문자 E-mail -->
        <input type="hidden" name="app_time"        value="<?=$app_time         ?>">    <!-- 승인시간 -->

        <!-- 신용카드 정보 -->
        <input type="hidden" name="card_cd"         value="<?=$card_cd          ?>">    <!-- 카드코드 -->
        <input type="hidden" name="card_name"       value="<?=$card_name        ?>">    <!-- 카드이름 -->
        <input type="hidden" name="app_no"          value="<?=$app_no           ?>">    <!-- 승인번호 -->
        <input type="hidden" name="noinf"           value="<?=$noinf            ?>">    <!-- 무이자여부 -->
        <input type="hidden" name="quota"           value="<?=$quota            ?>">    <!-- 할부개월 -->
        <input type="hidden" name="partcanc_yn"     value="<?=$partcanc_yn      ?>">    <!-- 부분취소가능유무 -->
        <input type="hidden" name="card_bin_type_01"value="<?=$card_bin_type_01 ?>">    <!-- 카드구분1 -->
        <input type="hidden" name="card_bin_type_02"value="<?=$card_bin_type_02 ?>">    <!-- 카드구분2 -->

        <!-- 계좌이체 정보 -->
        <input type="hidden" name="bank_name"       value="<?=$bank_name        ?>">    <!-- 은행명 -->
        <input type="hidden" name="bank_code"       value="<?=$bank_code        ?>">    <!-- 은행코드 -->

        <!-- 가상계좌 정보 -->
        <input type="hidden" name="bankname"        value="<?=$bankname         ?>">    <!-- 입금 은행 -->
        <input type="hidden" name="depositor"       value="<?=$depositor        ?>">    <!-- 입금계좌 예금주 -->
        <input type="hidden" name="account"         value="<?=$account          ?>">    <!-- 입금계좌 번호 -->
        <input type="hidden" name="va_date"         value="<?=$va_date          ?>">    <!-- 가상계좌 입금마감시간 -->

        <!-- 포인트 정보 -->
        <input type="hidden" name="pnt_issue"       value="<?=$pnt_issue        ?>">    <!-- 포인트 서비스사 -->
        <input type="hidden" name="pnt_app_time"    value="<?=$pnt_app_time     ?>">    <!-- 승인시간 -->
        <input type="hidden" name="pnt_app_no"      value="<?=$pnt_app_no       ?>">    <!-- 승인번호 -->
        <input type="hidden" name="pnt_amount"      value="<?=$pnt_amount       ?>">    <!-- 적립금액 or 사용금액 -->
        <input type="hidden" name="add_pnt"         value="<?=$add_pnt          ?>">    <!-- 발생 포인트 -->
        <input type="hidden" name="use_pnt"         value="<?=$use_pnt          ?>">    <!-- 사용가능 포인트 -->
        <input type="hidden" name="rsv_pnt"         value="<?=$rsv_pnt          ?>">    <!-- 총 누적 포인트 -->

        <!-- 휴대폰 정보 -->
        <input type="hidden" name="commid"          value="<?=$commid           ?>">    <!-- 통신사 코드 -->
        <input type="hidden" name="mobile_no"       value="<?=$mobile_no        ?>">    <!-- 휴대폰 번호 -->
        <input type="hidden" name="van_cd"          value="<?=$van_cd           ?>">    <!-- 휴대폰 번호 -->
        <input type="hidden" name="amount"          value="<?=$amount           ?>">    <!-- 휴대폰 번호 -->

        <!-- 상품권 정보 -->
        <input type="hidden" name="tk_van_code"     value="<?=$tk_van_code      ?>">    <!-- 발급사 코드 -->
        <input type="hidden" name="tk_app_no"       value="<?=$tk_app_no        ?>">    <!-- 승인 번호 -->

        <!-- 현금영수증 정보 -->
        <input type="hidden" name="cash_yn"         value="<?=$cash_yn          ?>">    <!-- 현금영수증 등록 여부 -->
        <input type="hidden" name="cash_authno"     value="<?=$cash_authno      ?>">    <!-- 현금 영수증 승인 번호 -->
        <input type="hidden" name="cash_tr_code"    value="<?=$cash_tr_code     ?>">    <!-- 현금 영수증 발행 구분 -->
        <input type="hidden" name="cash_id_info"    value="<?=$cash_id_info     ?>">    <!-- 현금 영수증 등록 번호 -->

        <!-- 에스크로 정보 -->
        <input type="hidden" name="escw_yn"         value="<?=$escw_yn          ?>">    <!-- 에스크로 유무 -->
        <input type="hidden" name="deli_term"       value="<?=$deli_term        ?>">    <!-- 배송 소요일 -->
        <input type="hidden" name="bask_cntx"       value="<?=$bask_cntx        ?>">    <!-- 장바구니 상품 개수 -->
        <input type="hidden" name="good_info"       value="<?=$good_info        ?>">    <!-- 장바구니 상품 상세 정보 -->
        <input type="hidden" name="rcvr_name"       value="<?=$rcvr_name        ?>">    <!-- 수취인 이름 -->
        <input type="hidden" name="rcvr_tel1"       value="<?=$rcvr_tel1        ?>">    <!-- 수취인 전화번호 -->
        <input type="hidden" name="rcvr_tel2"       value="<?=$rcvr_tel2        ?>">    <!-- 수취인 휴대폰번호 -->
        <input type="hidden" name="rcvr_mail"       value="<?=$rcvr_mail        ?>">    <!-- 수취인 E-Mail -->
        <input type="hidden" name="rcvr_zipx"       value="<?=$rcvr_zipx        ?>">    <!-- 수취인 우편번호 -->
        <input type="hidden" name="rcvr_add1"       value="<?=$rcvr_add1        ?>">    <!-- 수취인 주소 -->
        <input type="hidden" name="rcvr_add2"       value="<?=$rcvr_add2        ?>">    <!-- 수취인 상세주소 -->

        <input type="hidden" name="param_opt_1"     value="<?=$param_opt_1 ?>">
        <input type="hidden" name="param_opt_2"     value="<?=$param_opt_2 ?>">
        <input type="hidden" name="param_opt_3"     value="<?=$param_opt_3 ?>">
    </form>
    </body>
    </html>
