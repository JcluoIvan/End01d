<?php
    include '../../conf/config.php';
    use model\ProductItem;
    use model\Agent;

    /* 產品類別 */
    $options = array(
        'conditions' => array('pdi004 = 0'),
        'order' => 'pdi003'
    );
    $rows = ProductItem::find('all', $options);

    $types = array('0' => '所有產品分類');
    foreach ($rows as $row) {
        $types[$row->pdi001] = $row->pdi002;
    }

    $tpl->assign('types', $types);

    $tpl->display('page02_company_purchase.tpl');

