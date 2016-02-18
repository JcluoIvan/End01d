<?php
    include '../../conf/config.php';
    use model\Swap;
    use model\Order;

    $oid = Input::get('sn');
    $date1 = Input::get('date1');
    $date2 = Input::get('date2');

    $list = Order::find_by_odm001($oid);
    $order = $list->attributes(true);
    // echo "<pre>"; print_r($order); echo "</pre>";
    $ooid = $order['oid'];
    $datecheck = explode(" ", $order['check_date']);

    //$tpl->assign('list',$list);
    $tpl->assign('oid',$oid);
    $tpl->assign('ooid',$ooid);
    $tpl->assign('datecheck',$datecheck[0]);
    $tpl->assign('date1',$date1);
    $tpl->assign('date2',$date2);
    $tpl->display('page10_swap_list.tpl');



?>