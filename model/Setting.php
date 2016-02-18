<?php
namespace model;
use ActiveRecord\Model;

class Setting extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'setting';

    // explicit pk since our pk is not "id"
    static $primary_key = 'set001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
    );

    static $attribute_transform = array(
        'set001' => 'id',
        'set002' => 'key',
        'set003' => 'caption',
        'set004' => 'value',
        'set005' => 'default',
        'set006' => 'sort',
    );

    static function value($key, $default = null) {
        $row = static::find_by_set002($key);
        return $row ? $row->set004 : $default;
    }

    // static function carRows() {
    //     return static::find('all', array(
    //         'conditions' => array(
    //             'set002 = ?', 
    //             'car'
    //         )
    //     );
    // }
}

