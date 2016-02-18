<?php
    include '../../conf/config.php';
    use model\Order;
    use model\Product;

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
    
    // $list = Agent::find('all',array('order' => 'age001'));
    // $list = Agent::getallbylv('4');
    // $list = Order::getallOrders();
    // $list = Order::find('all', array('order' => 'odm006'));
    $list = Product::all();
    // echo "<pre>"; print_r($list); echo "</pre>";

    $tpl->assign('list',$list);
    $tpl->assign('year',$year_arr);
    $tpl->assign('month',$month_arr);
    $tpl->display('page12_sales_analysis.tpl');



?>