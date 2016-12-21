<?php
    include '../../conf/config.php';
    use model\Order;

    $aid = Input::get('aid');
    $oid = Input::get('oid');



    $tpl->assign('aid', $aid);
    $tpl->assign('oid', $oid);
    $tpl->display('page07_radar_bonus_detail_list.tpl');

