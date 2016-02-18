<?php
use model\Order;
# 刪除 order (軟刪除)
class c327 extends pub\GatewayApi{

    public function run() {

        $sn = Input::post('sn');

        $order = Order::find_by_odm001($sn);

        if (empty($order)) {
            return $this->fail('查無訂單資料, 請重新整理清單');
        }

        return $order->delete()
            ? $this->success('訂單刪除成功')
            : $this->fail('訂單刪除失敗');

    }

}