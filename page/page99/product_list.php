<?php
    include '../../conf/config.php';
    use model\Product;
    $id = Input::get('id');
    $product = Product::find_by_pdm001($id);
    $tpl->assign('product', $product);
    $tpl->display('page99_product_list.tpl');
