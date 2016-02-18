<?php
    include '../../conf/config.php';
    use model\Product;
    use model\Member;
    use model\Order;

    $tpl->assign('products', Product::all());
    $tpl->assign('members', Member::all());
    $tpl->assign('receipt', Order::$receipt);
    $tpl->display('test_order.tpl');
