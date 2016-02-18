<?php
use model\Order;
use model\OrderDetail;

class c808 {

    public function run() {
        $sn = Input::post('sn');
        $getno = Input::post('getno') ?: null;
        $delivery = strtotime(Input::post('delivery')) ?: null;
        $signoff = strtotime(Input::post('signoff')) ?: null;
        $receivable = strtotime(Input::post('receivable')) ?: null;
        $status = Input::post('status') ?: 1;

        $order = Order::find_by_odm001($sn) ?: new Order;
        $order->odm005 = $signoff ? date("Y-m-d", $signoff) : null;             //核帳日期
        $order->odm007 = $delivery ? date("Y-m-d", $delivery) : null;           //取貨日期
        $order->odm008 = $receivable ? date("Y-m-d", $receivable) : null;       //收款日期
        $order->odm011 = $getno;                                                //取貨序號
        
        $result = $order->save();
        // echo "<pre>"; print_r($result); echo "</pre>";

        return array(
            'err' => ($result ? 0 : 1),
            'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        );
        
    }

}