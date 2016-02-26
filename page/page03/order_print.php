<?php
include '../../conf/config.php';

use model\Agent;
use model\Order;

$no = $_GET['no'] ?: null;
$date1 = $_GET['date1'] ?: null;
$date2 = $_GET['date2'] ?: null;

// var_dump($no);

if($no==NULL){
    $options = array(
                'select' => '*',
                'conditions' => array(
                    'odm006 BETWEEN ? AND ?',
                    $date1,
                    $date2
                ),
                'group' => 'odm002'
            );
}else{
    $options = array(
                'select' => '*',
                'conditions' => array(
                    'odm002 LIKE ? AND odm006 BETWEEN ? AND ?',
                    '%'.$no.'%',
                    $date1,
                    $date2
                ),
                'group' => 'odm002'
            );
}

$rows = Order::with(
        Order::find('all', $options),
        array('al','ar')
    );

$get_No = '';
$get_Date = '';
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

    $rows[$key]['check_date'] = $rows[$key]['check_date'] ? date('Y/m/d', strtotime($rows[$key]['check_date'])) : '';
    $rows[$key]['date2'] = $rows[$key]['date2'] ? date('Y/m/d', strtotime($rows[$key]['date2'])) : '';
    $rows[$key]['date3'] = $rows[$key]['date3'] ? date('Y/m/d', strtotime($rows[$key]['date3'])) : '';
}

// echo "<pre>";print_r($rows);
// var_dump($rows);
$tpl->assign('get_No', $get_No);
$tpl->assign('get_Date', $get_Date);
$tpl->assign('rows', $rows);
$tpl->display('page03_order_print.tpl');

?>