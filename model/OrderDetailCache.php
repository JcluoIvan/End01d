<?php
namespace model;
use ActiveRecord\Model;
use Lang;

class OrderDetailCache extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'order_detail_cache';

    // explicit pk since our pk is not "id"
    static $primary_key = 'odd001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

}

