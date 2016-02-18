<?php
    include '../../conf/config.php';
    use model\Order;
    
    $oid = Input::get('oid');

    $order = Order::with(
        Order::find_by_odm001($oid) ?: new Order,
        array('member')
    );

    $tpl->assign('order', $order);
    $tpl->display('page07_radar_bonus_detail.tpl');

