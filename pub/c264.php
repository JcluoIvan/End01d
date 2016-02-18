<?php
use model\ProductPurchaseDetail;
use model\ProductInventory;
use model\Product;
use model\Agent;

/* 建立 purchase detail */
class c264 extends \pub\GatewayApi{

    public function run() {

        $id = Input::post('id') ?: 0;

        if (! empty($id)) {
            return $this->updatePurchase($id);
        } else {
            return $this->createPurchase();
        }

    }
    public function getAgentId() {
        return intval(Input::post('aid') ?: 0);
    }
    public function getProductId() {
        return intval(Input::post('pid') ?: 0);
    }

    /* 展示中心存貨 */
    public function inventory() {
        $pid = $this->getProductId();
        $aid = $this->getAgentId();
        $options = array(
            'conditions' => array('pin002 = ? AND pin003 = ? ', $aid, $pid)
        );
        $row = ProductInventory::first($options) ?: new ProductInventory;
        return intval($row->pin004 ?: 0);
    }
    public function updatePurchase($id) 
    {
        $detail = ProductPurchaseDetail::find_by_ppd001($id) ?: false;
        $count = intval(Input::post('count')) ?: 0;
        if (empty($detail)) return $this->fail('查無資料');

        $total = $this->inventory();
        $sub = $count - intval($detail->ppd005);
        if ($sub > $total) return $this->fail('修改失敗, 展示中心存貨不足' . ", {$sub} , {$total}");

        $detail->ppd005 = $count;

        if ($detail->save()) {
            return $this->success();
        } else {
            return $this->fail('資料更新失敗');
        }

    }

    public function createPurchase() 
    {
        $parent = intval(Input::post('parent') ?: 0);
        $count = intval(Input::post('count') ?: 0);
        $pid = $this->getProductId();
        $aid = $this->getAgentId();

        if (
            ! (Product::find_by_pdm001($pid)) ||
            ! (Agent::find_by_age001($aid))
        ) {
            return $this->fail('資料不正確, 無法新增');
        }

        $total = $this->inventory();
        if ($count > $total) return $this->fail('新增失敗, 公司存貨不足' . ", {$count}, {$total}");

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
        $detail->ppd009 = ProductPurchaseDetail::TYPE_RETURN;

        if ($detail->save()) {
            return $this->success();
        } else {
            return $this->fail('資料建立失敗');
        }
    }


}