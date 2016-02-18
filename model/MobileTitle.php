<?php
namespace model;
use ActiveRecord\Model;
use Image;
class MobileTitle extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'mobile_title';

    // explicit pk since our pk is not "id"
    static $primary_key = 'mbt001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'mbt001' => 'id',
        'mbt002' => 'name',
        'mbt003' => 'enabled',
        'mbt004' => 'sort',
        'mbt005' => 'updated_at',
    );

    public function url() {
        return Image::mobileTitleUrl($this->mbt002);
    }

    public function path() {
        return Image::mobileTitlePath($this->mbt002);
    }

    public function afterDelete() {
        @unlink($this->path());
    }

    public function activeClass() {
        return empty($this->mbt003) ? '' : 'active';
    }

}

