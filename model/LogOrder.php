<?php
namespace model;
use ActiveRecord\Model;
use User;

class LogOrder extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'log_order';

    // explicit pk since our pk is not "id"
    static $primary_key = 'lod001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'order' => array('Order', 'odm001', 'lod003', 'single'),
        'editor' => array('Agent', 'age001', 'lod002', 'single'),
    );

    static $attribute_transform = array(
        'lod001' => 'id',
        'lod002' => 'editor',
        'lod003' => 'oid',
        'lod004' => 'pid',
        'lod005' => 'type',
        'lod006' => 'action',
        'lod007' => 'content',
        'lod008' => 'ip',
        'lod009' => 'datetime',
    );

    static $order_names = array(
        'odm002' => '訂單編號',
        'odm003' => '總金額',
        'odm004' => '使用購物金',
        'odm005' => '核帳日期',
        'odm006' => '交易日期',
        'odm007' => '取貨日期',
        'odm008' => '收款日期',
        'odm009' => '付款方式',
        'odm010' => '取貨方式',
        'odm011' => '取貨序號',
        'odm012' => '取貨店(展示中心)',
        'odm013' => '下單會員',
        'odm014' => '訂貨人姓名',
        'odm015' => '訂貨人電話',
        'odm016' => '訂貨人鄉鎮市區',
        'odm017' => '送貨地址',
        'odm018' => '發票類型',
        'odm019' => '統一編號',
        'odm020' => '發票抬頭',
        'odm021' => '專業經理人',
        'odm022' => '展示中心',
        'odm023' => '會員上層 3',
        'odm024' => '會員上層 2',
        'odm025' => '會員上層 1',
        'odm026' => '專業經理人回饋 %',
        'odm027' => '展示中心回饋 %',
        'odm028' => '會員回饋 %',
        'odm029' => '運費',
        'odm030' => '實收款',
        'odm031' => '購物金入帳日期',
        'odm032' => '退貨總金額',
        'odm033' => '退貨總點數'
    );
    static $detail_names = array(
        'odd002' => '訂單編號',
        'odd003' => '商品名稱',
        'odd004' => '商品單價',
        'odd006' => '購買數量',
    );
    static $reject_names = array(
        'odr002' => '訂單編號',
        'odr003' => '退貨單編號',
        // 'odr004' => '會員',
        // 'odr005' => '展示中心',
        'odr006' => '產品',
        'odr007' => '產品金額',
        'odr008' => '退貨數量',
        'odr009' => '退貨原因',
        'odr010' => '退貨地址',
        'odr012' => '退貨日期',
        'odr013' => '狀態',
        'odr014' => '退貨總金額',
        'odr015' => '退貨總點數'
    );
    static $swap_names = array(
        'ods002' => '訂單編號',
        'ods003' => '換貨單編號',
        // 'ods004' => '會員',
        // 'ods005' => '展示中心',
        'ods006' => '產品',
        'ods007' => '產品金額',
        'ods008' => '換貨數量',
        'ods009' => '換貨原因',
        'ods010' => '換貨地址',
        'ods012' => '換貨日期',
        'ods013' => '狀態'
    );

    const TYPE_ORDER = 'order';
    const TYPE_DETAIL = 'detail';
    const TYPE_REJECT = 'reject';
    const TYPE_SWAP = 'swap';
    static $types = array(
        self::TYPE_ORDER => '訂單',
        self::TYPE_DETAIL => '明細',
        self::TYPE_REJECT => '退貨單',
        self::TYPE_SWAP => '換貨單',
    );

    /* 各類型的 pk id 欄位名稱 */
    static $id_column = array(
        self::TYPE_ORDER => 'odm001',
        self::TYPE_DETAIL => 'odd001',
        self::TYPE_REJECT => 'odr001',
        self::TYPE_SWAP => 'ods001',
    );

    /* 各類型的 訂單編號名稱 */
    static $pid_column = array(
        self::TYPE_ORDER => 'odm001',
        self::TYPE_DETAIL => 'odd002',
        self::TYPE_REJECT => 'odr002',
        self::TYPE_SWAP => 'ods002',
    );

    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';

    static $actions = array(
        self::ACTION_ADD => '新增',
        self::ACTION_EDIT => '修改',
    );

    private static function names($type) {
        switch ($type) {
            case self::TYPE_ORDER:
                return static::$order_names;
            case self::TYPE_DETAIL:
                return static::$detail_names;
            case self::TYPE_REJECT:
                return static::$reject_names;
            case self::TYPE_SWAP:
                return static::$swap_names;
        }
    }

    static function type($row) {
        if ($row instanceof Order) {
            return self::TYPE_ORDER;
        } elseif ($row instanceof OrderDetail) {
            return self::TYPE_DETAIL;
        } elseif ($row instanceof Reject) {
            return self::TYPE_REJECT;
        } elseif ($row instanceof Swap) {
            return self::TYPE_SWAP;
        } else {
            return get_class($row);
        }
    }

    static function log($row, $action = null) {
        return true;
        $type = static::type($row);

        $names = static::names($type);
        $update = $row->getUpdateAttribute();

        if (count($update) == 0) return true;
        
        $id = static::$id_column[$type];

        /**
         *  特殊, 下訂單時會先產生 no, 
         *  所以無法確認 order 是新增還修改, 改由傳入值確認
         */
        $action = $action ?: (
            in_array($id, array_keys($update)) ? self::ACTION_ADD : self::ACTION_EDIT
        );


        $old = array();
        $new = array();
        foreach ($update as $column => $value) {
            
            if (! isset($names[$column])) continue;

            $old[$column] = ($value instanceof \ActiveRecord\DateTime)
                ? $value->format('Y/m/d H:i:s')
                : $value;

            $new[$column] = ($row->$column instanceof \ActiveRecord\DateTime)
                ? $row->$column->format('Y/m/d H:i:s')
                : $row->$column;

        }

        if (count($new) == 0) return;
        $pid = static::$pid_column[$type];
        $log = new LogOrder;
        $log->lod002 = User::get('id') ?: 0;
        $log->lod003 = $row->$pid;
        $log->lod004 = $row->$id;
        $log->lod005 = $type;
        $log->lod006 = $action;
        $log->lod007 = json_encode(array('old' => $old, 'new' => $new));
        $log->lod008 = User::ip();
        $log->save();


    }


    public function action() 
    {
        return static::$actions[$this->lod006];
    }

    public function type_name() {
        return static::$types[$this->lod005];
    }

    public function content() 
    {
        try {
            $json = json_decode($this->lod007, true);
        } catch (\Exception $e) {
            return array( 
                'name' => '資訊錯誤',
                'old' => $this->lpd007,
                'new' => ''
            );
        }
        // $log = static::with(
        //     $this, 
        //     array('order', 'order.member', 'order.ar')
        // );

        $names = static::names($this->lod005);
        $rows = array();

        if ($this->lod005 == self::TYPE_ORDER) {
            $old = $json['old'];
            $new = $json['new'];

            /* 會員 */
            isset($old['odm013']) && 
                ($row = Member::find_by_mem001($old['odm013'])) &&
                ($json['old']['odm013'] = $row->mem005);
            isset($new['odm013']) && 
                ($row = Member::find_by_mem001($new['odm013'])) &&
                ($json['new']['odm013'] = $row->mem005);
            /* 專業經理人 */
            isset($old['odm021']) && 
                ($row = Agent::find_by_age001($old['odm021'])) &&
                ($json['old']['odm021'] = $row->age006);
            isset($new['odm021']) && 
                ($row = Agent::find_by_age001($new['odm021'])) &&
                ($json['new']['odm021'] = $row->age006);
            /* 展示中心 */
            isset($old['odm022']) && 
                ($row = Agent::find_by_age001($old['odm022'])) &&
                ($json['old']['odm022'] = $row->age006);
            isset($new['odm022']) && 
                ($row = Agent::find_by_age001($new['odm022'])) &&
                ($json['new']['odm022'] = $row->age006);

        }


        foreach ($json['old'] as $column => $old) {

            if (! isset($names[$column])) continue;
            $new = $json['new'][$column];
            switch ($column) {

                case 'odm021':
                    ($old && ($row = Member::find_by_mem001($old))) &&
                        ($old = $row->mem005);
                    ($new && ($row = Member::find_by_mem001($new))) &&
                        ($new = $row->mem005);
                    break;
                case 'odm022':
                    ($old && ($row = Member::find_by_mem001($old))) &&
                        ($old = $row->mem005);
                    ($new && ($row = Member::find_by_mem001($new))) &&
                        ($new = $row->mem005);
                    break;
                case 'odm013': 
                    ($old && ($row = Member::find_by_mem001($old))) &&
                        ($old = $row->mem005);
                    ($new && ($row = Member::find_by_mem001($new))) &&
                        ($new = $row->mem005);
                    break;
                case 'odd002': 
                    ($old && ($old = Order::find_by_odm001($old))) &&
                        ($old = $old->odm002);
                    ($new && ($new = Order::find_by_odm001($new))) &&
                        ($new = $new->odm002);
                    break;
                case 'odd003': 
                    ($old && ($old = Product::find_by_pdm001($old))) &&
                        ($old = $old->pdm004);
                    ($new && ($new = Product::find_by_pdm001($new))) &&
                        ($new = $new->pdm004);
                    break;
            }


            $rows[] = array(
                'name' => $names[$column],
                'old' => $old,
                'new' => $new
            );

        }

        return $rows;


    }


}

