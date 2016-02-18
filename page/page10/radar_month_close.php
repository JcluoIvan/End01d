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

    $month_rightNow = date("m");
    $month_rightNow = ltrim($month_rightNow,"0");
    
    // $list = Agent::find('all',array('order' => 'age001'));
    // $list = Agent::getallbylv('4');
    // $list = Order::getallOrders();
    // $list = Order::find('all', array('order' => 'odm006'));
    $list = Order::all();

    $tpl->assign('list',$list);
    $tpl->assign('year',$year_arr);
    $tpl->assign('month',$month_arr);
    $tpl->assign('month_rightNow',$month_rightNow);
    $tpl->display('page10_radar_month_close.tpl');



?>