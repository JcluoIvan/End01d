<?php
	include '../../conf/config.php';
	use model\Agent;

    if(User::get('type') != 'L'){ exit(); }

    $account = User::get('account');
    $name = User::get('name');
    $lv1Rid = User::get('id');
    $bank_account = User::get('bank_account');
    $bank_code = User::get('bank_code');

	// $list = Agent::find('all',array('order' => 'age001'));
	// $list = Agent::getallbylv('4');
	// $list = Order::getallOrders();
	// $list = Order::find('all', array('order' => 'odm006'));
	$list = Agent::find_by_age001($lv1Rid);
    $listData = $list->attributes(true);
    $lv1Rpercent = $listData['age017'];

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
    $right_now_month = date('m');

	$tpl->assign('list',$list);
    $tpl->assign('account',$account);
    $tpl->assign('name',$name);
    $tpl->assign('lv1Rid',$lv1Rid);
    $tpl->assign('bank_account',$bank_account);
    $tpl->assign('bank_code',$bank_code);
    $tpl->assign('year',$year_arr);
    $tpl->assign('month',$month_arr);
    $tpl->assign('right_now_month',$right_now_month);
    $tpl->assign('lv1Rpercent',$lv1Rpercent);
	$tpl->display('page09_command_list.tpl');



?>