<?php
use model\Agent;
use model\Product;
use model\ProductPhoto;
use model\Setting;
use model\Member;
use model\Order;
/* 取得下單資料(下訂單前的動作 ) */

class w104 extends pub\GatewayApi{

    public function run(){

        // $mid = Input::post('mid');
        $post_products = Input::post('products');
        $mid = User::get('id');

        $member = Member::find_by_mem001($mid) ?: false;

        if ($member === false) {
            $this->fail('查無此會員資料');
            return array(
                'status' => false,
                'message' => '查無此會員資料',
            );
        } elseif ($member->mem014) {
            $this->fail('此會員已停用中');
            return array(
                'status' => false,
                'message' => '此會員已停用中',
            );
        }

        /* 預設為 false */
        $products = array();
        foreach ($post_products as $row) {
            $products[$row['id']] = $row['count'];
        }

        $pids = array_keys($products);

        /* 檢查產品是否下架 或 是否存在 */
        $options = array(
            'conditions' => array('pdm001 IN (?) AND pdm007 = 1', $pids)
        );
        $result = Product::with(
            Product::find('all', $options),
            array(
                'inventory' => array(
                    'conditions' => array('pin002 = ? ', $member->mem017)
                )
            )
        );

        $columns = array('id', 'no');
        $real_point = 0;
        foreach ($result as $row) {
            $real_point += ($row->pdm019) 
                ? ($row->pdm006 * $products[$row->pdm001]) 
                : 0;
            $products[$row->pdm001] = $row->attributes($columns);
            $products[$row->pdm001]['money'] = $row->pdm006;
            $products[$row->pdm001]['count'] = $row->inventory
                ? $row->inventory->pin004 : 0;
        }
        if (max($member->mem021, 0) < $real_point) return $this->fail('您的購物金不足, 無法購買');

        $columns = array('id', 'no', 'name', 'city', 'address', 'bank');
        $agent = Agent::find_by_age001($member->mem017);
        $store = $agent->age014;
        $agent = $agent->attributes($columns);
        $agent['name'] = $store;
        
        $bank = array('code' => null, 'account' => null);
        list($bank['code'], $bank['account']) = 
            explode('*', Setting::value('BankAccount'));

        return array(
            'status' => true,
            'bank' => $bank,
            'point' => $member->mem021,
            'fare' => Order::getFare(),   //運費
            'agent' => $agent, //雷達站資訊
            'products' => array_values($products),   //產品資訊
            'real_point' => $real_point
        );
    }    

}