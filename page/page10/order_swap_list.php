<?php
    include '../../conf/config.php';
    use model\Swap;

    // $list = Agent::find('all',array('order' => 'age001'));
    // $list = Agent::getallbylv('4');
    // $list = Order::getallOrders();
    // $list = Order::find('all', array('order' => 'odm006'));
    $list = Swap::all();

    $tpl->assign('list',$list);
    $tpl->display('page10_order_swap_list.tpl');



?>