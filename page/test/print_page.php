<?php
include '../../conf/config.php';

use model\Order;


$rows = Order::all(array('limit' => 20));


$tpl->assign('rows', $rows);
$tpl->display('test_clear_table.tpl');
