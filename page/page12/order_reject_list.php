<?php
    include '../../conf/config.php';
    use model\Reject;
    use model\Order;

    $tpl->assign('date1', date('Y-m-01'));
    $tpl->assign('date2', date('Y-m-d'));


    $tpl->display('page12_order_reject_list.tpl');
