<?php
namespace model;
use ActiveRecord\Model;
use Lang;

class Product extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'product_manager';

    // explicit pk since our pk is not "id"
    static $primary_key = 'pdm001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    static $has_to = array(
        'inventory' => array('ProductInventory', 'pin003', 'pdm001', 'single'),
        'item' => array('ProductItem', 'pdi001', 'pdm003', 'single'),
        'photo' => array('ProductPhoto', 'pdo002', 'pdm001'),
        'sgs' => array('ProductPhoto', 'pdo002', 'pdm001'),
        'edm' => array('ProductPhoto', 'pdo002', 'pdm001'),
        'order_detail' => array('OrderDetail', 'odd003', 'pdm001'),
        'reject_detail' => array('Reject', 'odr006', 'pdm001'),
        'swap_detail' => array('Swap', 'ods006', 'pdm001'),
        'operate' => array('Agent', 'age001', 'pdm011', 'single'),
        'video' => array('Video', 'vdo002', 'pdm001'),
    );
    static $attribute_transform = array(
        'pdm001' => 'id',
        'pdm002' => 'no',
        'pdm003' => 'type',
        'pdm004' => 'name',
        'pdm005' => 'price',
        'pdm006' => 'member_price',
        'pdm007' => 'selling',
        'pdm008' => 'video',
        'pdm009' => 'how_use',
        'pdm010' => 'capacity',
        'pdm011' => 'editor',
        'pdm012' => 'time',
        'pdm013' => 'main',
        'pdm014' => 'sort',
        'pdm015' => 'introduce',
        'pdm016' => 'element',
        'pdm017' => 'suit',
        'pdm018' => 'remark',
        'pdm019' => 'sell_type', /* 販售類型 0.現金商品, 1.點數商品 */
    );

    static $validate_rules = array(
        array(
            'selector' => '[name=no]',
            'column' => 'pdm002',
            'rules' => array('length' => array(1, 100))
        ),
        array(
            'selector' => '[name=type]',
            'column' => 'pdm003',
            'rules' => array(
                'required' => array()
            )
        ),
        array(
            'selector' => '[name=name]',
            'column' => 'pdm004',
            'rules' => array(
                'required' => array(),
                'length' => array(1, 100)
            )
        ),
        array(
            'selector' => '[name=price]',
            'column' => 'pdm005',
            'rules' => array('integer' => array(1, 100))
        ),
        array(
            'selector' => '[name=member_price]',
            'column' => 'pdm006',
            'rules' => array('integer' => array(1, 100))
        ),

    );

    const SELL_TYPE_MONEY = 0;
    const SELL_TYPE_POINT = 1;

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';
    public function afterSave() 
    {
        LogProduct::log($this);
    }

    public static function optionsSellTypes() {
        return array(
            self::SELL_TYPE_MONEY => '現金商品',
            self::SELL_TYPE_POINT => '購物金商品'
        );
    }

    public static function getAllProduct($type_id) {
        $type_id = intval($type_id) ?: 0;
        $options = array(
            'select' => implode(',', array(
                'pdm001 AS id',
                'pdm004 AS name',
            )),
            'conditions' => array(
                'pdm003 = ?',
                $type_id
            ),
            'order' => 'pdm014 DESC, pdm004',
        );

        $rows = array();
        $result = static::find('all', $options) ?: array();
        foreach ($result as $row) {
            $rows[$row->id] = $row->name;
        }
        return $rows;
    }

    public static function getPItem($type_id) {
        $typeid = intval($type_id) ?: 0;
        $sql = 'SELECT pdi001 AS sn, '
            . '     pdi002 AS type_name '
            . ' FROM product_item '
            . " WHERE pdi001 = {$typeid} "
            . ' order by pdi001';  
        // echo $sql;
        $rows = array();
        $result = static::find_by_sql($sql) ?: array();
        // return $result;

        // echo "<pre>"; print_r($result); echo "</pre>";
        foreach ($result as $row) {
            $tmp = $row->attributes();
            $rows = $row->type_name;
        }

        return $rows;
    }

    public static function getProduct($pid) {
        $options = array(
            'conditions' => "pdm007 = 1",
            'select' => implode(',', array(
                'pdm001 AS id',
                'pdm002 AS no',
                'pdm005 AS price',
                'pdm006 AS member_price',
                'pdm007 AS status',
            ))
        );

        $result = static::find('all', $options) ?: array();
        $rows = array();
        
        foreach ($result as $row) {
            $tmp = $row->attributes();
            $rows[] = $tmp;
        }
        
        return $rows;
    } 
  
}

