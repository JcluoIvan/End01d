<?php
    include '../../conf/config.php';
    
    $mid = Input::get('id');

    // $userName = User::get('name');

    $date = date('Y/m/d');

    // $tpl->assign('userName', $userName);
    $tpl->assign('date', $date);
    $tpl->assign('mid', $mid);
    $tpl->display('page11_blacklist_modify.tpl');

