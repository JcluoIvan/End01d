<?php
include '../../conf/config.php';
use model\Post;
use model\Bank;

$agent = User::data(); 

$city = Post::row($agent->age009) ?: new Post;
$country = Post::row($city->pos002) ?: new Post;

$tpl->assign('codes', Bank::options());
$tpl->assign('country', $country);
$tpl->assign('city', $city);
$tpl->assign('agent', $agent);
$tpl->display('page98_main.tpl');

