<?php
namespace libraries\DataBase;

use libraries\DataBase\ExtendPDO\ExtPDO AS ExtPDO;
Class DataBaseConnection {
    protected static $dbs = array();
    protected static $db_index = null;

    public static function connection($configs)
    {
        foreach ($configs as $index => $conf) {
            $username = isset($conf['username']) ? $conf['username'] : 'root';
            $password = isset($conf['password']) ? $conf['password'] : '';
            $dbname = isset($conf['dbname']) ? $conf['dbname'] : '';
            $host = isset($conf['host']) ? $conf['host'] : '127.0.0.1';
            $charset = isset($conf['charset']) ? $conf['charset'] : 'utf8';

            $dsn = "mysql:dbname={$dbname};host={$host};charset={$charset}";
            static::$dbs[$index] = new ExtPDO($dsn, $conf['username'], $conf['password']);
        }
    }

    public static function changeConnect($index)
    {
        if (! isset(static::$dbs[$index])) {
            throw new Exception("No this setting \"{$index}\".");
        }
        static::$db_index = $index;
    }

    protected static function db()
    {
        return static::$dbs[static::$db_index];
    }
}
