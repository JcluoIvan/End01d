<?php
    include '../../conf/config.php';
    use model\Product;
    use model\ProductItem;

    $options = array(
        'conditions' => array(
            'pdi004 = 0'
        )
    );
    $rows = ProductItem::find('all', $options);

    $types = array('0' => '所有產品分類');
    foreach ($rows as $row) {
        $types[$row->pdi001] = $row->pdi002;
    }

    $sell_types = Product::optionsSellTypes();


    $tpl->assign('types', $types);
    $tpl->assign('sell_types', $sell_types);
    $tpl->display('page02_product.tpl');

