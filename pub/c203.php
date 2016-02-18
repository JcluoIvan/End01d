<?php
use model\Product;
use model\Agent;
class c203 {

    public function run() {

        $iid = Input::post('iid');
        $rows = Product::getAllProduct($iid);

        return array(
            'status' => true,
            'rows' => $rows,
        );
    }


}