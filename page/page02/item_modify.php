<?php
    include '../../conf/config.php';
    use model\ProductItem;
    $id = Input::get('id');
    $row = ProductItem::find_by_pdi001($id) ?: new ProductItem;
    $row->pdi003 = $row->pdi003 ?: 0;
    $title = $row->pdi001 ? '新增分類' : '修改分類';

    $tpl->assign('row', $row);
    $tpl->assign('title', $title);
    $tpl->display('page02_item_modify.tpl');

