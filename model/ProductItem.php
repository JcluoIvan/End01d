<?php
namespace model;
use ActiveRecord\Model;
use Lang;

class ProductItem extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'product_item';

    // explicit pk since our pk is not "id"
    static $primary_key = 'pdi001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'product' => array('Product', 'pdm003', 'pdi001')
    );

    static $attribute_transform = array(
        'pdi001' => 'id',
        'pdi002' => 'name',
        'pdi003' => 'sort',
        'pdi004' => 'disabled',
    );

    static $validate_rules = array(
        array(
            'selector' => '[name=name]',
            'column' => 'pdi002',
            'rules' => array(
                'required' => array(),
                'length' => array(1, 30) 
            )
        ),
    );


    public static function getList($page, $rp) 
    {
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array(
            'offset' => ($page - 1) * $rp,
            'limit' => $rp,
            'order' => 'pdi003',
        );
        return static::find('all', $options);
    }
    public static function getItemArray($all = false)
    {
        $options = array(
            'conditions' => 'pdi004 = 0',
            'order' => 'pdi003',
        );

        /* 若 all 為 true, 則把 disabled 的資料也查出來 */
        if ($all) {
            unset($options['conditions']);
        }
        
        $result = static::find('all', $options) ?: array();
        $list = array();
        foreach ($result as $row) {
            $list[$row->pdi001] = $row->pdi002;
        }
        return $list;
    }
}

