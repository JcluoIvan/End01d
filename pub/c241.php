<?php
/* (公司) 進貨 詳細清單 */

use model\Product;
use model\ProductInventory;
use model\ProductPurchase;
use model\ProductInventoryDetail;
use model\Agent;

/*
驗證
    產品編號
    進貨數量
    雷達站編號
    進貨單號
*/
class c241 {

    public function run() {

        $id = Input::post('id');
        $pid = Input::post('pid');
        $count = Input::post('count');
        $date = Input::post('date');

        $purchase = ProductPurchase::find_by_pdp001($id) ?: new ProductPurchase;

        $purchase->pdp002 = $purchase->pdp002 ?: $pid;
        $purchase->pdp003 = intval($count);
        $purchase->pdp004 = 0;
        $purchase->pdp005 = '0';
        $purchase->pdp006 = $date;
        $purchase->pdp008 = User::get('id');

        $result = $purchase->save();

        if (!$result){
            return array(
                'status' => false,
                'message' => Lang::get('save.fail')
            );
        }

        /* 刪除後，寫入 */
        $sql = "DELETE FROM `product_inventory_detail` 
                WHERE pid002 ='purchase' AND pid003 = ?";

        $values = array($purchase->pdp001);

        ProductInventoryDetail::connection()->query($sql, $values);

        $sql = "REPLACE INTO `product_inventory_detail` 
                VALUES(?, 'purchase', ?, ?, ?)";

        $values = array(
            0,
            $purchase->pdp001,
            $purchase->pdp002,
            $purchase->pdp003,
        );
        ProductInventoryDetail::connection()->query($sql, $values);

        /* 更新庫存剩餘數量 */
        ProductInventory::countProduct($pid, $aid);

        return array(
            'status' => true,
            'message' => Lang::get('save.success')
        );
    }


}