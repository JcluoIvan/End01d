<?php
    include '../../conf/config.php';
    use model\Order;

    $account = User::get('account');
    $name = User::get('name');
    $lv2Rid = User::get('id');

    $tpl->assign('account',$account);
    $tpl->assign('name',$name);
    $tpl->assign('lv2Rid',$lv2Rid);
    // $tpl->assign('list',$list);
    $tpl->display('page08_verification_swap_search_list.tpl');



?>