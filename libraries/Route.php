<?php
namespace libraries;
class Route {

    const AUTH_S = 'S';
    const AUTH_A = 'A';
    const AUTH_P = 'P';
    const AUTH_C = 'C';
    const AUTH_L = 'L';
    const AUTH_R = 'R';

    const TYPE_JSON = 'json';
    const TYPE_HTML = 'html';

    protected static $filters = array();
    protected static $requestType = '';

    static function match($url, $callback) {
        static::$filters[$url] = $callback;
    }

    static function requestBy($type) {
        static::$requestType = $type;
    }
    static function requestByHtml() {
        static::$requestType = 'html';
    }
    static function requestByJson() {
        static::$requestType = 'json';
    }
    static function requestType() {
        return static::$requestType;
    }

    static function execute() {

        $url = URI::segmentString();
        $result = true;
        foreach (static::$filters as $u => $cb) {

            (strpos($url, $u) !== false) && ($result = $cb());

            if ($result === true) continue;

            return false;
        }

        return true;

    }










}