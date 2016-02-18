<?php
use model\Product;
class c223 {

    public function run() {

        $id = Input::post('id') ?: 0;
        $main = Input::post('main') ? 1 : 0;

        $product = Product::find_by_pdm001($id) ?: false;

        if ($product) {


            $product->pdm013 = $main;
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