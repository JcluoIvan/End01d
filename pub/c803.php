<?php
use model\Order;
use model\OrderDetail;
use model\Product;
use model\Reject;
use model\Swap;
use model\Member;

class c803 extends pub\GatewayApi{

    public function run() {
        //登入者的ID
        $id = User::get('id');
        $no = Input::post('no');
        $time = date('H:i:s');
        $rows = array();
        $options = array(
            'conditions' => array('odm002 = ? AND odm010 = ? AND odm022 = ?', $no, 'csv', $id)
        );
        $result = Order::with(
                        Order::first($options),
                        array('detail')
                    );
        if(empty($result)) return $this->fail("{$time}: 查無[ {$no} ]訂單資料");
        if (! empty($result->odm007)) return $this->fail("{$time}: [ {$no} ] 訂單已取貨");
        
        foreach($result->detail as $row){
            $tmp = $row->attributes(true);
            $pid = $tmp['pid'];
            $options_product = array(
                'conditions' => array('pdm001 = ?', $pid)
            );
            $product = Product::find_by_pdm001($tmp['pid']);
            $pp = $product->attributes(true);
            $tmp['pname'] = $pp['name'];
            $tmp['totalmoney'] = $tmp['money'] * $tmp['count'];
            if($result->odm008 != null){
                $tmp['pay'] = '已付款';
            }else{
                $tmp['pay'] = '尚未付款';
            }
            $rows[] = $tmp;
        }

        $data = array(
            'total' => $result->odm003,
            'point' => $result->odm004,
            'pay' => $result->odm030,
            'ispay' => ! empty($result->odm008), 
            'rows' => $rows,
        );

        return $this->success("訂單編號：{$no}", $data);
        
    }

    

}