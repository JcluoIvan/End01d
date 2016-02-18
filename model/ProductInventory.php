<?php
namespace model;
use ActiveRecord\Model;

class ProductInventory extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'product_inventory';

    // explicit pk since our pk is not "id"
    static $primary_key = 'pin001';

    // explicit connection name since we always 
    // want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'product' => array('Product', 'pdm001', 'pin003', 'single'),
    );

    static $attribute_transform = array(
        'pin001' => 'sn',
        'pin002' => 'aid',
        'pin003' => 'pid',
        'pin004' => 'total',
    );

    /**
     * 重新統計商品的剩餘數量
     * @param  [integer] $pid [商品編號]
     * @param  [integer] $rid [雷達站編號]
     * @return [integer]      [計算結果]
     */
    // public static function countProduct($pid_array, $rid)
    // {
    //     // if (!is_array($pid_array))
    //     //     $pid_array = array($pid_array);

    //     $options = array(
    //         'select' => implode(',', array(
    //                 'pid001 AS aid',
    //                 'pid004 AS pid',
    //                 'SUM(pid005) AS total',
    //         )),
    //         'conditions' => array(
    //             'pid001 = ?', $rid
    //             // 'pid001 = ? AND pid004 IN(?)',
    //             // $rid, $pid_array,
    //         ),
    //         'group' => 'pid004',
    //     );
    //     $detail = ProductInventoryDetail::find('all', $options) ?: array();

    //     foreach ($detail as $row) {

    //         $total = intval($row->total ?: 0);
    //         $pid = $row->pid;

    //         $options = array(
    //             'conditions' => array(
    //                 'pin002 = ? AND pin003 = ?',
    //                 $rid,
    //                 $pid,
    //             ),
    //         );
    //         $row = static::find('first', $options) ?: new ProductInventory;
    //         $row->pin002 = $rid;
    //         $row->pin003 = $pid;
    //         $row->pin004 = $total;
    //         $row->save();
    //     }
        
    //     return true;
    // }

}

