<?php
    include '../../conf/config.php';
    use model\Order;

    $oid = Input::get('oid');


    $tpl->assign('oid', $oid);
    $tpl->display('page07_leader_bonus_detail_list.tpl');

