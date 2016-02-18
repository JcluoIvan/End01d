<?php
	include '../../conf/config.php';

    $tpl->assign('sdate', date('Y-m-01'));
    $tpl->assign('edate', date('Y-m-d'));

	$tpl->display('page03_command_list.tpl');

