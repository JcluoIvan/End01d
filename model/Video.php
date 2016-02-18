<?php
namespace model;
use ActiveRecord\Model;

class Video extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'video';

    // explicit pk since our pk is not "id"
    static $primary_key = 'vdo001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    static $attribute_transform = array(
        'vdo001' => 'id',       /* 流水號 */
        'vdo002' => 'pid',      /* 產品編號 */
        'vdo003' => 'title',      /* 標題 */
        'vdo004' => 'no',       /* 影片編號 */
        'vdo005' => 'date',     /* 日期 */
        'vdo006' => 'sort',    /* 排序 */
    );
    static $has_to = array(
        'product' => array('Product', 'pdm001', 'vdo002', 'single')
    );

}

