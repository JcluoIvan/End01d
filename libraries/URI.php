<?php
namespace libraries;
class URI {
    public static function segment($n = null) 
    {
        $uri = $_SERVER['PHP_SELF'] ?: $_SERVER['SCRIPT_NAME'];
        $uri = explode('/', $uri);
        if ($uri[0] == '') array_shift($uri);
        return $n === null
            ? $uri
            : (isset($uri[$n]) ? $uri[$n] : null);
    }
    public static function segmentString() {
        return implode('/', static::segment());
    }

    public static function path($path = '') {
        return ROOT_PATH . $path;
    }

    // public static function asset($url = '') {
    //     return domain . url;
    // }
}

