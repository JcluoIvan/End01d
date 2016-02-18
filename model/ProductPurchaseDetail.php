<?php
namespace model;
use ActiveRecord\Model;

/* 進貨記錄表主單 */
class ProductPurchaseDetail extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'product_purchase_detail';

    // explicit pk since our pk is not "id"
    static $primary_key = 'ppd001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';
    static $soft_delete = 'ppd008';

    static $has_to = array(
        'purchase' => array('ProductPurchase', 'pdp001', 'ppd002', 'single'),
        'agent' => array('Agent', 'age001', 'ppd003', 'single'),
        'product' => array('Product', 'pdm001', 'ppd004', 'single'),
        'editor' => array('Agent', 'age001', 'ppd007', 'single')
    );

    // public $product = null;
    // public $agent = null;

    # 進貨 (ppd009)
    const TYPE_PURCHASE = 'purchase';
    # 退貨 (ppd009)
    const TYPE_RETURN = 'return';

    static $attribute_transform = array(
        'ppd001' => 'id',   
        'ppd002' => 'parent',   /* 主單編號 */
        'ppd003' => 'aid',      /* agent.age001 雷達站 id */
        'ppd004' => 'pid',      /* 商品 id */
        'ppd005' => 'count',    /* 數量 */
        'ppd006' => 'date',     /* 下單日期 (同主單日期) */
        'ppd007' => 'editor',   /* 最後修改者 */
        // 'pdd008' => 'delete_at' 
        'pdd009' => 'type',    /* 進/退貨類別 purchase | return */
    );

    public function afterSave() 
    {
        LogPurchase::log($this);
        
        /* 更新存貨數量 */
        $this->updateInventoryDetail();


        // LogPurchase::log($this);
    }

    /* 明細刪除, 觸發存貨數量的更新 */
    public function afterDelete() 
    {
        LogPurchase::logDelete($this);
        /* 更新存貨數量 */
        $this->deleteInventoryDetail();
    }

    public function realCount() {
        return intval($this->ppd005) * ((self::TYPE_RETURN === $this->ppd009) ? -1 : 1);
    }

    /**
     * 更新 ProductInventoryDetail
     * @return [type] [description]
     */
    public function updateInventoryDetail() 
    {

        $options = array(
            'conditions' => array(
                "pid002 = ? AND pid003 = ? AND pid004 = ? AND pid005 = ?",
                $this->ppd003,
                ProductInventoryDetail::TYPE_PURCHASE,
                $this->ppd001,
                $this->ppd004
            )
        );
        $inv_details = 
            ProductInventoryDetail::all($options);
        $first = count($inv_details) 
            ? array_shift($inv_details) 
            : new ProductInventoryDetail;
        $first->pid002 = $this->ppd003;
        $first->pid003 = ProductInventoryDetail::TYPE_PURCHASE;
        $first->pid004 = $this->ppd001;
        $first->pid005 = $this->ppd004;
        $first->pid006 = $this->realCount();
        $first->save();

        /* 刪除多餘資料 */
        foreach ($inv_details as $row) {
            $row->delete();
        }
    }

    /**
     * 刪除 ProductInventoryDetail
     * @return [type] [description]
     */
    public function deleteInventoryDetail() 
    {
        $options = array(
            'conditions' => array(
                "pid002 = ? AND pid003 = ? AND pid004 = ? AND pid005 = ?",
                $this->ppd003,
                ProductInventoryDetail::TYPE_PURCHASE,
                $this->ppd001,
                $this->ppd004
            )
        );
        $inv_details = ProductInventoryDetail::all($options) ?: array();
        foreach ($inv_details as $row) {
            $row->delete();
        }

    }

}
