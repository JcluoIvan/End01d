<?php
include '../../conf/config.php';

use model\Agent;
use model\Order;
use model\Swap;
use model\Member;
use model\Product;

$oid = $_GET['oid'] ?: null;
$no = $_GET['no'] ?: null;
$date1 = $_GET['date1'] ?: null;
$date2 = $_GET['date2'] ?: null;

// var_dump($no);
// echo "[oid]=".$oid."<br>";
// echo "[no]=".$no."<br>";
// echo "[date1]=".$date1."<br>";
// echo "[date2]=".$date2."<br>";

if($no==NULL){
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'ods002 = ? AND ods012 BETWEEN ? AND ?',
                    $oid,
                    $date1,
                    $date2
                ),
                'group' => 'ods003'
            );
}else{
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'ods002 = ? AND ods003 LIKE ? AND ods012 BETWEEN ? AND ?',
                    $oid,
                    '%'.$no.'%',
                    $date1,
                    $date2
                ),
                'group' => 'ods003'
            );
}

// $rows = Swap::find('all', $options);
$rows = Swap::with(
        Swap::find('all', $options),
        array('order','member','ar','product')
    );

foreach ($rows as $key => $row) {
    $rows[$key] = $row->attributes(true);
    $tmp = $row->attributes(true);

    // 訂單編號
    $oid = $row->order ?: new Order;
    $oidNo = $oid->odm002 ?: '資料不正確';
    $rows[$key]['oid'] = $oidNo;

    // 展示中心
    $ag2 = $row->ar ?: new Agent;
    $ag2_name = $ag2->age003 ?: '資料不正確';
    $rows[$key]['aid'] = $ag2_name;

    // 會員名稱
    $mid = $row->member ?: new Member;
    $midName = $mid->mem003 ?: '資料不正確';
    $rows[$key]['mid'] = $midName;

    // 產品名稱
    $pid = $row->product ?: new Product;
    $pidName = $pid->pdm004 ?: '資料不正確';
    $rows[$key]['pid'] = $pidName;

    $status = $rows[$key]['status'];
    if($status==1){
        $rows[$key]['status'] = '核帳';
    }else{
        $rows[$key]['status'] = '處理中';
    }

}

// echo "<pre>";print_r($rows);
// var_dump($rows);
$tpl->assign('rows', $rows);
$tpl->display('page03_swap_list_print.tpl');

?>