<?php
namespace model;
use ActiveRecord\Model;

class Swap extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'order_swap';

    // explicit pk since our pk is not "id"
    static $primary_key = 'ods001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    # 軟刪除
    static $soft_delete = 'ods016';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    const ITEM_TYPE_PROCESSING = 0;
    const ITEM_TYPE_FINISH = 1;
    const ITEM_TYPE_CANCEL = 2;
    static $Types = array(
        self::ITEM_TYPE_PROCESSING => '處理中',
        self::ITEM_TYPE_FINISH => '核帳',
        self::ITEM_TYPE_CANCEL => '註銷'
    );
    static $attribute_transform = array(
        'ods001' => 'sn',
        'ods002' => 'oid',
        'ods003' => 'sNO',
        'ods004' => 'mid',
        'ods005' => 'aid',
        'ods006' => 'pid',
        'ods007' => 'money',
        'ods008' => 'amount',
        'ods009' => 'reason',
        'ods010' => 'address',
        'ods011' => 'keyman',
        'ods012' => 'dateRecord',
        'ods013' => 'status',
        'ods014' => 'checkDate',
        'ods015' => 'swapdate'
    );

    static $has_to = array(
        'product' => array('Product', 'pdm001', 'ods006', 'single'),
        'order'   => array('Order', 'odm001', 'ods002', 'single'),
        'ar' => array('Agent', 'age001', 'ods005', 'single'),
        'member' => array('Member', 'mem001', 'ods004', 'single')
    );

    static $validate_rules = array(
        /* 換貨數量 */
        array(
            'selector' => '[name=amount]',
            'column' => 'ods008',
            'rules' => array(
                'checkAmount' => array(),
            )
        )
    );

    public function validateCheckAmount($value) {
        // var_dump($value, $this->ods001, $this->ods002, $this->ods006);
            
        /* 注銷資料不檢查 */
        if ($this->ods013 === 2)  return true;
        $message = array();
        $s_count = Swap::first(array(
                'select' => 'IFNULL(SUM(ods008), 0) as swapamount',
                'conditions' => array(
                    'ods001 != ? AND ods002 = ? AND ods006 = ? AND ods013 != 2', 
                    $this->ods001, 
                    $this->ods002,
                    $this->ods006
                )
        ));
        // 除了自身以外的換貨數量
        $astotal = ($s_count ? $s_count->swapamount : 0) ?: 0;
        $o_count = OrderDetail::first(array(
                'conditions' => array(
                    'odd002 = ? AND odd003 = ?', 
                    $this->ods002, 
                    $this->ods006
                )
            ));
        $od_count = $o_count ? $o_count->odd006 : 0;
        $total = $od_count - $astotal;
        return $value > $total
            ? '換貨數量超過購買數量'
            : true;
    }

    public function getItemType() {
        return static::getType(intval($this->ods013));
    }
    public function cancelDate() {
        return $this->isCancel()
            ? $this->dateFormat('ods014')
            : null;
    }

    public function finishDate() {
        return $this->isFinish()
            ? $this->dateFormat('ods015')
            : null;
    }

    public function isProcessing() {
        return intval($this->ods013) === self::ITEM_TYPE_PROCESSING;
    }


    public function isFinish() {
        return intval($this->ods013) === self::ITEM_TYPE_FINISH;
    }

    public function isCancel() {
        return intval($this->ods013) === self::ITEM_TYPE_CANCEL;
    }

    public function afterSave() 
    {
        LogOrder::log($this);
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
    
    public static function getPage($page) {
        $per_page = static::$per_page;
        $start = $per_page * ((intval($page) ?: 1) - 1);
        $sql = 'SELECT ods001 AS sn, '
            . '     ods002 AS oid, '
            . '     ods003 AS mid, '
            . '     ods004 AS aid, '
            . '     ods005 AS address, '
            . '     ods006 AS reason, '
            . '     ods007 AS keyman1, '
            . '     ods008 AS keyman2, '
            . '     ods009 AS status, '
            . '     ods010 AS dateRecord '
            . ' FROM order_swap '
            . " LIMIT {$start}, {$per_page}";
        return static::find_by_sql($sql);
    }

    public static function fixedMoney() {
        return round($this->money, 4);
    }

    public static function getProduct($oid) {
        $sql = 'SELECT ord001 AS sn, '
            . '     ord002 AS oid, '
            . '     ord003 AS pid, '
            . '     ord004 AS productName, '
            . '     ord005 AS pmoney '
            . ' FROM order_reject_detail '
            . " WHERE ord002 = {$oid}";
        return static::find_by_sql($sql);
    }

    public static function getOrder($oid) {
        $sql = 'SELECT odm001 AS sn, '
            . '     odm002 AS oid, '
            . '     odm003 AS money, '
            . '     odm004 AS date1, '
            . '     odm005 AS date2, '
            . '     odm006 AS date3, '
            . '     odm007 AS shoppinggold, '
            . '     odm008 AS cash, '
            . '     odm009 AS creditcard, '
            . '     odm010 AS shoppay, '
            . '     odm011 AS agent01id, '
            . '     odm012 AS agent02id, '
            . '     odm013 AS getsn, '
            . '     odm014 AS agent03id, '
            . '     odm015 AS ordername, '
            . '     odm016 AS mid, '
            . '     odm017 AS address, '
            . '     odm018 AS methods, '
            . '     odm019 AS status '
            . ' FROM order_manager '
            . " WHERE odm002 = {$oid}";
        return static::find_by_odm002($oid) ?: new Order;
        return static::find_by_sql($sql);
    }

    public static function getOrderDetail($oid) {
        $sql = 'SELECT odd001 AS sn, '
            . '     odd002 AS ooid, '
            . '     odd003 AS pid, '
            . '     odd004 AS pmoney, '
            . '     odd005 AS shoppinggold, '
            . '     odd006 AS point, '
            . '     odd007 AS amount '
            . ' FROM order_detail '
            . " WHERE odd002 = {$oid}";
        return static::find_by_sql($sql);
    }

    public static function getOrderForSwap($oid) {
        $sql = 'SELECT ods002 AS ooid '
            . ' FROM order_swap '
            . " WHERE ods002 = {$oid} ";
        return static::find_by_ods002($oid);
    }

    public static function getSwap($oid) {
        $sql = 'SELECT ods001 AS sn, '
            . '     ods002 AS oid, '
            . '     ods003 AS mid, '
            . '     ods004 AS aid, '
            . '     ods005 AS address, '
            . '     ods006 AS reason, '
            . '     ods007 AS keyman1, '
            . '     ods008 AS keyman2, '
            . '     ods009 AS status, '
            . '     ods010 AS dateRecord '
            . ' FROM order_swap '
            . " WHERE ods002 = {$oid}";
        return static::find_by_ods002($oid);
    }


}

