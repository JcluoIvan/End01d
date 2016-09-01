<?php

	include '../../conf/config.php';
	$filepath = "page13_main.tpl";
	$rightMain = "organize_member.php";

	$tpl->assign('rightMain',$rightMain);
	$tpl->assign('filepath',$filepath);
	$tpl->display('ifr_main.tpl');

