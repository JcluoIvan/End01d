<?php
use model\Order;

class c1207 {

    public function run() {

        $id = Input::post('oid');

        $order = Order::find_by_odm002($id) ?: new Order;
        
        $keyman1 = User::get('account');
        $keyman2 = '';
        
        $order->odm013 = Input::post('getsn') ?: 0;      //取貨編號
        $order->odm019 = Input::post('status') ?: 0;      //取貨狀態(訂單狀態)

        $result = $order->save();

        return array(
            'err' => ($result ? 0 : 1),
            'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        );
        
    }

}