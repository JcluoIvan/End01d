<?php
    include '../../conf/config.php';
    use model\Order;
    use model\Product;
    use model\Reject;
    use model\RejectDetail;
    use model\Member;

    $keyman = User::get('account');
    $sn = Input::get('sn');
    
    //退貨資料
    $rejectData = Reject::find_by_odr001($sn) ?: new Reject;
    $reject = $rejectData->attributes(true);

    $oid = $reject['oid'];

    //訂單資料
    $orderData = Order::find_by_odm001($oid);
    $order = $orderData->attributes(true);
    //訂單明細資料
    $list = Order::getOrderDetail($oid);
    
    //會員帳號
    $member = Member::find_by_mem001($reject['mid']);
    $mem = $member->attributes(true);
    $acc = $member->mem003;
    
    //產品編號
    $data[] = $reject['pid'];

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
    $tpl->assign('reject',$reject);
    $tpl->assign('mem',$mem);
    $tpl->assign('acc',$acc);
    $tpl->assign('pname',$pname);
    $tpl->display('page08_order_reject_detail.tpl');

?>