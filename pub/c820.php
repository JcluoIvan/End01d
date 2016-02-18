<?php
use model\Order;
use model\OrderDetail;
use model\Product;
use model\Reject;
use model\Swap;
use model\Member;

class c820 extends pub\GatewayApi{

    public function run() {
        //登入者的ID
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

        $result = Order::with(
            Order::first($options),
            array('swapMore')
        );

        if(empty($result)) {
            return $this->fail("{$time}: 查無[ {$no} ]訂單資料");
        } elseif (empty($result->swapMore)) {
            return $this->fail("{$time}: 查無[ {$no} ]換貨資料");
        }

        /* join 商品資料 */
        Swap::with($result->swapMore, array('product'));

        $rows = array();
        foreach($result->swapMore as $row){
            if (! empty($row->ods015)) continue;
            
            $tmp = $row->attributes(true);
            $product = $row->product ?: new Product;
            $tmp['pname'] = $product->pdm004;
            $rows[] = $tmp;
        }

        return count($rows) === 0
            ? $this->fail("{$time}: [ {$no} ] 訂單已換貨")
            : $this->success(
                "訂單編號：{$no}", 
                array(
                    'rows' => $rows,
                    'oid' => $result->odm002,
                    'member' => $result->odm014,
                    'phone' => $result->odm015
                )
            );
        
    }

    

}