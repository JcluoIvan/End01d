<?php
namespace model;
use ActiveRecord\Model;
use User;

class LogMember extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'log_member';

    // explicit pk since our pk is not "id"
    static $primary_key = 'lmb001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'member' => array('Member', 'mem001', 'lmb003', 'single'),
        'editor' => array('Agent', 'age001', 'lmb002', 'single'),
    );

    static $attribute_transform = array(
        'lmb001' => 'id',
        'lmb002' => 'editor',
        'lmb003' => 'uid',
        'lmb004' => 'action',
        'lmb005' => 'content',
        'lmb006' => 'ip',
        'lmb007' => 'datetime',
    );

    static $validate_rules = array(
    );

    static $member_names = array(
        'mem002' => '編號',
        // 'mem003' => '帳號',
        'mem004' => '密碼',
        'mem005' => '姓名',
        'mem007' => '生日',
        'mem008' => '縣市',
        'mem009' => '地址',
        'mem010' => '銀行帳戶',
        'mem011' => '手機',
        'mem012' => 'Email',
        'mem014' => '除帳',
        'mem015' => '回饋 %',
        'mem021' => '購物金',
        'mem023' => '黑名單狀態',
        'mem025' => '黑名單原因',
    );

    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';

    static $actions = array(
        self::ACTION_ADD => '新增',
        self::ACTION_EDIT => '修改',
    );


    static function log(Member $member) 
    {
        return true;
        $update = $member->getUpdateAttribute();
        if (count($update) == 0) return true;

        $action = in_array('mem001', array_keys($update))
            ? self::ACTION_ADD : self::ACTION_EDIT;

        $old = array();
        $new = array();
        foreach ($update as $column => $value) {

            if (! isset(static::$member_names[$column])) continue;
            
            $old[$column] = ($value instanceof \ActiveRecord\DateTime)
                ? $value->format('Y/m/d H:i:s')
                : $value;

            $new[$column] = ($member->$column instanceof \ActiveRecord\DateTime)
                ? $member->$column->format('Y/m/d H:i:s')
                : $member->$column;

        }
        if (count($new) == 0) return;

        $log = new LogMember;
        $log->lmb002 = User::get('id') ?: 0;
        $log->lmb003 = $member->mem001;
        $log->lmb004 = $action;
        $log->lmb005 = json_encode(array('old' => $old, 'new' => $new));
        $log->lmb006 = User::ip();
        $log->save();

    }

    public function action() 
    {
        return static::$actions[$this->lmb004];
    }

    public function content() 
    {
        $json = null;
        try {
            $json = json_decode($this->lmb005, true);
        } catch (\Exception $e) {
            return array( 
                'title' => '資訊錯誤',
                'old' => $this->lmb005,
                'new' => ''
            );
        }
        $rows = array();
        foreach ($json['old'] as $column => $old) {

            if (! isset(static::$member_names[$column])) continue;
            $new = $json['new'][$column];

            $rows[] = array(
                'name' => static::$member_names[$column],
                'old' => $old,
                'new' => $new
            );

        }

        return $rows;


    }


}

