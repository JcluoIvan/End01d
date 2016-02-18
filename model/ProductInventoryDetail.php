<?php
namespace model;
use ActiveRecord\Model;

class ProductInventoryDetail extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'product_inventory_detail';

    // explicit pk since our pk is not "id"
    static $primary_key = 'pid001';//'mep001,mep002';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'pid001' => 'id',
        'pid002' => 'aid',
        'pid003' => 'type',
        'pid004' => 'id',
        'pid005' => 'pid',
        'pid006' => 'count',
    );

    const TYPE_ORDER = 'order';
    const TYPE_PURCHASE = 'purchase';

    public function afterSave()
    {
        /* 更新庫存數量 */
        $this->updateInventory();
    }

    public function afterDelete() 
    {
        /* 更新庫存數量 */
        $this->updateInventory();
    }


    /* 更新庫存數量 */
    public function updateInventory() 
    {
        $aid = intval($this->pid002);
        $pid = intval($this->pid005);

        $options = array(
            'select' => 'IFNULL(SUM(pid006), 0) AS total',
            'conditions' => array('pid002 = ? AND pid005 = ?', $aid, $pid)
        );
        $row = static::first($options);

        $options = array(
            'conditions' => array('pin002 = ? AND pin003 = ?', $aid, $pid)
        );
        $invent = 
            ProductInventory::find('first', $options) ?: new ProductInventory;
        $invent->pin002 = $aid;
        $invent->pin003 = $pid;
        $invent->pin004 = $row->total ?: 0;
        $invent->save();

        /* 更新公司庫存 */

        /* 取得公司進貨數量 */
        $options = array(
            'select' => 'IFNULL(SUM(pid006), 0) AS total',
            'conditions' => array('pid002 = 0 AND pid005 = ?', $pid)
        );
        $in = intval(static::first($options)->total);

        /* 取得公司出貨數量 */
        $options = array(
            'select' => 'IFNULL(SUM(pid006), 0) AS total',
            'conditions' => array(
                "pid002 > 0 AND pid005 = ? AND pid003 = ?", 
                $pid,
                self::TYPE_PURCHASE
            )
        );
        $out = intval(static::first($options)->total);

        $options = array(
            'conditions' => array('pin002 = 0 AND pin003 = ?', $pid)
        );
        $invent = 
            ProductInventory::find('first', $options) ?: new ProductInventory;
        $invent->pin002 = 0;
        $invent->pin003 = $pid;
        $invent->pin004 = $in - $out;
        $invent->save();

    }

}