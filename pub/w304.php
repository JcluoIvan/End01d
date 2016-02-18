<?php
use model\Store;

/* 取得門市詳細資料 */
class w304 extends \pub\GatewayApi {

    public function run() 
    {
        $id = Input::post('id');

        $store = Store::find_by_sto001($id) ?: new Store;

        $data = array(
            'id' => $store->sto001,
            'img' => $store->imageUrl(),
            'map' => $store->sto003,
            'summary' => $store->sto004,
            'spending' => $store->sto005,
            'course' => $store->sto006,
        );

        return $this->success('success', array(
            'store' => $data
        ));

    }

}