<?php
    include '../../conf/config.php';
    $tpl->assign('date1', date('Y-m-01'));
    $tpl->assign('date2', date('Y-m-d'));
    $tpl->display('page08_order_reject_list.tpl');

