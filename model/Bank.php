<?php
namespace model;
use ActiveRecord\Model;

class Bank extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'bank';

    // explicit pk since our pk is not "id"
    static $primary_key = 'ban001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'ban001' => 'code',
        'ban002' => 'name',
    );

    public static function options() {
        $result = static::all();
        $rows = array();
        foreach ($result as $row) {
            $rows[$row->ban001] = "{$row->ban001} - {$row->ban002}";
        }
        return $rows;
    }

}

