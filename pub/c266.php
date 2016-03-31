<?php
use model\ProductPurchase;
use model\Product;
use model\Agent;

/* 建立 purchase detail (退貨) */
class c266 extends \pub\GatewayApi{

    const NO_AFFIX = 'T';

    public function run() {

        $id = Input::post('id') ?: 0;  
        $no = Input::post('no') ?: 0;
        $aid = Input::post('aid') ?: 0;
        $date = Input::post('date') ?: 0;
        $pn = Input::post('parcel_number');

        if (
            ! (Agent::find_by_age001($aid))
        ) {
            return $this->fail('資料不正確, 無法新增');
        }

        $purchase = ProductPurchase::find_by_pdp001($id) ?: $this->createPurchase();

        if (empty($purchase)) {
            return $this->fail('資料建立失敗');
        }

        // $purchase->pdp002 = $no;
        $purchase->pdp003 = $aid;
        $purchase->pdp004 = $date;
        $purchase->pdp005 = User::get('id');
        $purchase->pdp007 = $pn;
        $purchase->pdp008 = ProductPurchase::TYPE_RETURN;
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
                        WHERE SUBSTR(pdp002, 1, 7) = :def AND pdp003 > 0
                    ) AS tab";
        $sql = "INSERT INTO product_purchase (pdp002, pdp003, pdp005)
                VALUES (
                    CONCAT(:code, LPAD(({$sql_max}), 4, 0)),
                    :aid,
                    :editor
                )";
        $data = array(
            ':code' => $affix,
            ':def' => "{$affix}",
            ':aid' => intval(Input::post('aid')),
            ':editor' => User::get('id')
        );
        ProductPurchase::connection()->query($sql, $data);
        $id = ProductPurchase::connection()->insert_id();
        return ProductPurchase::find_by_pdp001($id) ?: false;

    }


}