<?php
    include '../../conf/config.php';
    use model\Order;
    use model\OrderDetail;
    use model\Product;
    use model\Swap;
    use model\SwapDetail;
    use model\Member;

    $keyman = User::get('account');
    
    $sn = Input::get('sn');
    // $oid = Input::get('oid') ?: 1501010001;

    //換貨資料
    $swapData = Swap::find_by_ods001($sn);
    $swap = $swapData->attributes(true);
    $dateRecord = $swap['dateRecord'];
    $dRecord = explode(" ", $dateRecord);
    $swapRecord = $swap['swapdate'];
    $sRecord = explode(" ", $swapRecord);

    $oid = $swap['oid'];
    //訂單資料
    $orderData = Order::find_by_odm001($oid);
    $oorder = $orderData->attributes(true);
    
    //訂單明細資料
    $list = OrderDetail::find_by_odd002($oorder['sn']);
    $olist = $list->attributes(true);
    
    //會員編號、換款帳號
    $member = Member::find_by_mem001($swap['mid']);
    $acc = $member->mem003;
    $mno = $member->mem002;
    
    //產品編號
    $data[] = $swap['pid'];

    $options = array(
        'conditions' => array(
            'pdm001 in (?)',
            $data
        ),
    );
    $result = Product::find('pdm001', $options);
    $tmp = $result->attributes();
    $pname = $tmp['pdm004'];
    
    $tpl->assign('orderData',$orderData);
    $tpl->assign('keyman',$keyman);
    $tpl->assign('swap',$swap);
    $tpl->assign('oorder',$oorder);
    $tpl->assign('acc',$acc);
    $tpl->assign('mno',$mno);
    $tpl->assign('pname',$pname);
    $tpl->assign('dRecord',$dRecord[0]);
    $tpl->assign('sRecord',$sRecord[0]);
    $tpl->display('page12_order_swap_c.tpl');

?>