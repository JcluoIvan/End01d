<?php
    include '../../conf/config.php';
    use model\Order;
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

    $oid = $swap['oid'];
    //訂單資料
    $orderData = Order::find_by_odm001($oid);
    $order = $orderData->attributes(true);
    //訂單明細資料
    $list = Order::getOrderDetail($oid);
    
    //會員帳號
    $member = Member::find_by_mem001($swap['mid']);
    $mem = $member->attributes(true);
    $acc = $member->mem003;
    
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
    
    $tpl->assign('order',$order);
    $tpl->assign('keyman',$keyman);
    $tpl->assign('swap',$swap);
    $tpl->assign('mem',$mem);
    $tpl->assign('acc',$acc);
    $tpl->assign('pname',$pname);
    $tpl->display('page08_order_swap_detail.tpl');

?>