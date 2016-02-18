<?php
include '../../conf/config.php';

$tpl->assign('user_name', User::get('name'));
$tpl->display('home_main.tpl');