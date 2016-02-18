<?php
namespace model;
use ActiveRecord\Model;
use ActiveRecord\Connection;

class MemberLogin extends Model
{
    // explicit table name since our table is not "books"
    static $table_name = 'member_login';

    // explicit pk since our pk is not "id"
    static $primary_key = 'mel001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    public static function saveLog($uid, $sid, $ip) 
    {


        $table = static::$table_name;
        $sql = "INSERT INTO {$table} "
            . "     (mel001, mel003, mel004, mel006) "
            . '     VALUES (:uid, :sid, NOW(), :ip) '
            . ' ON DUPLICATE KEY UPDATE '
            . "     mel003 = VALUES(mel003), "
            . "     mel005 = mel004, "
            . "     mel004 = NOW(), "
            . "     mel006 = VALUES(mel006) ";
        $data = array(':uid' => $uid, ':sid' => $sid, ':ip' => $ip);
        return static::connection()->query($sql, $data);
    }


}

