<?php
use model\ProductPurchaseDetail;
use model\Product;
use model\Agent;

/* 刪除 purchase detail */
class c215 extends \pub\GatewayApi{

    public function run() {

        $id = Input::post('id') ?: 0;  

        if ($detail = ProductPurchaseDetail::find_by_ppd001($id)) {
            return $detail->delete()
                ? $this->success()
                : $this->fail('不明原因，資料刪除失敗');

        } else {

            return $this->fail('資料不正確，刪除失敗');
        }

    }

}