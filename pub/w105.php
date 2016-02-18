<?php
use model\Agent;
use model\Product;
use model\ProductPhoto;
use model\ProductInventory;
use model\Member;
use model\Order;
use model\OrderDetail;
use model\OrderCache;
use model\OrderDetailCache;
use model\Setting;
// use model\AppRegister;
/* 取得下單資料(下訂單前的動作 ) */
/* order->save() 參考 c306.php or c307.php */ 

class w105 extends pub\GatewayApi{

    public function run() {

        $mid = User::get('id');

        /* 購買商品 id */
        $product_id = Input::post('product_id') ?: array();

        /* 購買商品 數量 */
        $product_count = Input::post('product_count');

        /* 購買的 [商品編號] => 數量 */
        $buy = array();
        foreach ($product_id as $idx => $id) {
            if ($product_count[$idx] < 1) continue;
            $buy[$id] = $product_count[$idx];
        }

        if (count($buy) < 1) return $this->fail('請至少選購一項商品');

        /* Query 購買的商品 */
        $options = array('conditions' => array('pdm001 in (?)', array_keys($buy)));
        $products = Product::find('all', $options);

        $member = Member::with(
            Member::find_by_mem001($mid),
            array('al', 'ar')
        );

        $order = $this->setOrderData(new Order, $member, $buy, $products);

        /* 回傳為陣例 (代表有錯誤) */
        if (is_array($order)) return $order;

        $order->validates();

        # 檢查是否為信用卡付款
        $is_card = $order->odm009 === Order::PAY_TYPE_CARD;

        # 建立訂單, 若為信用卡付款, 則訂單建立在 OrderCache
        $order = $is_card ? new OrderCache : new Order;
        $order = $this->setOrderData($order, $member, $buy, $products);
        // $order = $this->setOrderData($order, $member, $buy, $products);

        if ($order->save()) {

            /* 建 detail */
            foreach ($products as $row) {
                $detail = $is_card ? new OrderDetailCache : new OrderDetail;
                $detail->odd002 = $order->odm001;
                $detail->odd003 = $row->pdm001;
                $detail->odd004 = $row->pdm006;
                $detail->odd006 = $buy[$row->pdm001];
                $detail->save();
            } 

            if (! $is_card) {
                $order->sendMail();
            }

            $data = array(
                'oid' => $order->odm001,
                'no' => $order->odm002,
                'point' => $order->getMemberPoint(true),
                'pay_by_card' => $is_card
            );

            return array(
                'status' => true,
                'message' => '購買成功',
                'data' => $data,
            );
        } else {
            return array(
                'status' => false,
                'message' => '購買失敗',
                'error' => $order->getError()
            );
        }
    }

    public function inventory($buy, $member) 
    {

        $products = array_keys($buy);

        $options = array(
            'conditions' => array(
                'pdm001 IN (?)',
                $products
            )
        );

        /* 取得雷達站商品數量 */
        $result = Product::with(
            Product::find('all', $options),
            array(
                'inventory' => array(
                    'conditions' => array('pin002 = ?', $member->mem017)
                )
            )
        );

        $product = array();

        foreach ($result as $row) {
            $product[$row->pdm001] = $row;
        }

        /* 檢查商品是否有缺少 */
        $lack = array();
        foreach ($buy as $pid => $count) {
            if (! isset($product[$pid])) {
                throw new Exception("查無此產品 ({$pid}).");
            }
            $value = $product[$pid]->inventory 
                ? $product[$pid]->inventory->pin004 : 0;
            $name = $product[$pid]->pdm004;
            if ($product[$pid]->pdm007 == 0) {
                $lack[] = "{$name} 已下架。";
            } else if ($value < $count) {
                $name = $product[$pid]->pdm004;
                $lack[] = "{$name} 數量不足。 剩於數量 {$value} ";
            }
        }
        return $lack;
    }

    public function setOrderData($order, $member, $buy, $products) 
    {

        /* to_csv.到店取貨, to_house 送貨到府 */
        $type = Input::post('type');

        /* 購物金折抵 */
        $point = Input::post('point');

        /* 付款資訊 */
        $pay_type = Input::post('pay_type');

        $l_agent = $member->al;
        $r_agent = $member->ar;//Agent::find_by_age001($member->mem017);

        /* 實收金額 */
        $total = 0;

        /* 商品金額 */
        $real_total = 0;

        /* 必要的購物金 (有購物金商品時, 必需使用購物金) */
        $real_point = 0;

        foreach ($products as $row) {
            if ($row->pdm019) {
                $real_point += $row->pdm006 * $buy[$row->pdm001];
            }
            $real_total += $row->pdm006 * $buy[$row->pdm001];
        }

        if ($member->mem021 < $point) return $this->fail('您的購物金不足, 無法購買');


        /* 購物金需為 購買總額 or 剩餘購物金 or 會員填寫的購物金 中最低的 */
        $point = min($real_total, $member->mem021, $point);

        $total = $real_total;

        /* 實際應收金額, (不含運費) (計算除了點數商品, 現金抵用購物金後的應付金額) */
        $real_total = $real_total - $point;

        /* 計算運費 (宅配 & 實際金額低於 5000 才需要運費) */
        $fare = ($type === 'to_house' && $real_total < 5000) ? Setting::value('Fare') : 0;

        /* 總金額再加上運費 */
        // if ($order === false) $this->fail('購買失敗');

        /* 總金額 */
        $total += $fare;

        $order->odm003 = $total;             /* 總金額 */
        $order->odm004 = $point;             /* 此次交易使用的購物金點數 (0 為不使用) */
        $order->odm005 = null;               /* 訂單狀態(1->處理中 2->已取貨 3->已出貨 4->核帳) */
        $order->odm006 = date('Y/m/d');      /* 交易日期 */
        $order->odm007 = null;               /* 取貨日期(店取) */
        $order->odm008 = null;               /* 收款日期 */
        $order->odm009 = $real_total > 0 ? $pay_type : Order::PAY_TYPE_NONE;    /* 付款方式, card.信用卡 , atm.ATM轉帳 , cash.現金 */
        $order->odm010 = $type === 'to_house' ? 'house' : 'csv';  /* house => 宅配,, csv => 店取) */
        $order->odm011 = null;                          /* 取貨序號 */
        $order->odm012 = $r_agent->age001;              /* 取貨店(雷達站) id */
        $order->odm013 = $member->mem001;               /* 下單會員 id */
        $order->odm014 = Input::post('member_name');    /* 訂貨人姓名 */
        $order->odm015 = Input::post('member_phone');   /* 訂貨人電話 */
        $order->odm016 = Input::post('member_city');    /* 鄉鎮市區 */
        $order->odm017 = Input::post('member_address'); /* 送貨地址 */
        $order->odm018 = Input::post('receipt_type');   /* 統一發票 詳情參考 model/Order.php */
        $order->odm019 = Input::post('receipt_ubn');    /* 統一編號 */
        $order->odm020 = Input::post('receipt_title');  /* 發票抬頭 */
        $order->odm021 = $l_agent->age001;              /* 指揮站 id */
        $order->odm022 = $r_agent->age001;              /* 雷達站 id */
        $order->odm023 = $member->mem018;               /* 會員的上三層 id */
        $order->odm024 = $member->mem019;               /* 會員的上二層 id */
        $order->odm025 = $member->mem020;               /* 會員的上一層 id */
        $order->odm026 = $l_agent->age017;              /* 指揮站回饋 % */
        $order->odm027 = $r_agent->age017;              /* 雷達站回饋 % */
        $order->odm028 = Setting::value('RewardPercent');   /* 會員回饋 % */
        $order->odm029 = $fare;   /* 運費 */
        $order->odm030 = $real_total;                   /* 應收 */
        $order->odm031 = null;                          /* 應收日期 */
        return $order;
    }

}