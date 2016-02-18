<?php
	include '../../conf/config.php';
	use model\Agent;

    if(User::get('type') != 'R'){ exit(); }

    $account = User::get('account');
    $name = User::get('name');
    $lv2Rid = User::get('id');

	$list = Agent::find_by_age001($lv2Rid);
    $listData = $list->attributes(true);
    $lv2Rpercent = $listData['age017'];

	$tpl->assign('list',$list);
    $tpl->assign('account',$account);
    $tpl->assign('name',$name);
    $tpl->assign('lv2Rid',$lv2Rid);
    $tpl->assign('lv2Rpercent',$lv2Rpercent);
	$tpl->display('page08_stock_search_list.tpl');



?>