<?php
    include '../../conf/config.php';
    use model\LogProduct;
    use model\Product;
    use model\Agent;

    $id = Input::get('id') ?: 0;

    $log = LogProduct::with(
        LogProduct::find_by_lpd001($id),
        array('product')
    );

    if (!$log) exit('資料不正確');


    $tpl->assign('log', $log);
    $tpl->assign('product_name', $log->product ? $log->product->pdm004 : 'unknown');
    $tpl->display('page99_product_view.tpl');
