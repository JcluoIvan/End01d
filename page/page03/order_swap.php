<?php
    include '../../conf/config.php';
    use model\Order;
    use model\Product;
    use model\Member;
    use model\Swap;

    $sn = Input::get('oid') ?: 1501010001; // $_GET['oid'];

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

    //換貨資料
    $sw = Swap::find_by_ods002($sn) ;
    // var_dump($sw->attributes());
    $reson = "&nbsp;";
    $amount = 0;
    if($sw){
        $tmpsw = $sw->attributes();
        $reson = $tmpsw['ods009'];
        $amount = $tmpsw['ods008'];
    }

    foreach ($list as $k) {
        //產品編號
        $data[] = $k->pid;
    }
    // echo "<pre> data:"; print_r($data); echo "</pre>";

    $options = array(
        'conditions' => array(
            'pdm001 in (?)',
            $data
        ),
    );
    $result = Product::find('all', $options);
    // echo "<pre> result:"; print_r($result); echo "</pre>";

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
    
    $tpl->assign('orderData',$orderData);
    $tpl->assign('member',$member);
    $tpl->assign('list',$list);
    $tpl->assign('acc',$acc);
    $tpl->assign('reson',$reson);
    $tpl->assign('amount',$amount);
    $tpl->assign('pdata',$rows);
    $tpl->display('page03_order_swap.tpl');



?>