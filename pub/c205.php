<?php
/* 進貨 新增修改 */

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
class c205 {

    public function run() {

        $id = Input::post('id');
        $aid = Input::post('agent_id');
        $pid = Input::post('product_id');
        $count = Input::post('count');
        $date = Input::post('date');
        $no = Input::post('no');

        $agent = Agent::find_by_age001($aid) ?: new Agent;
        $product = Product::find_by_pdm001($pid) ?: new product;

        /* 進貨單號 */
        if (!$no) {
            exit (json_encode(array(
                'status' => false,
                'validates' => array(
                    '[name=no]' => array(
                        'unique' =>Lang::get('page02.validator.pdp005')
                    )
                ),
            )));
        }

        /* 進貨數量 */
        if (!$count) {
            exit (json_encode(array(
                'status' => false,
                'validates' => array(
                    '[name=count]' => array(
                        'unique' =>Lang::get('page02.validator.pdp003')
                    )
                ),
            )));
        }

        /* 雷達站編號 */
        if (!$agent->age001) {
            exit (json_encode(array(
                'status' => false,
                'validates' => array(
                    '[name=agent_id]' => array(
                        'unique' =>Lang::get('page02.validator.pdp004')
                    )
                ),
            )));
        }

        /* 產品編號 */
        if (!$product->pdm001) {
            exit (json_encode(array(
                'status' => false,
                'validates' => array(
                    '[name=product_id]' => array(
                        'unique' =>Lang::get('page02.validator.pdp002')
                    )
                ),
            )));
        }

        $row = ProductPurchase::find_by_pdp001($id) ?: new ProductPurchase;
        $row->pdp002 = $pid;
        $row->pdp003 = $count;
        $row->pdp004 = $aid;
        $row->pdp005 = $no;
        $row->pdp006 = $date;
        $row->pdp007 = $row->pdp007 ?: 0;
        $result = $row->save();

        if (!$result){
            return array(
                'status' => false,
                'message' => Lang::get('save.fail')
            );
        }

        /* 刪除後，寫入 */
        $sql = "DELETE FROM `product_inventory_detail` 
                WHERE pid002 ='purchase' AND pid003 = ?";

        $values = array($row->pdp001);

        ProductInventoryDetail::connection()->query($sql, $values);

        $sql = "REPLACE INTO `product_inventory_detail` 
                VALUES(?, 'purchase', ?, ?, ?)";

        $values = array(
            $aid,
            $row->pdp001,
            $pid,
            $row->pdp003,
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