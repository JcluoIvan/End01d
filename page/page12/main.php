<?php
	include '../../conf/config.php';

	$filepath = "page12_main.tpl";
	$rightMain = "command_list.php";

	$tpl->assign('rightMain',$rightMain);
	$tpl->assign('filepath',$filepath);
	$tpl->display('ifr_main.tpl');
