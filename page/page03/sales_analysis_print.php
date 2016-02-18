<?php
include '../../conf/config.php';

use model\Agent;
use model\Order;
use model\Reject;
use model\Member;
use model\Product;

$rid = $_GET['rid'] ?: null;
$no = $_GET['no'] ?: null;
$date1 = $_GET['date1'] ?: null;
$date2 = $_GET['date2'] ?: null;

// var_dump($no);
// echo "[rid]=".$rid."<br>";
// echo "[no]=".$no."<br>";
// echo "[date1]=".$date1."<br>";
// echo "[date2]=".$date2."<br>";

$where = array();
$values = array();
// 訂單日期
$where[] = " AND odm006 BETWEEN ? AND ? ";        
$values[] = $date1;
$values[] = $date2;

// 查詢指揮站
if ($rid=="L") {
    $id = $this->getAgentID($no);
    $id = implode(',', $id);
    $where [] = " AND odm021 IN (?) ";                   
    $values [] = intval($id);
}

// 查詢雷達站
if ($rid=="R") {
    $id = $this->getAgentID($no);
    $id = implode(',', $id);
    $where [] =  " AND odm022 IN (?) ";                   
    $values [] = intval($id);
}

// 查詢會員
if ($rid=="M") {
    $id = $this->getMemberID($no);
    $id = implode(',', $id);
    $where [] =  " AND odm013 IN (?) ";                   
    $values [] = intval($id);
}

$where = count($where) ? implode(' ', $where) : '';
$rows = array();

$sql = "SELECT pdm002 as no, pdm004 as name, SUM(count) as order_count, SUM(odr008) as reject_count, SUM(ods008) as swap_count
        FROM product_manager
            LEFT JOIN (
                SELECT odd002, odd003, SUM(odd006) AS count
                FROM order_detail
                WHERE EXISTS (
                    SELECT 1 FROM order_manager
                    WHERE odm001 = odd002
                    {$where}
                )
                GROUP BY odd002, odd003
            ) AS dtl ON (odd003 = pdm001)
            LEFT JOIN order_reject ON (odr002 = odd002 AND odr006 = pdm001)
            LEFT JOIN order_swap ON (ods002 = odd002 AND ods006 = pdm001)
        GROUP BY pdm004
        ORDER BY pdm001";
$result = Product::connection()
        ->query($sql, $values);

foreach ($result as $row) {
    $tmp = $row;
    if(empty($tmp['order_count'])){
        $tmp['order_count'] = 0;
    }
    if(empty($tmp['reject_count'])){
        $tmp['reject_count'] = 0;
    }
    if(empty($tmp['swap_count'])){
        $tmp['swap_count'] = 0;
    }
    //合計
    $tmp['total_count'] = $row['order_count'] - $row['reject_count'];
    $rows[] = $tmp;
}

// var_dump($rows);

$tpl->assign('rows', $rows);
$tpl->display('page03_sales_analysis_print.tpl');

function getAgentID($formSearchID) {
    $sql = 'SELECT * '
                . ' FROM agent '
                . " WHERE age003 LIKE '%{$formSearchID}%' ";
    $result = Agent::find_by_sql($sql);
    $id = array();
    foreach ($result as $r) {
        $id[] = $r->age001;
    }
    return $id;
}

function getMemberID($formSearchID) {
    $sql = 'SELECT * '
                . ' FROM member '
                . " WHERE mem003 LIKE '%{$formSearchID}%' ";
    $result = Member::find_by_sql($sql);
    $id = array();
    foreach ($result as $r) {
        $id[] = $r->mem001;
    }
    return $id;
}

exit;
if($no==NULL){
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'odr012 BETWEEN ? AND ?',
                    $date1,
                    $date2
                ),
                'group' => 'odr003'
            );
}else{
    $options = array(
                // 'select' => '*',
                'conditions' => array(
                    'odr003 LIKE ? AND odr012 BETWEEN ? AND ?',
                    '%'.$no.'%',
                    $date1,
                    $date2
                ),
                'group' => 'odr003'
            );
}

$rows = Reject::find('all', $options);
foreach ($rows as $key => $row) {
    $rows[$key] = $row->attributes(true);

    $oid = $rows[$key]['oid'];
    $order = Order::find_by_odm001($oid);
    $odata = $order->attributes(true);
    $rows[$key]['oid'] = $odata['oid'];

    $aid = $rows[$key]['aid'];
    $agent = Agent::find_by_age001($aid);
    $adata = $agent->attributes(true);
    $rows[$key]['aid'] = $adata['no'];

    $mid = $rows[$key]['mid'];
    $member = Member::find_by_mem001($mid);
    $mdata = $member->attributes(true);
    $rows[$key]['mid'] = $mdata['account'];

    $pid = $rows[$key]['pid'];
    $product = Product::find_by_pdm001($pid);
    $pdata = $product->attributes(true);
    $rows[$key]['pid'] = $pdata['name'];

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
$tpl->display('page03_order_reject_list_print.tpl');

?>