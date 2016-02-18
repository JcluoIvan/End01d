<?php
namespace model;
use ActiveRecord\Model;
use Image;
class Store extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'store';

    // explicit pk since our pk is not "id"
    static $primary_key = 'sto001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    static $attribute_transform = array(
        'sto001' => 'id',           /* age001 */
        'sto002' => 'img',          /* 圖片路徑 */
        'sto003' => 'map',          /* 地圖資訊 */
        'sto004' => 'summary',      /* 簡介 */
        'sto005' => 'spending',     /* 消費 */
        'sto006' => 'course',       /* 課程 */
        'sto007' => 'updated_at',   /* 更新時間 */
        'sto008' => 'editor',       /* 編輯人員 */
    );
    static $has_to = array(
        'agent' => array('Agent', 'age001', 'sto002', 'single')
    );

    public function imageUrl() {
        return $this->sto002 ? Image::storeUrl($this->sto002) : '';
    }
    public function imagePath() {
        return $this->sto002 ? Image::storePath($this->sto002) : '';
    }
    public function afterDelete() {
        $path = $this->imagePath();
        if ($path) @unlink($path);
    }

}

