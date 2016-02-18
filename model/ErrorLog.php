<?php
namespace model;
use ActiveRecord\Model;

class LogError extends Model
{
    // explicit table name since our table is not "books"
    static $table_name = 'system_error_log';

    // explicit pk since our pk is not "id"
    static $primary_key = 'sel001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

}

