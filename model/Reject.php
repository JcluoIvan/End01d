<?php
namespace model;
use ActiveRecord\Model;

class Reject extends BaseModel 
{
    // explicit table name since our table is not "books"
    static $table_name = 'order_reject';

    // explicit pk since our pk is not "id"
    static $primary_key = 'odr001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    # 軟刪除
    static $soft_delete = 'odr018';

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
        'odr001' => 'sn',
        'odr002' => 'oid',
        'odr003' => 'rNO',
        'odr004' => 'mid',
        'odr005' => 'aid',
        'odr006' => 'pid',
        'odr007' => 'money',
        'odr008' => 'amount',
        'odr009' => 'reason',
        'odr010' => 'address',
        'odr011' => 'keyman',
        'odr012' => 'dateRecord',
        'odr013' => 'status',
        'odr014' => 'rTmoney',
        'odr015' => 'rTpoint',
        'odr016' => 'checkDate',
        'odr017' => 'rejectdate' 
    );

    static $has_to = array(
        'product' => array('Product', 'pdm001', 'odr006', 'single'),
        'order'   => array('Order', 'odm001', 'odr002', 'single'),
        'ar' => array('Agent', 'age001', 'odr005', 'single'),
        'member' => array('Member', 'mem001', 'odr004', 'single')
    );

    static $validate_rules = array(
        /* 退貨數量 */
        array(
            'selector' => '[name=amount]',
            'column' => 'odr008',
            'rules' => array(
                'checkAmount' => array(),
            )
        ),
        /* 退貨總金額 */
        array(
            'selector' => '[name=rTmoney]',
            'column' => 'odr014',
            'rules' => array(
                'checkMoney' => array(),
            )
        )
    );

    public function validateCheckAmount($value) {
        // var_dump($this->odr001, $this->odr002, $this->odr006);
        $message = array();
        $r_count = Reject::first(array(
                'select' => 'SUM(odr008) as rejectamount',
                'conditions' => array(
                    'odr001 != ? AND odr002 = ? AND odr006 = ? AND odr013 != 2', 
                    $this->odr001, 
                    $this->odr002,
                    $this->odr006
                )
        ));
        // 除了自身以外的退貨數量
        $ar = ($r_count ? $r_count->rejectamount : 0) ?: 0;

        $o_count = OrderDetail::first(array(
                'conditions' => array(
                    'odd002 = ? AND odd003 = ?', 
                    $this->odr002, $this->odr006
                )
            ));
        $od_count = $o_count ? $o_count->odd006 : 0;
        $total = $od_count - $ar;
        return $value > $total
            ? '退貨數量超過購買數量'
            : true;
    }

    public function validateCheckMoney($value) {
        // var_dump($this->odr001, $this->odr002, $this->odr006);
        $message = array();
        $r_money = Reject::first(array(
                'select' => 'SUM(odr014) as rejectmoney',
                'conditions' => array(
                    'odr001 != ? AND odr002 = ? AND odr013 != 2', 
                    $this->odr001, 
                    $this->odr002
                )
        ));
        // 除了自身以外的退貨金額
        $am = ($r_money ? $r_money->rejectmoney : 0) ?: 0;
        $order = Order::find_by_odm001($this->odr002);

        $total = $order->odm030 - $am;
        return $value > $total
            ? '退貨金額超過購買金額'
            : true;
    }

    public function getItemType() {
        return static::getType(intval($this->odr013));
    }

    public function cancelDate() {
        return $this->isCancel() ? $this->dateFormat('odr016') : null;
    }


    public function finishDate() {
        return $this->isFinish() ? $this->dateFormat('odr016') : null;
    }

    public function isProcessing() {
        return intval($this->odr013) === self::ITEM_TYPE_PROCESSING;
    }


    public function isFinish() {
        return intval($this->odr013) === self::ITEM_TYPE_FINISH;
    }

    public function isCancel() {
        return intval($this->odr013) === self::ITEM_TYPE_CANCEL;
    }

    public function afterSave() {
        LogOrder::log($this);
        $this->updateInventoryDetail();

    }

    /**
     * 更新 ProductInventDetail 資料 (商品數量) PS: 這裡動作丟回 detail 來處理
     * @return void()
     */
    public function updateInventoryDetail() {


        $options = array(
            'conditions' => array(
                'odd002 = ? AND odd003 = ?',
                $this->odr002,
                $this->odr006
            )
        );
        $detail = OrderDetail::first($options);

        if (empty($detail)) 
            throw new Exception('查無訂單明細資料: ' . print_r($this, true));


        if (! $detail->save()) {
            $message = 'OrderDetail 更新失敗: ' . print_r($detail, true);
            throw new Exception($message);
        }

    }

    // public static function getallOrders() {
    //     $this->updateInventoryDetail();
    //         $sql  = "SELECT * FROM order_manager WHERE age016 = :lv";
    //         $data = array(':lv' => $lv);
        
    //         return static::find_by_sql($sql,$data);
    //     return static::all();
    // }
    
    public static function getType($value) {
        return static::$Types[$value];
    }

    public static function fixedMoney() {
        return round($this->money, 4);
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

    public static function getOrderForReject($oid) {
        $sql = 'SELECT odr002 AS ooid '
            . ' FROM order_reject '
            . " WHERE odr002 = {$oid} ";
        return static::find_by_odr002($oid);
    }

    public static function getReject($oid) {
        $sql = 'SELECT odr001 AS sn, '
            . '     odr002 AS oid, '
            . '     odr003 AS mid, '
            . '     odr004 AS aid, '
            . '     odr005 AS address, '
            . '     odr006 AS reason, '
            . '     odr007 AS keyman1, '
            . '     odr008 AS keyman2, '
            . '     odr009 AS status, '
            . '     odr010 AS dateRecord '
            . ' FROM order_reject '
            . " WHERE odr002 = {$oid}";
            
        return static::find_by_odr002($oid);
    }


}

