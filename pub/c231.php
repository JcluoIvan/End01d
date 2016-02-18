<?php
/* 產品類別管理 新增修改 */

use model\ProductItem;

/*
驗證
    name
*/


class c231 {

    public function run() {

        $id = Input::post('id') ?: 0;
        $name = Input::post('name');
        $sort = intval(Input::post('sort')) ?: 0;


        $item = ProductItem::find_by_pdi001($id) ?: new ProductItem;
        $item->pdi002 = $name;
        $item->pdi003 = ($sort * 10) + (($item->pdi003 / 10 < $sort) ? 1 : -1); 
        $item->save();
        ProductItem::sort('pdi003');
        return array(
            'status' => true,
            'message' => Lang::get('save.success')
        );

    }

}