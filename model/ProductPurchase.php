<?php
namespace model;
use ActiveRecord\Model;

/* 進貨記錄表主單 */
class ProductPurchase extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'product_purchase';

    // explicit pk since our pk is not "id"
    static $primary_key = 'pdp001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $soft_delete = 'pdp006';

    static $has_to = array(
        'agent' => array('Agent', 'age001', 'pdp003', 'single'),
        'editor' => array('Agent', 'age001', 'pdp005', 'single'),
    );

    # 進貨 (pdp008)
    const TYPE_PURCHASE = 'purchase';
    # 遏貨 (pdp008)
    const TYPE_RETURN = 'return';

    // public $product = null;
    // public $agent = null;

    static $attribute_transform = array(
        'pdp001' => 'id',   
        'pdp002' => 'no',   /* 進貨編號 */
        'pdp003' => 'aid',  /* agent.age001 雷達站 id */
        'pdp004' => 'date', /* 進貨時間 */
        'pdp005' => 'editor',   /* 最後修改者 */
        //'pdp006' => 'editor',   /* 是否刪除(軟刪除) */
        'pdp007' => 'pn',   /* 郵件編號 parcel number*/
        'pdp008' => 'type',   /* 進/退貨類別 purchase | return */
        'pdp009' => 'remark', /* 備註 */ 
    );

    public function afterSave() 
    {
        $update = $this->getUpdateAttribute() ?: array();
        $action = (
             array_key_exists('pdp004', $update) && is_null($update['pdp004'])
        ) ? LogPurchase::ACTION_ADD : LogPurchase::ACTION_EDIT;

        /* 由於進貨編號是由 sql 產生, 所以第一次存檔時就已存在 */
        ($action == LogPurchase::ACTION_ADD) && $this->source_attributes['pdp002'] = '';

        LogPurchase::log($this, $action);
    }

    /* 主單刪除, 觸發明細刪除 */
    public function afterDelete() 
    {
        LogPurchase::logDelete($this);
        $options = array(
            'conditions' => array('ppd002 = ?', $this->pdp001)
        );

        $details = ProductPurchaseDetail::all($options);
        foreach ($details as $row) {
            $row->delete();
        }
    }

    public static function getRow($id) {
        $row = ProductPurchase::find_by_pdp001($id) ?: new ProductPurchase;
        $row->product = $row->pdp002
            ? (Product::find_by_pdm001($row->pdp002) ?: new Product)
            : new Product;

        $row->agent = $row->pdp004
            ? (Agent::find_by_age001($row->pdp004) ?: new Agent)
            : new Agent;

        return $row;
    }

    public static function getTypes($key = null) {
        if ($key === null) {
            return static::$types;
        } else {
            return isset(static::$types[$key])
                ? static::$types[$key]
                : null;
        }
    }

    public function getType() {
        return static::getTypes($this->new002);
    }
}

