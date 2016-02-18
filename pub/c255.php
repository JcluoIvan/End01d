<?php
use model\ProductPurchaseDetail;

/* 建立 purchase detail */
class c255 extends \pub\GatewayApi{

    public function run() {

        $id = Input::post('id') ?: 0;  

        if ($delete = ProductPurchaseDetail::find_by_ppd001($id)) {
            return $delete->delete()
                ? $this->success()
                : $this->fail('不明原因，資料刪除失敗');

        } else {

            return $this->fail('資料不正確，刪除失敗');
        }

    }

}