<?php
use model\Order;
use model\OrderDetail;
use model\Receipt;

class c1220 {

    public function run() {
        $orderID = input::post('orderID');
        $sendDate = input::post('date3');
        $sendNo = input::post('sendNo');
        // 最後修改人員
        $keyman = User::get('account');

        $order = Order::find_by_odm001($orderID) ?: new Order;
        $order->odm007 = $sendDate ?: null;           //取貨日期
        $order->odm011 = $sendNo;                     //取貨序號
        $order->odm034 = $keyman;                     //最後修改人員

        $result = $order->save();
        
        return array(
            'status' => $result,
            'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        );
    }

}