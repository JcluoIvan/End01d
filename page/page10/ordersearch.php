<?php
	include '../../conf/config.php';
	use model\Order;

	// $list = Agent::find('all',array('order' => 'age001'));
	// $list = Agent::getallbylv('4');
	// $list = Order::getallOrders();
	// $list = Order::find('all', array('order' => 'odm006'));
	$list = Order::all();

	$tpl->assign('list',$list);
	$tpl->display('page10_ordersearch.tpl');



?>