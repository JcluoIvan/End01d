<?php
include '../../conf/config.php';

use model\Agent;
use model\Order;

//雷達站帳號登入資訊
$account = User::get('account');
$name = User::get('name');
$lv2Rid = User::get('id');

$no = $_GET['no'] ?: null;
$date1 = $_GET['date1'] ?: null;
$date2 = $_GET['date2'] ?: null;

if($no==NULL){
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'odm022 = ? AND odm006 BETWEEN ? AND ?',
                    $lv2Rid,
                    $date1,
                    $date2
                ),
                'group' => 'odm002'
            );
}else{
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'odm022 = ? AND odm002 LIKE ? AND odm006 BETWEEN ? AND ?',
                    $lv2Rid,
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
    }elseif($getmode=='house'){
        $rows[$key]['getmode'] = '宅配';
    }

    $rows[$key]['check_date'] = $rows[$key]['check_date'] ? date('Y/m/d', strtotime($rows[$key]['check_date'])) : '';
    $rows[$key]['date2'] = $rows[$key]['date2'] ? date('Y/m/d', strtotime($rows[$key]['date2'])) : '';
    $rows[$key]['date3'] = $rows[$key]['date3'] ? date('Y/m/d', strtotime($rows[$key]['date3'])) : '';
}

$tpl->assign('rows', $rows);
$tpl->display('page08_getorder_search_print.tpl');

?>