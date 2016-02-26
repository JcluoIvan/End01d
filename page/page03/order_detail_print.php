<?php
include '../../conf/config.php';

use model\Agent;
use model\Order;
use model\Product;
use model\OrderDetail;
use model\Reject;

$sn = $_GET['sn'] ?: null;
$oid = $_GET['sn'] ?: null;
$date1 = $_GET['date1'] ?: null;
$date2 = $_GET['date2'] ?: null;

$rows2 = array();      
$result2 = OrderDetail::find('all', getOptions());
$sql = OrderDetail::connection()->last_query;
// echo "<pre>"; print_r($sql); echo "</pre>";
$count2 = intval(OrderDetail::count(getOptions('count')));

foreach ($result2 as $row2) {
    $tmp2 = $row2->attributes(true);
    $reject = Reject::find_by_odr002($oid) ?: new Reject;
    $tmpReject = $reject->attributes(true);
    $rejectAmount = $tmpReject['amount'] ?: 0;
    $rejectMoney = $tmpReject['rTmoney'] ?: 0;
    $product = Product::find_by_pdm001($tmp2['pid']);
    // $amount = $tmp['count'] - $rejectAmount;
    $tmp2['no'] = $product->pdm002;
    $tmp2['name'] = $product->pdm004;
    $tmp2['total'] = $tmp2['money']*$tmp2['count'];
    // $tmp['count'] = $amount;
    $tmp2['reject_count'] = $rejectAmount;
    $tmp2['reject_money'] = $rejectMoney;
    $tmp2['totalcount'] = $tmp2['count'] - $tmp2['reject_count'];
    $tmp2['totalmoney'] = $tmp2['total'] - $tmp2['reject_money'];
    $rows2[] = $tmp2;
}

function getOptions() 
{
    $oid = $_GET['sn'];
        
    $where = array();
    $where[] = 'odd002 = ?';
    $params[] = $oid; 

    $page = Input::post('page') ?: 1;
    $rp = Input::post('rp') ?: 10;
    $page = intval($page) ?: 1;
    $rp = intval($rp) ?: 10;

    $options = array(
        'offset' => ($page - 1) * $rp,
        'limit' => $rp,   
    );
        
    if ($where) {
        array_unshift($params, implode(' AND ', $where));
        $options['conditions'] = $params;
    }

    return $options;
}

$options = array(
            'select' => '*',
            'conditions' => array(
                'odm001 = ? AND odm006 BETWEEN ? AND ?',
                $sn,
                $date1,
                $date2
            ),
            'group' => 'odm002'
        );

$rows = Order::with(
        Order::find('all', $options),
        array('al','ar','member')
    );

foreach ($rows as $key => $row) {
    $rows[$key] = $row->attributes(true);

    $lv1 = $rows[$key]['lv1id'];
    $lv2 = $rows[$key]['lv2id'];
    $ag1 = $row->al ?: new Agent;
    $ag1_name = $ag1->age003 ?: '資料不正確';
    $ag2 = $row->ar ?: new Agent;
    $ag2_name = $ag2->age003 ?: '資料不正確';
    $rows[$key]['lv1id'] = $ag1_name;
    $rows[$key]['lv2id'] = $ag2_name;
    $member = $row->member ?: new Member;
    // $pno = Product::find_by_pdm001($detail->odd003);

    $methods = $rows[$key]['methods'];
    if($methods=='card'){
        $rows[$key]['methods'] = '信用卡';
    }elseif($methods=='atm'){
        $rows[$key]['methods'] = 'ATM轉帳';
    }elseif($methods=='cash'){
        $rows[$key]['methods'] = '現金';
    }

    $getmode = $rows[$key]['getmode'];
    if($getmode=='csv'){
        $rows[$key]['getmode'] = '到店取貨';
        $get_No = '取貨序號';
        $get_Date = '取貨日期';
    }elseif($getmode=='house'){
        $rows[$key]['getmode'] = '宅配';
        $get_No = '宅配單號';
        $get_Date = '出貨日期';
    }

    //本次使用的購物金
    $use_shoppinggold = $rows[$key]['coupon'] > 0 ? $rows[$key]['coupon'] : 0;

    // 運費
    $shipment = $rows[$key]['fare'] > 0 ? $rows[$key]['fare'] : 0;

    // 此次購買總額(含運費)
    $pmoney_total = $rows[$key]['total'] > 0? $rows[$key]['total'] : 0;

    // 此次購買總額(不含運費)
    $pmoney = $pmoney_total - $shipment;

    //退貨金
    $rmoney = $rows[$key]['reject_shopgold'] > 0 ? $rows[$key]['reject_shopgold'] : 0;

    //實際金額
    $correct_sum = $pmoney - $use_shoppinggold + $shipment - $rmoney;

    //本次訂單新增的購物金
    $shoppinggold = floor($correct_sum*20/100); 

    $rows[$key]['check_date'] = $rows[$key]['check_date'] ? date('Y/m/d', strtotime($rows[$key]['check_date'])) : '';
    $rows[$key]['date2'] = $rows[$key]['date2'] ? date('Y/m/d', strtotime($rows[$key]['date2'])) : '';
    $rows[$key]['date3'] = $rows[$key]['date3'] ? date('Y/m/d', strtotime($rows[$key]['date3'])) : '';
}
$orderData = $rows[0];
// echo "<pre>";print_r($rows);
// var_dump($rows);
$tpl->assign('get_No', $get_No);
$tpl->assign('get_Date', $get_Date);
$tpl->assign('rows', $rows);
$tpl->assign('memberData', $member);
$tpl->assign('orderData', $orderData);
$tpl->assign('detail', $rows2);

$tpl->assign('pmoney', $pmoney);
$tpl->assign('rmoney', $use_shoppinggold);
$tpl->assign('use_shoppinggold', $use_shoppinggold);
$tpl->assign('shipment', $shipment);
$tpl->assign('rmoney', $rmoney);
$tpl->assign('correct_sum', $correct_sum);
$tpl->assign('shoppinggold', $shoppinggold);

$tpl->display('page03_order_detail_print.tpl');
?>