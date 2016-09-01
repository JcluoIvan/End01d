<?php
    use model\Agent;
    include '../conf/config.php';

    $sid = User::sid() ?: 0;
    $rows = array(
        array('page11'  , "/page/page11/main.php?sid={$sid}", '會員管理'),  /* 會計專屬 */
        array('page13'  , "/page/page13/main.php?sid={$sid}", '會員管理'),  /* 展示中心專屬 */
        array('page01'  , "/page/page01/main.php?sid={$sid}", '會員管理'),  /* 最高權限專屬 */
        array('page02'  , "/page/page02/main.php?sid={$sid}", '庫存管理'),
        array('page03'  , "/page/page03/main.php?sid={$sid}", '訂單管理'),
        array('page12'  , "/page/page12/main.php?sid={$sid}", '訂單管理'),
        array('page04'  , "/page/page04/main.php?sid={$sid}", '通知'),
        array('page05'  , "/page/page05/main.php?sid={$sid}", '統計報表'),
        array('page06'  , "/page/page06/main.php?sid={$sid}", '購物金'),
        array('page07'  , "/page/page07/main.php?sid={$sid}", '業務獎金'),
        array('page08'  , "/page/page08/main.php?sid={$sid}", '展示中心'),
        array('page09'  , "/page/page09/main.php?sid={$sid}", '專業經理人'),
        array('page10'  , "/page/page10/main.php?sid={$sid}", '客服專頁'),
        array('page98'  , "/page/page98/main.php?sid={$sid}", '個人資料修改'),
        array('page97'  , "/page/page97/main.php?sid={$sid}", 'App 相關設定'),
        array('page99'  , "/page/page99/main.php?sid={$sid}", '系統'),
        // array('test'    , "/page/test/main.php?sid={$sid}", '臨時 cmd W 測試頁'),
        array('logout'  , "/page/logout.php?sid={$sid}", '登出'),
    );
    $allow = Agent::allowPages() ?: array();
    $pages = array();
    foreach ($rows as $row) {
        if (preg_match('/^page/', $row[0]) && ! in_array($row[0], $allow)) {
        } else {
            $pages[] = array('url' => $row[1], 'label' => $row[2]);
        }
    }

    $tpl->assign('pages', $pages);
    $tpl->display('header.tpl');