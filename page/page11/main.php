<?php

	include '../../conf/config.php';

	$filepath = "page11_main.tpl";
	$rightMain = "organize.php";

	$tpl->assign('rightMain',$rightMain);
	$tpl->assign('filepath',$filepath);
	$tpl->display('ifr_main.tpl');

