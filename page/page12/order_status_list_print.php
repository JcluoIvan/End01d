<?php
include '../../conf/config.php';

use model\Agent;
use model\Order;
use model\Reject;
use model\Swap;
use model\Member;
use model\Product;

$no = $_GET['no'] ?: null;
$date1 = $_GET['date1'] ?: null;
$date2 = $_GET['date2'] ?: null;
$methods = 'house';



// var_dump($no);
// echo "[no]=".$no."<br>";
// echo "[date1]=".$date1."<br>";
// echo "[date2]=".$date2."<br>";



if($no==NULL){
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'odm010 = ? AND odm006 BETWEEN ? AND ?',
                    $methods,
                    $date1,
                    $date2
                ),
                'group' => 'odm002'
            );
}else{
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'odm002 LIKE ? or odm011 LIKE ? AND odm010 = ? AND odm006 BETWEEN ? AND ? ',
                    '%'.$no.'%',
                    '%'.$no.'%',
                    $methods,
                    $date1,
                    $date2
                ),
                'group' => 'odm002'
            );
}

$rows = Order::with(
            Order::find('all', $options),
            array('al','ar','reject','swap')
        );
foreach ($rows as $key => $row) {
    $al = $row->al ?: new Agent;
    $ar = $row->ar ?: new Agent;
    $reject = $row->reject ?: new Reject;
    $swap = $row->swap ?: new Swap;
    $rows[$key] = $row->attributes(true);
}

// echo "<pre>";print_r($rows);
// var_dump($rows);
$tpl->assign('rows', $rows);
$tpl->display('page12_order_status_list_print.tpl');

?>