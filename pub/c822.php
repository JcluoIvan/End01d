<?php
use model\Order;
use model\OrderDetail;
use model\Product;
use model\Reject;
use model\Swap;
use model\Member;

class c822 extends pub\GatewayApi{

    public function run() {
        //登入者的ID
        $id = User::get('id');
        $no = Input::post('no');
        $time = date('H:i:s');
        $rows = array();
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
            array('rejectMore')
        );

        if (empty($result)) {
            return $this->fail("{$time}: 查無[ {$no} ]訂單資料");
        } elseif (empty($result->rejectMore)) {
            return $this->fail("{$time}: 查無[ {$no} ]退貨資料");
        }

        /* join 商品資料 */
        Reject::with($result->rejectMore, array('product'));
        
        foreach($result->rejectMore as $row){

            if (! empty($row->odr017)) continue;

            $tmp = $row->attributes(true);
            $product = $row->product ?: new Product;
            $tmp['pname'] = $product->pdm004;
            $tmp['totalmoney'] = $tmp['money'] * $tmp['amount'];
            $rows[] = $tmp;
        }

        return count($rows) === 0
            ? $this->fail("{$time}: [ {$no} ] 訂單已退貨")
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