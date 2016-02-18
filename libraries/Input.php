<?php
namespace libraries;
class Input {
    public static function post($key = null, $default = null) 
    {
        return $key === null
            ? $_POST
            : (isset($_POST[$key]) ? $_POST[$key] : $default);
    }
    public static function get($key = null, $default = null) 
    {
        return $key === null
            ? $_GET
            : (isset($_GET[$key]) ? $_GET[$key] : $default);
    }

    public static function isAjax() 
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function domain() 
    {
        return 'http://www.win8899.net';
    }
}