<?php
namespace libraries;
class Lang {
    protected static $lang;
    protected static $lang_map;

    public static function setLang($lang) 
    {
        static::$lang = $lang;
        static::$lang_map = array();
        foreach ($lang as $key => $array) {
            static::setLangMap($key, $array);
        }
    }

    protected static function setLangMap($map_key, $lang_array) 
    {
        if (is_array($lang_array)) {
            foreach ($lang_array as $key => $value) {
                static::setLangMap("{$map_key}.{$key}", $value);
            }
        } else {
            static::$lang_map[$map_key] = $lang_array;
        }
    }

    public static function get($key = null) 
    {
        return $key === null 
            ? static::$lang
            : (isset(static::$lang_map[$key]) ? static::$lang_map[$key] : $key);
    }
}