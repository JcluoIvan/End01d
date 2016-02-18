<?php
namespace model;
use ActiveRecord\Model;

class OrderDetail extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'order_detail';

    // explicit pk since our pk is not "id"
    static $primary_key = 'odd001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    static $has_to = array(
        'product' => array('Product', 'pdm001', 'odd003', 'single'),
        'reject' => array('Reject', 'odr002', 'odd003'),
    );

    # 軟刪除
    static $soft_delete = 'odd007';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    /* 此資料的雷達站 (在刪除、修改數量時, 影響庫存計算時用到) */
    public $r_agent_id = 0;

    static $attribute_transform = array(
        'odd001' => 'id',       /* 流水號 */
        'odd002' => 'oid',      /* 訂單 id */
        'odd003' => 'pid',      /* 商品 id */
        'odd004' => 'money',    /* 購買時商品單價 */
        'odd005' => 'none',     /* 目前未使用 */
        'odd006' => 'count',    /* 購買數量 */
    );

    public function afterSave() 
    {

        if (get_class($this) !== 'model\OrderDetail') return;

        /* 更新存貨數量 */
        $this->updateInventoryDetail();
        LogOrder::log($this);

    }

    public function afterDelete() {
        if (get_class($this) !== 'model\OrderDetail') return;
        $this->updateInventoryDetail();
        LogOrder::log($this);
    }

    /**
     * 更新 ProductInventDetail 資料 (商品數量) PS: 通常明細不會再修改
     * @return void()
     */
    public function updateInventoryDetail($order = null) {

        $id = $this->odd001;
        $oid = $this->odd002;
        $pid = $this->odd003;
        $order = $order ?: Order::find_by_odm001($this->odd002);
        
        # 若是刪除 detail , 則直接砍 inventory detail 資料
        if (! empty($this->odd007)) {
            $options = array(
                'conditions' => array(
                    'pid003' => 'order',
                    'pid004' => $id,
                    'pid005' => $pid
                )
            );
            $inv_detail = ProductInventoryDetail::first($options);
            if ($inv_detail && ! $inv_detail->delete()) {
                $message = 'ProductInventoryDetail 刪除失敗: ' . print_r($inv_detail, true);
                throw new Exception($message);
            }
            return;
        }

        if (empty($order)) 
            throw new Exception("查無下單資料: " . print_r($this, true));

        if (empty($order->odm007)) return;

        /* 若為宅配到府, 則商品數量扣公司的 */
        $rid = ($order->odm010 == Order::MODE_HOUSE) ? 0 : $order->odm012;

        $options = array(
            'select' => 'IFNULL(SUM(odr008), 0) AS total',
            'conditions' => array(
                'odr002 = ? AND odr006 = ? AND odr013 = 1 AND odr016 IS NOT NULL', 
                $oid, 
                $pid
            )
        );
        $reject = intval(Reject::first($options)->total);
        $total = max(intval($this->odd006) - $reject, 0);

        $options = array(
            'conditions' => array(
                'pid002' => $rid,
                'pid003' => 'order',
                'pid004' => $id,
                'pid005' => $pid
            )
        );
        $inv_detail = 
            ProductInventoryDetail::first($options) ?: new ProductInventoryDetail;

        $inv_detail->pid002 = $rid;
        $inv_detail->pid003 = 'order';
        $inv_detail->pid004 = $id;
        $inv_detail->pid005 = $pid;
        $inv_detail->pid006 = (- $total);
        if (! $inv_detail->save()) {
            $message = 'ProductInventoryDetail 更新失敗: ' . print_r($inv_detail, true);
            throw new Exception($message);
        }

    }

    /**
     * 刪除 ProductInventDetail 資料 (商品數量)
     * @return [type] [description]
     */
    public function deleteInventoryDetail() 
    {

        $rid = $this->r_agent_id;

        /* 若沒設定 雷達站 id , 則去資料庫找 */
        if (empty($rid)) {
            $row = Order::find_by_odm001($this->odd002);
            $rid = $row->odm027;
        }

        $options = array(
            'conditions' => array(
                'pid002' => $rid,
                'pid003' => 'order',
                'pid004' => $this->odd001,
                'pid005' => $this->odd003
            )
        );
        if ($inv_detail = ProductInventoryDetail::first($options)) {
            $inv_detail->delete();
        }

    }
}

