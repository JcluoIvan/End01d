<?php
namespace model;
use ActiveRecord\Model;
use User;

class LogPurchase extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'log_purchase';

    // explicit pk since our pk is not "id"
    static $primary_key = 'lpc001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'product' => array('Product', 'pdm001', 'lpc005', 'single'),
        'purchase' => array('ProductPurchase', 'pdp001', 'lpc003', 'single'),
        'agent' => array('Agent', 'age001', 'lpc004', 'single'),
        'editor' => array('Agent', 'age001', 'lpc002', 'single'),
    );

    static $attribute_transform = array(
        'lpc001' => 'id',
        'lpc002' => 'editor',
        'lpc003' => 'mid',
        'lpc004' => 'aid',
        'lpc005' => 'pid',
        'lpc006' => 'fid',
        'lpc007' => 'type',
        'lpc008' => 'action',
        'lpc009' => 'content',
        'lpc010' => 'ip',
        'lpc011' => 'datetime',
    );

    const TYPE_MAIN = 'main';
    const TYPE_DETAIL = 'detail';

    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';
    const ACTION_DELETE = 'delete';

    static $main_names = array(
        'pdp002' => '進貨編號',
        'pdp003' => '展示中心',
        'pdp004' => '進貨時間',
    );

    static $detail_names = array(
        'ppd002' => '進貨單號',
        'ppd003' => '展示中心',
        'ppd004' => '商品',
        'ppd005' => '數量',
    );

    static $id_column = array(
        self::TYPE_MAIN => 'pdp001',
        self::TYPE_DETAIL => 'ppd001',
    );

    static $mid_column = array(
        self::TYPE_MAIN => 'pdp001',
        self::TYPE_DETAIL => 'ppd002',
    );

    static $aid_column = array(
        self::TYPE_MAIN => 'pdp003',
        self::TYPE_DETAIL => 'ppd003',
    );

    static $actions = array(
        self::ACTION_ADD => '新增',
        self::ACTION_EDIT => '修改',
        self::ACTION_DELETE => '刪除',
    );

    static $type_names = array(
        self::TYPE_MAIN => '主表',
        self::TYPE_DETAIL => '明細',
    );

    private static function names($type) 
    {
        switch($type) {
            case self::TYPE_MAIN:
                return static::$main_names;
            case self::TYPE_DETAIL:
                return static::$detail_names;
        }
    }
    static function type($row) {
        if ($row instanceof ProductPurchase) {
            return self::TYPE_MAIN;
        } elseif ($row instanceof ProductPurchaseDetail) {
            return self::TYPE_DETAIL;
        } else {
            return get_class($row);
        }
    }

    static function value($column, $value) 
    {
        switch ($column) {
            case 'pdp004':
                return $value instanceof \ActiveRecord\DateTime
                    ? $value->format('Y/m/d H:i:s')
                    : $value;
            case 'pdp003':
            case 'ppd003':
                $agent = Agent::find_by_age001($value) ?: new Agent;
                return $agent->age006 ?: '查無資料';
            case 'ppd004':
                $product = Product::find_by_pdm001($value) ?: new Product;
                return $product->pdm004 ?: '查無資料';
            default:
                return $value;
        }
    }

    static function logDelete($row) 
    {
        return true;
        $type = static::type($row);
        $id = static::$id_column[$type];
        $names = static::names($type);
        $old = array();
        foreach ($names as $column => $name) {
            $old[$column] = static::value($column, $row->$column);
            // $old[$column] = ($row->$column instanceof \ActiveRecord\DateTime)
            //     ? $row->$column->format('Y/m/d H:i:s')
            //     : $row->$column;
            // ($row->$column) && ($old[$column] = $row->$column);
        }


        $mid = static::$mid_column[$type];
        $aid = static::$aid_column[$type];
        $pid = ($type == self::TYPE_DETAIL) ? $row->ppd004 : 0;
        $log = new LogPurchase;
        $log->lpc002 = User::get('id');
        $log->lpc003 = $row->$mid;
        $log->lpc004 = $row->$aid;
        $log->lpc005 = $pid;
        $log->lpc006 = $row->$id;
        $log->lpc007 = $type;
        $log->lpc008 = self::ACTION_DELETE;
        $log->lpc009 = json_encode(array('data' => $old));
        $log->lpc010 = User::ip();
        $log->save();

    }

    static function log($row, $action = null) 
    {
        return true;
        $type = static::type($row);

        $names = static::names($type);
        $update = $row->getUpdateAttribute();

        if (count($update) == 0) return true;

        $id = static::$id_column[$type];
        $action = $action ?: (
            in_array($id, array_keys($update)) ? self::ACTION_ADD : self::ACTION_EDIT
        );

        $old = array();
        $new = array();
        foreach ($update as $column => $value) {

            if (! isset($names[$column])) continue;

            $old[$column] = static::value($column, $value);
            $new[$column] = static::value($column, $row->$column);

        }
        if (count($new) == 0) return;

        $mid = static::$mid_column[$type];
        $aid = static::$aid_column[$type];
        $pid = ($type == self::TYPE_DETAIL) ? $row->ppd004 : 0;
        $log = new LogPurchase;
        $log->lpc002 = User::get('id');
        $log->lpc003 = $row->$mid;
        $log->lpc004 = $row->$aid;
        $log->lpc005 = $pid;
        $log->lpc006 = $row->$id;
        $log->lpc007 = $type;
        $log->lpc008 = $action;
        $log->lpc009 = json_encode(array('old' => $old, 'new' => $new));
        $log->lpc010 = User::ip();
        $log->save();

    }


    public function typeName() {
        return static::$type_names[$this->lpc007];
    }
    public function action() 
    {
        return static::$actions[$this->lpc008];
    }

    public function content() 
    {
        try {
            $json = json_decode($this->lpc009, true);
        } catch (\Exception $e) {
            return array(
                'name' => '資訊錯誤',
                'old' => $this->lpc009,
                'new' => ''
            );
        }

        $names = static::names($this->lpc007);

        foreach ($json['old'] as $column => $old) {
            
            if (! isset($names[$column])) continue;

            $new = isset($json['new']) ? $json['new'][$column] : array();

            $rows[] = array(
                'name' => $names[$column],
                'old' => $old,
                'new' => $new
            );

        }

        return $rows;

    }


}

