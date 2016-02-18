<?php
    include '../../conf/config.php';
    use model\News;

    $list = News::find('all', array('order' => 'new005'));

    // $tpl->assign('list', $list);
    $tpl->assign('rightMain', 'inventory.php');
    $tpl->assign('filepath', 'page02_left_menu.tpl');

    $tpl->display('ifr_main.tpl');
