<?php
    include '../../conf/config.php';

    $tpl->assign('rightMain', 'order.php');
    $tpl->assign('filepath', 'test_left_menu.tpl');

    $tpl->display('ifr_main.tpl');
