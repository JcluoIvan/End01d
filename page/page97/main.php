<?php

    include '../../conf/config.php';

    $menus = array(
        'title_image'=> '首頁上橫幅圖片',
    );


    $tpl->assign('menus', $menus);
    // $tpl->assign('rightMain', 'agent.php');
    $tpl->assign('rightMain', 'title_image.php');
    $tpl->assign('filepath', 'page97_left_menu.tpl');

    $tpl->display('ifr_main.tpl');
