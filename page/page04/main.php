<?php

    include '../../conf/config.php';
    use model\News;

    $list = News::find('all', array('order' => 'new005'));

    // $tpl->assign('list', $list);
    $tpl->assign('rightMain', 'sms.php');
    $tpl->assign('filepath', 'page04_left_menu.tpl');

    $tpl->display('ifr_main.tpl');
