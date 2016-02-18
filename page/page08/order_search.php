<?php
    include '../../conf/config.php';
    use model\Order;

    $year = date("Y");
    $month = date("m");
    $year_arr = array();
    $month_arr = array();
    for($i=0;$i<10;$i++){
        (int)$year;
        $year_arr[] = $year;
        $year--;
    }
    for($j=0;$j<12;$j++){
        $month_arr[] = $j+1;
    }

    $account = User::get('account');
    $name = User::get('name');
    $lv2Rid = User::get('id');

    $right_now_month = date("m");

    // $list = Agent::find('all',array('order' => 'age001'));
    // $list = Agent::getallbylv('4');
    // $list = Order::getallOrders();
    // $list = Order::find('all', array('order' => 'odm006'));
    // $list = Order::all();

    $tpl->assign('account',$account);
    $tpl->assign('name',$name);
    $tpl->assign('lv2Rid',$lv2Rid);
    $tpl->assign('year',$year_arr);
    $tpl->assign('month',$month_arr);
    $tpl->assign('right_now_month',$right_now_month);
    // $tpl->assign('list',$list);
    $tpl->display('page08_order_search_list.tpl');



?>