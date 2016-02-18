<?php
use model\Order;
use model\OrderDetail;
use model\Product;
use model\Reject;
use model\Swap;

class c823 extends pub\GatewayApi{

    public function run() {
        $no = Input::post('no');
        $time = date('H:i:s');
        $options = array(
            'conditions' => array('odm002 = ? AND odm010 = ?', $no, 'csv')
        );
        $order = Order::first($options);

        if(empty($order)) return $this->fail("{$time}: 查無[ {$no} ]訂單資料");
        // if (! empty($order->odm007) ) return $this->fail("{$time}: [ {$no} ] 訂單已取貨");

        $oid = $order->odm001;
        $swapstatus = 0;
        $optionReject = array(
            'conditions' => array('odr002 = ? AND odr013 = ?', $oid, $swapstatus)
        );
        $reject = Reject::find('all',$optionReject);
        $result = true;
        foreach ($reject as $row) {
            $row->odr017 = date("Y-m-d H:i:s");
            $result = $row->save(false) && $result;
        }
        
        return $result
            ? $this->success("{$time}: 退貨成功, 訂單編號：{$order->odm002}")
            : $this->fail("{$time}: 退貨失敗");
        
    }

    

}