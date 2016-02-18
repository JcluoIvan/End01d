<?php
namespace model;
use ActiveRecord\Model;
use Image;

class Receipt extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'receipt';

    // explicit pk since our pk is not "id"
    static $primary_key = 'rec001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $per_page = 10;
    // static $Types = array('', '處理中', '已取貨', '已出貨', '核帳');
    // static $Types = array('處理中', '核帳');
    static $attribute_transform = array(
        'rec001' => 'sn',
        'rec002' => 'oid',
        'rec003' => 'photo',
        'rec004' => 'date'
    );

    // static $has_to = array(
    //     'product' => array('Product', 'pdm001', 'odr006', 'single'),
    //     'order'   => array('Order', 'odm001', 'odr002', 'single'),
    //     'ar' => array('Agent', 'age001', 'odr005', 'single'),
    //     'member' => array('Member', 'mem001', 'odr004', 'single')
    // );

    public function afterSave() 
    {
        // LogOrder::log($this);
    }

    public function afterDelete() {
        $min = $this->getMinImagePath();
        $path = $this->getImagePath();
        @unlink($min);
        @unlink($path);
    } 

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
        $sql = 'SELECT rec001 AS sn, '
            . '     rec002 AS oid, '
            . '     rec003 AS photo, '
            . '     rec004 AS date, '
            . ' FROM receipt '
            . " LIMIT {$start}, {$per_page}";
        return static::find_by_sql($sql);
    }

    public function getImagePath() {
        return Image::receiptPath($this->rec003);
    }

    public function getMinImagePath() 
    {
        $path = explode('.', $this->rec003);
        if (count($path) < 2) return false;
        $sub = array_pop($path);
        $path[] = 'min';
        $path[] = $sub;
        return Image::receiptPath(implode('.', $path));
    }

    public function getMinImageUrl()
    {
        $path = explode('.', $this->rec003);
        if (count($path) < 2) return false;
        $sub = array_pop($path);
        $path[] = 'min';
        $path[] = $sub;
        return Image::receiptUrl(implode('.', $path));

    }
    public function getImageUrl() 
    {
        return Image::receiptUrl($this->rec003);
    }

    public function createMinImage() 
    {
        $path = Image::receiptPath($this->rec003);
        if (file_exists($path)) {
            Image::resize($path, static::getMinImagePath());
        } else {
            throw new \Exception($path);
        }

    }

    public static function getAllPhotoByOrderId($id) {

        $sql = "SELECT * FROM receipt WHERE rec002 = :id";

        $data = array(":id" => $id);

        return static::find_by_sql($sql, $data);
    }

}

