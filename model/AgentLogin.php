<?php
namespace model;
use ActiveRecord\Model;
use ActiveRecord\Connection;

class AgentLogin extends Model
{
    // explicit table name since our table is not "books"
    static $table_name = 'agent_login';

    // explicit pk since our pk is not "id"
    static $primary_key = 'agl001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    public static function saveLog($uid, $sid, $ip) {
        
        $table = static::$table_name;
        $sql = "INSERT INTO {$table} "
            . "     (agl001, agl003, agl004, agl006) "
            . '     VALUES (:uid, :sid, NOW(), :ip) '
            . ' ON DUPLICATE KEY UPDATE '
            . "     agl003 = VALUES(agl003), "
            . "     agl005 = agl004, "
            . "     agl004 = NOW(), "
            . "     agl006 = VALUES(agl006) ";
        $data = array(':uid' => $uid, ':sid' => $sid, ':ip' => $ip);
        return static::connection()->query($sql, $data);
    }


}

