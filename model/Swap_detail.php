<?php
namespace model;
use ActiveRecord\Model;

class SwapDetail extends Model
{
    // explicit table name since our table is not "books"
    static $table_name = 'order_swap_detail';

    // explicit pk since our pk is not "id"
    static $primary_key = 'osd001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $per_page = 10;
    // static $Types = array('', '處理中', '已取貨', '已出貨', '核帳');
    static $Types = array('處理中', '核帳');

    public static function getallOrders() {

        // $sql  = "SELECT * FROM order_manager WHERE age016 = :lv";
        // $data = array(':lv' => $lv);
        
        // return static::find_by_sql($sql,$data);
        return static::all();
    }
    
    public static function getType($value) {
        return static::$Types[$value];
    }
    
    public static function getPage($page) {
        $per_page = static::$per_page;
        $start = $per_page * ((intval($page) ?: 1) - 1);
        $sql = 'SELECT odr001 AS sn, '
            . '     odr002 AS oid, '
            . '     odr003 AS mid, '
            . '     odr004 AS aid, '
            . '     odr005 AS address, '
            . '     odr006 AS reason, '
            . '     odr007 AS keyman1, '
            . '     odr008 AS keyman2, '
            . '     odr009 AS status, '
            . '     odr010 AS dateRecord '
            . ' FROM order_reject '
            . " LIMIT {$start}, {$per_page}";
        return static::find_by_sql($sql);
    }

    public static function fixedMoney() {
        return round($this->money, 4);
    }

    public static function getProduct($oid) {
        $sql = 'SELECT ord001 AS sn, '
            . '     ord002 AS oid, '
            . '     ord003 AS pid, '
            . '     ord004 AS productName, '
            . '     ord005 AS pmoney '
            . ' FROM order_reject_detail '
            . " WHERE ord002 = {$oid}";
        return static::find_by_sql($sql);
    }

    public static function getOrder($oid) {
        $sql = 'SELECT odm001 AS sn, '
            . '     odm002 AS oid, '
            . '     odm003 AS money, '
            . '     odm004 AS date1, '
            . '     odm005 AS date2, '
            . '     odm006 AS date3, '
            . '     odm007 AS shoppinggold, '
            . '     odm008 AS cash, '
            . '     odm009 AS creditcard, '
            . '     odm010 AS shoppay, '
            . '     odm011 AS agent01id, '
            . '     odm012 AS agent02id, '
            . '     odm013 AS getsn, '
            . '     odm014 AS agent03id, '
            . '     odm015 AS ordername, '
            . '     odm016 AS mid, '
            . '     odm017 AS address, '
            . '     odm018 AS methods, '
            . '     odm019 AS status '
            . ' FROM order_manager '
            . " WHERE odm002 = {$oid}";
        return static::find_by_odm002($oid) ?: new Order;
        return static::find_by_sql($sql);
    }

    public static function getOrderDetail($oid) {
        $sql = 'SELECT odd001 AS sn, '
            . '     odd002 AS ooid, '
            . '     odd003 AS pid, '
            . '     odd004 AS pmoney, '
            . '     odd005 AS shoppinggold, '
            . '     odd006 AS point, '
            . '     odd007 AS amount '
            . ' FROM order_detail '
            . " WHERE odd002 = {$oid}";
        return static::find_by_sql($sql);
    }

    public static function getOrderForReject($oid) {
        $sql = 'SELECT odr002 AS ooid '
            . ' FROM order_reject '
            . " WHERE odr002 = {$oid}";
        return static::find_by_odr002($oid);
    }

    public static function getSwapDetail($oid) {
        $sql = 'SELECT osd001 AS sn, '
            . '     osd002 AS oid, '
            . '     osd003 AS pid, '
            . '     osd004 AS productName, '
            . '     osd005 AS pmoney, '
            . '     osd006 AS amount '
            . ' FROM order_swap_detail '
            . " WHERE osd002 = {$oid}";
        return static::find_by_sql($sql);
    }

}

