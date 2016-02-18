<?php
use model\Order;
use model\OrderDetail;
use model\Product;
use model\Reject;
use model\Swap;

class c821 extends pub\GatewayApi{

    public function run() {
        $id = User::get('id');
        $no = Input::post('no');
        $time = date('H:i:s');
        $options = array(
            'conditions' => array(
                'odm002 = ? AND odm010 = ? AND odm022 = ?', 
                $no, 
                Order::MODE_CSV,
                $id
            )
        );
        $order = Order::first($options);
        if(empty($order)) return $this->fail("{$time}: 查無[ {$no} ]訂單資料");
        // if (! empty($order->odm007) ) return $this->fail("{$time}: [ {$no} ] 訂單已取貨");

        $oid = $order->odm001;
        $optionSwap = array(
            'conditions' => array(
                'ods002 = ? AND ods013 = 0 AND ods015 IS NULL', 
                $order->odm001
            )
        );
        $swap = Swap::all($optionSwap);
        $fails = array();
        foreach ($swap as $row) {
            $row->ods015 = date("Y-m-d H:i:s");
            if (! $row->save(false)) {
                exit("error");
                $fails[] = $row->ods003;
            }
        }
        
        return count($fails) === 0
            ? $this->success("{$time}: 換貨成功, 訂單編號：{$order->odm002}")
            : $this->fail("{$time}: 換貨失敗", array('rows' => $fails));
        
    }

    

}