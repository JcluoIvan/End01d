<?php
use model\ProductPurchase;

/* 刪除 purchase  */
class c217 extends \pub\GatewayApi{

    public function run() {

        $id = Input::post('id') ?: 0;

        if ($purchase = ProductPurchase::find_by_pdp001($id)) {
            return $purchase->delete()
                ? $this->success()
                : $this->fail('不明原因，資料刪除失敗');
        } else {
            return $this->fail('資料不正確，刪除失敗');
        }
    }

}