<?php
namespace model;
use ActiveRecord\Model;
use Lang;

class OrderCache extends Order
{
    // explicit table name since our table is not "books"
    static $table_name = 'order_cache';

    // explicit pk since our pk is not "id"
    static $primary_key = 'odm001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

}

