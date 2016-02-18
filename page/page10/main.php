<?php
include '../../conf/config.php';

$filepath = "page10_menus.tpl";
$rightMain = "leader.php";

$tpl->assign('rightMain',$rightMain);
$tpl->assign('filepath',$filepath);
$tpl->display('ifr_main.tpl');

