<?php
    use model\Agent;

    User::isLogin(Input::get('sid') ?: Input::post('sid'));

    /* 檢查頁面是否有權限 */
    Route::match('page/page', function() {

        Route::requestByHtml();

        $page = URI::segment(1);
        return Agent::allowView($page);
    });

    /* 檢查 gateway cmd 是否有權限 */
    Route::match('pub/gateway', function() {
        $site = Input::get('site');
        $cmd = intval(Input::get('cmd'));
        $is_login = User::isLogin();

        Route::requestByJson();

        if ($site === null) return false;

        /* 後台 api */
        if ($site == 0) {

            /* 不需登入也可拜訪的 api */
            $allow = array(
                0, /* 登入 ajax */
            );

            /* 未登入 */
            if (! $is_login) {

                return in_array($cmd, $allow);

            } else {

                /**
                 * page 與 api 的規則為:
                 *     page01 api > c100 ~ c199,
                 *     page02 api > c200 ~ c299
                 *     以此類推
                 */
                $value = floor($cmd / 100);
                $page = 'page' . ($value > 9 ? $value : "0{$value}");
                return Agent::allowView($page);

            }


        /* app (前端) api */
        } else {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: get, post, put, delete, options');
            header("Access-Control-Allow-Headers: x-requested-with");
            $allow = array(
                0, /* 登入 */
                1, /* 儲存 app registe id | unregister */
                2, /* 縣市鄉鎮郵地區號 */
                3, /* 密碼重新設定 */
                4, /* 銀行代號 */
                5, /* mobile title images */
                100, /* 取得 app 首頁的商品 & 主力產品 */
                101, /* 同步購物車商品資料 */
                102, /* 取得某分類的商品清單 */
                103, /* 取得商品詳細資料 */
                // 104, /* 取得下單資料 */
                // 105, /* 下訂單 */
                201, /* 取得推薦人資料 */
                // 202, /* 取得某會員詳細資料 */
                203, /* 會員註冊 */
                301, /* 取得門市資料 */
                302, /* 取得最新消息 */
                303, /* 取得商品的影片清單 */
                304, /* 取重設密碼(寄送簡訊網址) */
            );

            if (! $is_login) {
                return in_array($cmd, $allow);
            }

        }
        return true;
    });

    /* 執行檢查 */
    if (! Route::execute()) {
        if (Input::isAjax() || Route::requestType() == Route::TYPE_JSON) {
            exit(json_encode(
                array(
                    'status' => false,
                    'logout' => true,
                    'message' => 'Not allow. (您已被登出, 請重新登入)'
                )
            ));
        } else {
            $tpl->display('not_allow.tpl');
            exit;
        }

    }






    // use model\Agent;

    // /* 用 sid 執行登入檢查 */
    // User::isLogin(Input::get('sid') ?: Input::post('sid'));
    // $app_allow_cmds = array(
    //     0,
    //     1,
    //     100, /* 取得產品類型 */
    //     101, /* 取得主力產品清單 */
    //     102, /* 取得某分類的產品清單 */
    //     103, /* 取得產品詳細資料 */
    //     104, /* 取得下單資料(下訂單前的動作 ) */
    //     105, /* 下單結帳 */
    //     201, /* 取得推薦人資料 */
    //     203, /* 註冊會員 */
    // );
    // // exit(var_dump(Agent::allowPages()));

    // $uri_path = $_SERVER['PHP_SELF'] ?: $_SERVER['SCRIPT_NAME'];
    // $cmd = intval(Input::get('cmd'));
    // $site = intval(Input::get('site'));
    // if (
    //     URI::segment(0) === 'page' && (
    //         URI::segment(1) !== 'webhome.php' &&
    //         URI::segment(1) !== 'home' &&
    //         URI::segment(1) !== 'header.php' &&
    //         (! Agent::allowView(URI::segment(1)))
    //     )
    // ) {
    //     $msg = User::getFailMessage();
    //     exit($msg ?: 'Not Allow. ');
    // }


    // switch (URI::segment(0)) {
    //     case null:
    //     case 'index.php':
    //     case '/page/webhome.php':
    //     case ($uri_path === '/pub/gateway.php') &&
    //         (
    //             ($cmd === 0) ||
    //             ($site === 1 && in_array($cmd, $app_allow_cmds))
    //         ):
    //         break;
    //     default :
    //         if (! Agent::allowView(URI::segment(1))) {
    //         }

    //     /* 檢查 user 是否有登入資訊 */
    //     // default Agent::allowView(:
    //         // if (! User::isLogin()) {
    //         //     exit('No login.' . $uri_path . Input::get('cmd'));
    //         // }
    // }
        // }
