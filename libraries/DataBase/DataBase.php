<?php
namespace libraries\DataBase;

use PDO AS PDO;
class DataBase extends DataBaseConnection {
    
    // public static function query($sql, $values = null)
    // {
    //     $query = static::db()->prepare($sql);
    //     return $query;
    //     // $query->execute($values);
    //     // return $query;
    // }
    public static function __callStatic($method, $args = null) 
    {
        return call_user_func_array(array(static::db(), $method), $args);
    }

}
