<?php
namespace model;
use ActiveRecord\Model;

class Bonus extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'bonus';

    // explicit pk since our pk is not "id"
    static $primary_key = 'bon001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'bon001' => 'id',
        'bon002' => 'oid',
        'bon003' => 'aid',
        'bon004' => 'verification',
        'bon005' => 'operate',
    );

}