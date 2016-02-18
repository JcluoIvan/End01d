<?php
    include '../../conf/config.php';
    use model\Order;
    use model\Product;
    use model\Member;
    use model\Reject;

    $sn = Input::get('oid') ?: 1501010001; // $_GET['oid'];

    // $list = Agent::find('all',array('order' => 'age001'));
    // $list = Agent::getallbylv('4');
    // $list = Order::getallOrders();
    // $list = Order::find('all', array('order' => 'odm006'));
    //訂單資料
    $orderData = Order::find_by_odm001($sn);
    $order = $orderData->attributes(true);
    
    //訂單明細資料
    $list = Order::getOrderDetail($sn);
    $m_name = $order['mid'];
    
    //會員帳號
    $memberData = Member::find_by_mem001($order['mid']);
    $member = $memberData->attributes(true);
    $acc = $member['name'];
    
    //退貨資料
    $rt = Reject::find_by_odr002($sn);
    // var_dump($rt->attributes());
    $reson = "&nbsp;";
    $amount = 0;
    if($rt){
        $tmprt = $rt->attributes();
        $reson = $tmprt['odr009'];
        $amount = $tmprt['odr008'];
    }

    foreach ($list as $k) {
        //產品編號
        $data[] = $k->pid;
    }

    $options = array(
        'conditions' => array(
            'pdm001 in (?)',
            $data
        ),
    );
    $result = Product::find('all', $options);

    $products = array();
    foreach ($result as $row) {
        $products[$row->pdm002] = $row;
        $pp[$row->pdm001] = $row->attributes();
        // echo "<pre>"; print_r($pp); echo "</pre>";
    }
    
    $rows = array();
    foreach ($list as $row) {
        $tmp = $row->attributes();
        $tmp['pname'] = isset($pp[$row->pid]['pdm001'])
            ? $pp[$row->pid]['pdm004'] 
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
    $tpl->assign('member',$member);
    $tpl->assign('list',$list);
    $tpl->assign('sum',$sum);
    $tpl->assign('acc',$acc);
    $tpl->assign('reson',$reson);
    $tpl->assign('amount',$amount);     // 目前訂貨單剩餘購買數量
    $tpl->assign('pdata',$rows);
    $tpl->assign('shoppinggold',$shoppinggold);
    $tpl->display('page03_order_reject.tpl');



?>