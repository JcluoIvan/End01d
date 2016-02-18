<?php

    include '../../conf/config.php';

    $menus = array(
        'setting'=> '系統設定',
        'agent' => '帳號操作記錄',
        // 'member' => '會員操作記錄',
        'order' => '訂單操作記錄',
        'product' => '產品操作記錄',
        'purchase' => '進貨操作記錄',
        'error' => '系統錯誤記錄',
    );


    $tpl->assign('menus', $menus);
    // $tpl->assign('rightMain', 'agent.php');
    $tpl->assign('rightMain', 'setting.php');
    $tpl->assign('filepath', 'page99_left_menu.tpl');

    $tpl->display('ifr_main.tpl');
