<?php
    include '../../conf/config.php';
    use model\Reject;
    use model\Order;

    // $list = Agent::find('all',array('order' => 'age001'));
    // $list = Agent::getallbylv('4');
    // $list = Order::getallOrders();
    // $list = Order::find('all', array('order' => 'odm006'));
    $rows = Reject::with(
                Reject::all(),
                array('order')
            );
    
    foreach ($rows as $key => $row) {
        $rows[$key] = $row->attributes(true);
        $or1 = $row->order ?: new Order;
        $or1_name = $or1->odm005 ?: null;
        $rows[$key]['datecheck'] = $or1_name;
    }  
    
    // echo "<pre>"; print_r($rows);

    $tpl->assign('rows',$rows);
    $tpl->display('page10_order_reject_list.tpl');



?>