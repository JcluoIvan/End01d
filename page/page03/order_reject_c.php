<?php
    include '../../conf/config.php';
    use model\Order;
    use model\OrderDetail;
    use model\Product;
    use model\Reject;
    use model\RejectDetail;
    use model\Member;

    $keyman = User::get('account');
    $sn = Input::get('sn');
    
    //退貨資料
    $rejectData = Reject::find_by_odr001($sn) ?: new Reject;
    $reject = $rejectData->attributes(true);
    // print_r($reject);
    $dateRecord = $reject['dateRecord'];
    $dRecord = explode(" ", $dateRecord);
    $rejectRecord = $reject['rejectdate'];
    $rRecord = explode(" ", $rejectRecord);

    $oid = $reject['oid'];

    //訂單資料
    $orderData = Order::find_by_odm001($oid);
    $oorder = $orderData->attributes(true);
    
    //訂單明細資料
    $list = OrderDetail::find_by_odd002($oorder['sn']);
    $olist = $list->attributes(true);
    
    //會員帳號
    $member = Member::find_by_mem001($reject['mid']);
    $acc = $member->mem003;
    $mno = $member->mem002;
    
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
    
    $tpl->assign('orderData',$orderData);
    $tpl->assign('keyman',$keyman);
    $tpl->assign('reject',$reject);
    $tpl->assign('oorder',$oorder);
    $tpl->assign('acc',$acc);
    $tpl->assign('mno',$mno);
    $tpl->assign('pname',$pname);
    $tpl->assign('dRecord',$dRecord[0]);
    $tpl->assign('rRecord',$rRecord[0]);
    $tpl->display('page03_order_reject_c.tpl');

?>