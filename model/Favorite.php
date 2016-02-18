<?php
namespace model;
use ActiveRecord\Model;
use User;
use Input;
use Image;
use QRcode;
class Agent extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'favorite';

    // explicit pk since our pk is not "id"
    static $primary_key = 'fav001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'fav001' => 'fid',
        'fav002' => 'mid',
        'fav003' => 'pid',
    );

}

