<?php
namespace model;
use ActiveRecord\Model;
use Image;

class ProductPhoto extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'product_photo';

    // explicit pk since our pk is not "id"
    static $primary_key = 'pdo001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'pdo001' => 'sn',
        'pdo002' => 'pid',
        'pdo003' => 'url',
        'pdo004' => 'type',
        'pdo005' => 'date',
    );


    public function afterDelete() {
        $this->removeImage();
    }

    public function path() {
        return $this->pdo003 ? Image::productPath($this->pdo003) : '';
    }
    public function url() {
        return $this->pdo003 ? Image::productUrl($this->pdo003) : '';
    }

    public function removeImage() {
        @unlink($this->getMinImagePath());
        @unlink($this->path());
    }

    public function getMinImagePath() 
    {
        $path = explode('.', $this->pdo003);
        if (count($path) < 2) return false;
        $sub = array_pop($path);
        $path[] = 'min';
        $path[] = $sub;
        return Image::productPath(implode('.', $path));
    }
    public function getMinImageUrl()
    {
        $path = explode('.', $this->pdo003);
        if (count($path) < 2) return false;
        $sub = array_pop($path);
        $path[] = 'min';
        $path[] = $sub;
        return Image::productUrl(implode('.', $path));

    }
    
    public function createMinImage() 
    {
        $path = Image::productPath($this->pdo003);
        if (file_exists($path)) {
            Image::resize($path, static::getMinImagePath());
        } else {
            throw new \Exception($path);
        }

    }

    public static function getAllPhotoByProductId($id) {

        $sql = "SELECT * FROM product_photo WHERE pdo002 = :id";

        $data = array(":id" => $id);

        return static::find_by_sql($sql, $data);
    }

    public static function getList($page, $rp) 
    {
    }
}

