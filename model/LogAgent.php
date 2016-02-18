<?php
namespace model;
use ActiveRecord\Model;
use User;

class LogAgent extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'log_agent';

    // explicit pk since our pk is not "id"
    static $primary_key = 'lag001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'agent' => array('Agent', 'age001', 'lag003', 'single'),
        'editor' => array('Agent', 'age001', 'lag002', 'single'),
    );

    static $attribute_transform = array(
        'lag001' => 'id',
        'lag002' => 'editor',
        'lag003' => 'uid',
        'lag004' => 'action',
        'lag005' => 'content',
        'lag006' => 'ip',
        'lag007' => 'datetime',
    );


    static $agent_names = array(
        'age002' => '權限',
        'age003' => '編號',
        'age004' => '帳號',
        'age005' => '密碼',
        'age006' => '姓名',
        'age008' => '生日',
        'age009' => '縣市',
        'age010' => '地址',
        'age011' => '銀行帳戶',
        'age012' => '手機',
        'age013' => 'Email',
        'age014' => '店家名稱',
        'age017' => '回饋 %',
        'age018' => '上層'
    );

    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';

    static $actions = array(
        self::ACTION_ADD => '新增',
        self::ACTION_EDIT => '修改',
    );


    static function log(Agent $agent) 
    {
        return true;
        $update = $agent->getUpdateAttribute();

        if (count($update) == 0) return true;

        $action = in_array('age001', array_keys($update))
            ? self::ACTION_ADD : self::ACTION_EDIT;

        $old = array();
        $new = array();
        foreach ($update as $column => $value) {

            if (! isset(static::$agent_names[$column])) continue;
            
            $old[$column] = ($value instanceof \ActiveRecord\DateTime)
                ? $value->format('Y/m/d H:i:s')
                : $value;

            $new[$column] = ($agent->$column instanceof \ActiveRecord\DateTime)
                ? $agent->$column->format('Y/m/d H:i:s')
                : $agent->$column;

        }
        if (count($new) == 0) return;

        $log = new LogAgent;
        $log->lag002 = User::get('id');
        $log->lag003 = $agent->age001;
        $log->lag004 = $action;
        $log->lag005 = json_encode(array('old' => $old, 'new' => $new));
        $log->lag006 = User::ip();
        $log->save();

    }

    public function action() 
    {
        return static::$actions[$this->lag004];
    }

    public function content() 
    {
        $json = null;
        try {
            $json = json_decode($this->lag005, true);
        } catch (\Exception $e) {
            return array( 
                'title' => '資訊錯誤',
                'old' => $this->lag005,
                'new' => ''
            );
        }

        if (isset($json['old']['age009'])) {
            $city = Post::row($json['old']['age009']);
            $country = $city ? Post::row($city->pos002) : null;
            $json['old']['age009'] = 
                ($country ? "({$country->pos004}) " : '(unknown) ') .
                ($city ? $city->pos004 : 'unknown');
        }
        if (isset($json['new']['age009'])) {
            $city = Post::row($json['new']['age009']);
            $country = $city ? Post::row($city->pos002) : null;
            $json['new']['age009'] = 
                ($country ? "({$country->pos004}) " : '(unknown) ') .
                ($city ? $city->pos004 : 'unknown');
        }

        $rows = array();
        foreach ($json['old'] as $column => $old) {

            if (! isset(static::$agent_names[$column])) continue;

            $rows[] = array(
                'name' => static::$agent_names[$column],
                'old' => $old,
                'new' => $json['new'][$column]
            );

        }

        return $rows;


    }


}

