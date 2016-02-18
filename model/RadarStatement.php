<?php
namespace model;
use ActiveRecord\Model;
use User;
use Input;
use Image;
use QRcode;
use Lang;
class RadarStatement extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'radar_statement';

    // explicit pk since our pk is not "id"
    static $primary_key = 'rat001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';
    static $has_to = array(
        // 'agent' => array('Agent', 'age018', 'age001'),
        // 'order' => array('Order', 'odm022', 'age001'),
    );
    static $attribute_transform = array(
        'rat001' => 'id',
        'rat002' => 'no',
        'rat003' => 'radarmoney',
        'rat004' => 'dateCheck',
        'rat005' => 'user',
    );

}

