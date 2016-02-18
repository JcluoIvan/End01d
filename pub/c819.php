<?php
use model\Order;
use model\OrderDetail;
use model\Product;
use model\Reject;
use model\Swap;

class c819 extends pub\GatewayApi{

    public function run() {
        $no = Input::post('no');
        $time = date('H:i:s');
        $options = array(
            'conditions' => array('odm002 = ? AND odm010 = ?', $no, 'csv')
        );
        $order = Order::first($options);
        
        if(empty($order)) return $this->fail("{$time}: 查無[ {$no} ]訂單資料");
        if (! empty($order->odm007) ) return $this->fail("{$time}: [ {$no} ] 訂單已取貨");
        
        $order->odm007 = date("Y-m-d H:i:s");            //到店取貨日期
        
        return $order->save()
            ? $this->success("{$time}: 核帳成功, 訂單編號：{$order->odm002}")
            : $this->fail("{$time}: 核帳失敗");
        
    }

    

}