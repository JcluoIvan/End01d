<?php
use model\Bank;
use model\Setting;
use model\Order;
use model\OrderDetail;

/* 取得購買記錄明細 */
class w107 {

    public function run() {

        $id = Input::post('id');
        
        $order = Order::with(
            Order::find_by_odm001($id), 
            array('detail', 'receipt')
        );

        $order_data = array(
            'id' => $order->odm001,
            'oid' => $order->odm002,
            'total' => $order->odm003,
            'coupon' => $order->odm004,
            'getmode' => $order->odm010,
            'fare' => $order->odm029,
            'money' => $order->odm030 - $order->odm032,
            'reject_money' => $order->odm032,
        );
        $order_data['pay'] = $order_data['money'] + $order_data['fare'];


        $order_data['receipt'] = $order->receipt ? $order->receipt->getMinImageUrl() : '';

        // $order_data['point'] = $order->odm031 != null ? $order->getMemberPoint() : false;
        $order_data['point'] = $order->getMemberPoint(true);

        $order_data['details'] = array();

        $detail = OrderDetail::with($order->detail, array('product'));
        foreach ($detail as $d) {
            $tmp = $d->attributes(true);
            $tmp['name'] = $d->product ? $d->product->pdm004 : '商品資料錯誤';
            $order_data['details'][] = $tmp;
        }

        $bank = null;
        if ($order->odm009 == 'atm') {
            $bank = array('name' => null, 'code' => null, 'account' => null);

            $values = explode('*', Setting::value('BankAccount'));
            $row = Bank::find_by_ban001($values[0]) ?: null;
            if (count($values) === 1 || empty($row)) {
                $bank['name'] = '銀行資料設定錯誤！！';
                $values = array('000', '000000000');
            } else {
                $bank['name'] = $row->ban002;
            }
            list($bank['code'], $bank['account']) = $values;
                
        }

        return array(
            'status' => true,
            'message' => '',
            'bank' => $bank,
            'order' => $order_data
        );
    }
}