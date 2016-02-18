<?php
include '../../conf/config.php';
include PUB_PATH . 'c302.php';
use model\Agent;
use model\Order;
use model\Reject;
use model\Member;
use model\Product;

$app = new c302;
$options = $app->options();
unset($options['offset']);
unset($options['limit']);

$reject = Reject::with(
    Reject::find('all', $options),
    array('order', 'member', 'ar', 'product')
);
$rows = array();
foreach ($reject as $row) {
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
$tpl->display('page08_order_reject_list_print.tpl');
