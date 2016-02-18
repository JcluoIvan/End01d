<?php
use model\ProductPurchaseDetail;
use model\Product;
use model\Agent;

/* 建立 purchase detail */
class c254 extends \pub\GatewayApi{

    public function run() {

        $id = Input::post('id') ?: 0;

        if (! empty($id)) {
            return $this->updatePurchase($id);
        } else {
            return $this->createPurchase();
        }

    }
    public function updatePurchase($id) {
        $detail = ProductPurchaseDetail::find_by_ppd001($id) ?: false;
        $count = intval(Input::post('count')) ?: 0;
        if (empty($detail)) return $this->fail('查無資料');

        $detail->ppd005 = $count;
        if ($detail->save()) {
            return $this->success();
        } else {
            return $this->fail('資料更新失敗');
        }

    }
    public function createPurchase() 
    {
        $parent = Input::post('parent') ?: 0;  
        $pid = Input::post('pid') ?: 0;
        $aid = 0;
        $count = Input::post('count') ?: 0;

        if (! Product::find_by_pdm001($pid)) {
            return $this->fail('資料不正確, 無法新增');
        }

        $options = array(
            'conditions' => array(
                'ppd002 = ? AND ppd003 = ? AND ppd004 = ?',
                $parent,
                $aid,
                $pid,
            )
        );
        $detail = ProductPurchaseDetail::first($options) ?:
            new ProductPurchaseDetail;

        $detail->ppd002 = $parent;
        $detail->ppd003 = $aid;
        $detail->ppd004 = $pid;
        $detail->ppd005 = $count;
        // $detail->ppd006 = date('Y/m/d');
        $detail->ppd007 = User::get('id');

        if ($detail->save()) {
            return $this->success();
        } else {
            return $this->fail('資料建立失敗');
        }
    }


}