<?php
    include '../../conf/config.php';
    use model\Order;
    use model\Product;

    $id = Input::get('id') ?: null; // $_GET['oid'];
    $orderData = Order::find_by_odm022($id);

    $tpl->display('page10_radar_month_closeDetails.tpl');



?>