<?php
namespace model;
use ActiveRecord\Model;
use User;

class Dialogue extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'dialogue';

    // explicit pk since our pk is not "id"
    static $primary_key = 'dia001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';
    static $has_to = array(
        'customer' => array('Agent', 'age001', 'dia003', 'single'),
        'member' => array('Member', 'mem001', 'dia002', 'single'),
    );

    static $attribute_transform = array(
        'dia001' => 'id',
        'dia002' => 'mid',
        'dia003' => 'aid',
        'dia004' => 'content',
        'dia005' => 'datetime',
    );
}

