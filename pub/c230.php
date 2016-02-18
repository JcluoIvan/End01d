<?php
/* 產品類別管理 清單 */

use model\ProductItem;
class c230 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        /* 每頁筆數 */
        $rp = Input::post('rp');

        $rows = array();

        $result = ProductItem::getList($page, $rp);

        $cols = array(
            'id',
            'name',
            'sort',
            'disabled',
        );
        foreach ($result as $row) {
            $rows[] = $row->attributes($cols);
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => ProductItem::count(),
        );
    }

}