<?php
    include '../../conf/config.php';
    use model\Order;
    use model\Product;

    $oid = Input::get('oid') ?: 1501010001; // $_GET['oid'];

    //訂單資料
    $orderData = Order::getOrder($oid);
    //訂單明細資料
    $list = Order::getOrderDetail($oid);

    foreach ($list as $k) {
        //產品編號
        $data[] = $k->pid;
    }

    $options = array(
        'conditions' => array(
            'pdm002 in (?)',
            $data
        ),
    );
    $result = Product::find('all', $options);

    $products = array();
    foreach ($result as $row) {
        $products[$row->pdm002] = $row;
    }

    $rows = array();
    foreach ($list as $row) {
        $tmp = $row->attributes();
        $tmp['pname'] = isset($products[$row->pid])
            ? $products[$row->pid]->pdm004 
            : ' ? ';
        $rows[] = $tmp;
    }
    // echo "<pre>"; print_r($rows); echo "</pre>";
    // echo "[pid]=".$list[0]->pid;
    // echo "<pre>"; print_r($list); echo "</pre>";
    // echo "[count]=".count($list);
    // echo "<br>";
    // echo "[list0]=".$list[0]->pmoney;
    // echo "<br>";
    // echo "[list1]=".$list[1]->pmoney;
    // echo "<pre>"; print_r($data); echo "</pre>";

    $j = 0;
    $sum = 0;
    $shoppinggold = 0;
    for ($i=1; $i<count($list)+1 ; $i++) { 
        $sum += $list[$j]->pmoney;
        //本次訂單新增的購物金
        $shoppinggold += $list[$j]->shoppinggold;
        $j++;
    }
    
    $tpl->assign('orderData',$orderData);
    $tpl->assign('list',$list);
    $tpl->assign('sum',$sum);
    $tpl->assign('pdata',$rows);
    $tpl->assign('shoppinggold',$shoppinggold);
    $tpl->display('page03_order_status.tpl');



?>