<?php
namespace model;
use Image;
use ActiveRecord\Model;

class News extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'news';

    // explicit pk since our pk is not "id"
    static $primary_key = 'new001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'new001' => 'id',
        'new002' => 'type',
        'new003' => 'title',
        'new004' => 'content',
        'new005' => 'notice_for',
        'new006' => 'users',
        'new007' => 'time',
        'new008' => 'image',
    );

    static $validate_rules = array(
        // 'new002' => array(
        //     'selector' => '',
        //     'rule' => array('in' => array('app', 'sms')
        // ),
        array(
            'selector' => '[name=title]',
            'column' => 'new003',
            'rules' => array('title' => array(1, 100))
        ),
        array(
            'selector' => '[name=content]',
            'column' => 'new004',
            'rules' => array('content' => array(1, 100))
        ),
    );


    static $type_names = array('app' => 'App 通知', 'sms' => '簡訊通知');

    static $notice_for = array(
        'none' =>  '不通知',
        'all' =>  '全體會員',
        'agent-l' =>  '專業經理人會員群組',
        'agent-r' =>  '展示中心會員群組',
        'member' =>  '自訂通知會員',
    );


    public function typeName() 
    {
        return static::$type_names[$this->new002];
    }
    public function noticeFor() 
    {
        return static::$notice_for[$this->new005];
    }

    public function path() {
        return ! empty($this->new008) ? Image::newsPath($this->new008) : '';
    }

    public function url() {
        return ! empty($this->new008) ? Image::newsUrl($this->new008) : '';
    }

    public function removeImage() {
        $path = $this->path();
        file_exists($path) && @unlink($path);
        $this->new008 = null;
        return $this;
    }

    public function validateTitle($value) 
    {
        return $this->new002 == 'sms'
            ? true
            : $this->validateLength($value, 1, 100);

    }

    public function validateContent($value) 
    {
        return $this->new002 == 'app'
            ? true
            : $this->validateLength($value, 1, 255);
    }
}

