<?php
	include '../../conf/config.php';
	use model\Agent;

    if(User::get('type') != 'R'){ exit(); }

    $account = User::get('account');
    $name = User::get('name');
    $lv2Rid = User::get('id');
    $bank_account = User::get('bank_account');
    $bank_code = User::get('bank_code');

    $year = date("Y");
    $month = date("m");
    $year_arr = array();
    $month_arr = array();
    for($i=0;$i<10;$i++){
        (int)$year;
        $year_arr[] = $year;
        $year--;
    }
    for($j=0;$j<12;$j++){
        $month_arr[] = $j+1;
    }

	// $list = Agent::find('all',array('order' => 'age001'));
	// $list = Agent::getallbylv('4');
	// $list = Order::getallOrders();
	// $list = Order::find('all', array('order' => 'odm006'));
	$list = Agent::find_by_age001($lv2Rid);
    $listData = $list->attributes(true);
    $lv2Rpercent = $listData['age017'];
    $right_now_month = date("m");

	$tpl->assign('list',$list);
    $tpl->assign('account',$account);
    $tpl->assign('name',$name);
    $tpl->assign('lv2Rid',$lv2Rid);
    $tpl->assign('bank_account',$bank_account);
    $tpl->assign('bank_code',$bank_code);
    $tpl->assign('lv2Rpercent',$lv2Rpercent);
    $tpl->assign('year',$year_arr);
    $tpl->assign('month',$month_arr);
    $tpl->assign('right_now_month',$right_now_month);
	$tpl->display('page08_command_list.tpl');



?>