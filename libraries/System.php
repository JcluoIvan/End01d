<?php
namespace libraries;
use model\LogError;
class System {
    protected static $config = array();

    public static function setConfig($conf) 
    {
        static::$config = $conf;
    }
    public static function get($key) 
    {
        return isset(static::$config[$key])
            ? static::$config[$key]
            : null;
    }

}