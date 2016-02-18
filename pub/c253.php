<?php
use model\ProductPurchase;
use model\Product;
use model\Agent;

/* 儲存 purchase (公司) */
class c253 extends \pub\GatewayApi{

    const NO_AFFIX = 'C';

    public function run() {

        $id = Input::post('id') ?: 0;  

        $purchase = ProductPurchase::find_by_pdp001($id) ?: $this->createPurchase();

        if (empty($purchase)) {
            return $this->fail('資料建立失敗');
        }

        // $purchase->pdp002 = $no;
        $purchase->pdp003 = 0;
        $purchase->pdp004 = Input::post('date') ?: date('Y/m/d');
        $purchase->pdp005 = User::get('id');
        $purchase->pdp009 = Input::post('remark');

        if ($purchase->save()) {
            $data = array('id' => $purchase->pdp001);
            return $this->success('Success', $data);
        } else {
            return $this->fail('資料建立失敗');
        }

    }
    public function createPurchase() 
    {

        $affix = self::NO_AFFIX . date('ymd');

        $len = strlen($affix) + 1;

        /* 取得今日的 max 編號 */
        $sql_max = "SELECT IFNULL(SUBSTR(MAX(pdp002), {$len}), 0) + 1
                    FROM ( 
                        SELECT pdp002 
                        FROM product_purchase 
                        WHERE pdp002 > :def AND pdp003 = 0
                    ) AS tab";
        $sql = "INSERT INTO product_purchase (pdp002, pdp005)
                VALUES (
                    CONCAT(:code, LPAD(({$sql_max}), 4, 0)),
                    :editor
                )";
        $data = array(
            ':code' => $affix,
            ':def' => "{$affix}0000",
            ':editor' => User::get('id')
        );
        ProductPurchase::connection()->query($sql, $data);
        $id = ProductPurchase::connection()->insert_id();
        return ProductPurchase::find_by_pdp001($id) ?: false;

    }


}