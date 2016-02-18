<?php
use model\ProductItem;
class c232 {

    public function run() {

        $id = Input::post('id') ?: 0;
        $disabled = Input::post('disabled') ? 1 : 0;

        $item = ProductItem::find_by_pdi001($id) ?: false;

        if ($item) {


            $item->pdi004 = $disabled;
            $item->save();
            return array(
                'status' => true,
            );

        } else {
            return array(
                'status' => false,
                'message' => '查無此資料',
            );
        }

    }

}