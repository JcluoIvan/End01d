<?php
namespace model;
use ActiveRecord\Model;
use Lang;

class Order extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'order_manager';

    // explicit pk since our pk is not "id"
    static $primary_key = 'odm001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    # 軟刪除
    static $soft_delete = 'odm041';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'detail' => array('OrderDetail', 'odd002', 'odm001'),
        'ar' => array('Agent', 'age001', 'odm022', 'single'),
        'al' => array('Agent', 'age001', 'odm021', 'single'),
        'agentR' => array('Agent', 'age001', 'odm022', 'single'),
        'member' => array('Member', 'mem001', 'odm013', 'single'),
        'reject' => array('Reject', 'odr002', 'odm001', 'single'),
        'swap' => array('Swap', 'ods002', 'odm001', 'single'),
        'rejectc' => array('Reject', 'odr002', 'odm001'),
        'point' => array('MemberPointRecord', 'mpr004', 'odm001', 'single'),
        'receipt' => array('Receipt', 'rec002', 'odm001', 'single'),
        'swapMore' => array('Swap', 'ods002', 'odm001'),
        'rejectMore' => array('Reject', 'odr002', 'odm001'),
    );

    const MODE_CSV = 'csv';
    const MODE_HOUSE = 'house';

    const PAY_TYPE_CARD = 'card';
    const PAY_TYPE_ATM = 'atm';
    const PAY_TYPE_CASH = 'cash';
    const PAY_TYPE_NONE = 'none';

    static $Types = array('未核帳', '已核帳');
    static $Methods = array(
        self::PAY_TYPE_CARD => '信用卡', 
        self::PAY_TYPE_ATM => 'ATM轉帳', 
        self::PAY_TYPE_CASH => '付現',
        self::PAY_TYPE_NONE => '無現金'
    );
    static $Modes = array( self::MODE_CSV =>'到店取貨', self::MODE_HOUSE => '宅配');
    static $receipt = array(
        'donate' => '發票捐贈', 
        'e-duplex' => '二聯式電子發票',
        'p-duplex' => '二聯式紙本發票',
        'triple' => '三聯式發票',
    );
    static $attribute_transform = array(
        'odm001' => 'sn',
        'odm002' => 'oid',
        'odm003' => 'total',
        'odm004' => 'coupon',
        'odm005' => 'check_date',
        'odm006' => 'date1',
        'odm007' => 'date2',
        'odm008' => 'date3',
        'odm009' => 'methods',
        'odm010' => 'getmode',
        'odm011' => 'getno',
        'odm012' => 'lv2id',
        'odm013' => 'mid',
        'odm014' => 'name',
        'odm015' => 'phone',
        'odm016' => 'city',
        'odm017' => 'address',
        'odm018' => 'itype',
        'odm019' => 'iubn',
        'odm020' => 'ititle',
        'odm021' => 'lv1id',
        'odm022' => 'lv2id',
        'odm023' => 'mlv1id',
        'odm024' => 'mlv2id',
        'odm025' => 'mlv3id',
        'odm026' => 'lv1percnet',
        'odm027' => 'lv2percent',
        'odm028' => 'mpercent',
        'odm029' => 'fare',
        'odm030' => 'money',
        'odm031' => 'coupon_date',
        'odm032' => 'reject_shopgold',
        'odm033' => 'reject_point',
        'odm034' => 'keyman',
        'odm035' => 'openaccount'
    );
    static $validate_rules = array(
        /* 消費者姓名 */
        array(
            'selector' => '[name=member_name]',
            'column' => 'odm014',
            'rules' => array(
                'required' => array(),
            )
        ),
        /* 消費者電話 */
        array(
            'selector' => '[name=member_phone]',
            'column' => 'odm015',
            'rules' => array(
                'required' => array(),
            )
        ),
        /* 消費者地址 */
        array(
            'selector' => '[name=member_address]',
            'column' => 'odm017',
            'rules' => array(
                'userAddress' => array(),
            )
        ),
        array(
            'selector' => '[name=signoff]',
            'column' => 'odm005',
            'rules' => array(
                'allFinish' => array()
            )
        )
    );
    public function validateAllFinish($value) {
        if (! empty($value)) {
            $message = array();
            $r_count = Reject::count(array(
                'conditions' => array('odr002 = ? AND odr013 = 0', $this->odm001)
            ));
            ($r_count > 0) && ($message[] = '退貨');
            $c_count = Swap::count(array(
                'conditions' => array('ods002 = ? AND ods013 = 0', $this->odm001)
            ));
            ($c_count > 0) && ($message[] = '換貨');
            return count($message) > 0
                ? (implode("、", $message) . '資料尚未審核完成')
                : true;
        }
        return true;
        
    }

    public function beforeSave() 
    {
        if (empty($this->odm002)) {
            /* 建立序號單 */
            $date = date('Y/m/d');  /* this year */
            $ymd = date('ymd');     /* 當年末兩碼 */

            $options = array(
                'select' => 'MAX(odm002) AS no',
                'conditions' => array('odm006 = ?', $date),
                'soft' => true,
            );
            $order = Order::first($options) ?: new Order;
            $cache = OrderCache::first($options) ?: new OrderCache;
            $no = (max($order->no, $cache->no) ?: 0) % 10000;
            $this->odm002 = $ymd . sprintf('%04d', $no + 1);
        }
        if (empty($this->odm002)) return false;
    }

    public function afterSave() 
    {
        /* 由於信用卡付款的資料存在 order_cache, 會繼承此 class , 所以要過濾掉此動作 */
        if (get_class($this) !== 'model\Order') return;

        /**
         * 由於會先建立一次 訂單編號, 所以無法用 id 檢查是否為新增
         * 改檢查總金額修改前是否為 0
         * (比較不好的檢查方法)
         */
        $update = $this->getUpdateAttribute();
        $isAdd = empty($update['odm003']);

        $action = $isAdd ? LogOrder::ACTION_ADD : LogOrder::ACTION_EDIT;
        LogOrder::log($this, $action);

        /* 建立會員點數資料 */
        $this->recalculateMemberPoint();

        /* 若有取貨日期(出貨日期) 則扣掉商品存貨數量 */
        if (! empty($this->odm007)) {
            $options = array(
                'conditions' => array('odd002 = ?', $this->odm001)
            );
            foreach (OrderDetail::all($options) as $row) {
                $row->updateInventoryDetail($this);
            }
        }

    }
    public function afterDelete() {
        if (get_class($this) !== 'model\Order') return;
        $options = array('conditions' => array('odd002 = ? ', $this->odm001));
        $details = OrderDetail::all($options);
        foreach ($details as $r) {
            $r->delete();
        }

        $options = array('conditions' => array('odr002 = ? ', $this->odm001));
        $rejects = Reject::all($options);
        foreach ($rejects as $r) {
            $r->delete();
        }

        $options = array('conditions' => array('ods002 = ? ', $this->odm001));
        $swaps = Swap::all($options);
        foreach ($swaps as $r) {
            $r->delete();
        }

        $options = array('conditions' => array("mpr004 = 'order' AND mpr004 = ?", $this->odm001));
        $points = MemberPointRecord::all($options);
        foreach ($points as $r) {
            $r->delete();
        }

        $this->recalculateMemberPoint();

    }

    public function sendMail() {

        /* 新增的訂單, 要寄信通知 */
        $cmd = sprintf(
            'php %s "%s" > /dev/null &', 
            (ROOT_PATH . 'mail/send_mail.php'),
            $this->odm001
        );
        /* 只有在 linux 系統才能非同步執行 */
        exec($cmd);
        // pclose(popen($cmd, 'r'));
    }

    /**
     * 回傳下一筆訂單的編號 (從 order , order_cache 中找最大的)
     * @return [type] [description]
     */
    public static function createNo() {
        /* 建立序號單 */
        $date = date('Y/m/d');  /* this year */
        $ymd = date('ymd');     /* 當年末兩碼 */

        $options = array(
            'select' => 'MAX(odm002) AS no',
            'conditions' => array('odm006 = ?', $date)
        );
        $order = Order::first($options) ?: new Order;
        $cache = OrderCache::first($options) ?: new OrderCache;
        $no = (max($order->no, $cache->no) ?: 0) % 10000;

        return $ymd . sprintf('%04d', ($no + 1));
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

    public static function getMethods($value) {
        return static::$Methods[$value];
    }
    public function getPayType() {
        return static::$Methods[$this->odm009];
    }

    public static function getMode($value) {
        return static::$Modes[$value];
    }

    public function getModeLabel() {
        return static::$Modes[$this->odm010];

    }
    
    public static function receiptName() 
    {
        return static::$receipt[$this->odm018];
    }

    /**
     * 取得運費金額
     * @return integer 回傳運費金額 
     */
    public static function getFare() {
        return Setting::value('Fare');
    }


    public function fixedMoney() {
        return round($this->money, 4);
    }

    public static function getOrder($oid) {
            // echo $sql;
        return static::find_by_odm002($oid) ?: new Order;
        // return static::find_by_sql($sql);
    }
    

    public static function getOrderDetail($sn) {
        $sql = 'SELECT odd001 AS sn, '
            . '     odd002 AS oid, '
            . '     odd003 AS pid, '
            . '     odd004 AS pmoney, '
            . '     odd005 AS shoppinggold, '
            . '     odd006 AS amount '
            . ' FROM order_detail '
            . " WHERE odd002 = {$sn}";
        return static::find_by_sql($sql);
    }

    public static function getOrderNo($no) {
        $sql = 'SELECT odm002 AS no '
            . ' FROM order_manager '
            . " WHERE odm002 = {$no}";
        return static::find_by_sql($sql);
    }

    public static function getOrderLastNo() {
        $sql = 'SELECT odm002 AS no '
            . ' FROM order_manager '
            . " ORDER BY odm002 DESC limit 1";
        return static::find_by_sql($sql);
    }

    /**
     * 取得此交易產生的購物金 (會員的購物金, 不包含花費, 退回的數值)
     * @param  boolean  $not_check_finish   是否不驗證交易已核帳
     *                      true  : 無論是否核帳，都回傳應得購物金的值
     *                      false : 若交易未核帳，回傳  0 (default)
     * @return integer  回傳購物金
     */
    public function getMemberPoint($not_check_finish = false) {

        if (! $not_check_finish && empty($this->odm031)) return 0;
        return floor( 
            max(($this->odm030 - $this->odm032), 0) * $this->odm028 / 100
        );
    }

    /**
     * 計算受此交易影響的會員購物金 
     * @return void
     */
    public function recalculateMemberPoint() 
    {

        /* 取得此交易產生的購物金 */
        $point = $this->getMemberPoint();
        
        /* 查詢對應此訂單的 member point record */
        $options = array(
            'conditions' => array(
                "mpr003 = 'order' AND mpr004 = ? ",
                $this->odm001
            )
        );
        $records = MemberPointRecord::all($options);

        /* 取得會員的 record */
        $find = function($mid) use (&$records) {
            foreach ($records as $idx => $row) {
                if (intval($mid) === intval($row->mpr002)) {
                    array_splice($records, $idx, 1);
                    return $row;
                }
            }
            return new MemberPointRecord;
        };


        /* 計算消費者的購物金 */
        $record = $find($this->odm013);
        $record->mpr002 = $this->odm013;
        $record->mpr003 = 'order';
        $record->mpr004 = $this->odm001;
        /* 消費者有花費點數, 退回點數的計算 */
        $record->mpr005 = $point - $this->odm004 + $this->odm033;
        $record->save();

        /* 計算消費者上層的購物金 */
        $upper = array($this->odm023, $this->odm024, $this->odm025);
        foreach ($upper as $mid) {
            if (intval($mid) < 1) continue;
            $record = $find($mid);
            $record->mpr002 = $mid;
            $record->mpr003 = 'order';
            $record->mpr004 = $this->odm001;
            $record->mpr005 = $point;
            $record->mpr006 = null;
            $record->save();
        }

        /* 將多餘的資料刪除 */
        foreach ($records as $record) {
            $record->delete();
        }

    }

    /* 檢查地址欄位, 若為宅配的話, 必需填地址 */
    public function validateUserAddress($value)
    {
        return ($this->odm010 == self::MODE_HOUSE && empty($value))
            ? Lang::get('validate.required')
            : true;
    }
}

