<?php
include '../../conf/config.php';
include PUB_PATH . 'c1203.php';

use model\Agent;
use model\Order;
use model\Swap;
use model\Member;
use model\Product;

$app = new c1203;
$options = $app->options();
unset($options['offset']);
unset($options['limit']);

$swap = Swap::with(
    Swap::find('all', $options),
    array('order','ar','member','product')
);

$rows = array();
foreach ($swap as $row) {
    $order = $row->order ?: new Order;
    $member = $row->member ?: new Member;
    $ar = $row->ar ?: new Agent;
    $product = $row->product ?: new Product;
    $tmp = $row->attributes(true);

    $tmp['oid'] = $order->odm002;
    $tmp['aid'] = $ar->age003;
    $tmp['mid'] = $member->mem003;
    $tmp['pid'] = $product->pdm004;
    $tmp['status'] = $row->getItemType();
    $rows[] = $tmp;
}
$tpl->assign('rows', $rows);
$tpl->display('page12_order_swap_list_print.tpl');

