<?php
use model\Product;
class c222 {

    public function run() {

        $id = Input::post('id') ?: 0;
        $selling = Input::post('selling') ? 1 : 0;

        $product = Product::find_by_pdm001($id) ?: false;

        if ($product) {

            $product->pdm007 = $selling;
            $product->pdm011 = User::get('id');
            $product->save();
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