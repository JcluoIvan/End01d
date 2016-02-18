<?php
namespace model;
use ActiveRecord\Model;
use User;
use Input;
use Image;
use QRcode;
use Lang;
use System;

class Agent extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'agent';

    // explicit pk since our pk is not "id"
    static $primary_key = 'age001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';
    static $has_to = array(
        'agent' => array('Agent', 'age018', 'age001'),
        'parent' => array('Agent', 'age001', 'age018', 'single'),   /* 取得指揮站 */
        'childs' => array('Agent', 'age018', 'age001'),             /* 取得雷達站 */
        'order' => array('Order', 'odm022', 'age001'),
        'rstatement' => array('RadarStatement', 'rat002', 'age001'),
        'bank' => array('Bank', 'ban001', 'age011', 'single'),
    );
    static $attribute_transform = array(
        'age001' => 'id',
        'age002' => 'utp',
        'age003' => 'no',
        'age004' => 'account',
        'age005' => 'password',
        'age006' => 'name',
        'age008' => 'born',
        'age009' => 'city',
        'age010' => 'address',
        'age011' => 'bank_code',
        'age012' => 'phone',
        'age013' => 'email',
        'age014' => 'store',
        'age016' => 'is_disabled',
        'age020' => 'qrcode',
        'age021' => 'bank_account',
        'age022' => 'qrcodeId',
        'age023' => 'store_phone',
        'age024' => 'is_public',
        'age025' => 'is_locked',
    );
    /* 主管 */ 
    const TYPE_S = 'S';
    /* 會計 */ 
    const TYPE_A = 'A';
    /* 廠務部 */ 
    const TYPE_P = 'P';
    /* 客服 */ 
    const TYPE_C = 'C';
    /* 指揮站 */ 
    const TYPE_L = 'L';
    /* 雷達站 */ 
    const TYPE_R = 'R';


    static $allow_page = array(
        /* 主管 */
        // 'S' => true,
        self::TYPE_S => array(
                'page01', 'page02', 'page03', 'page04', 'page05',
                'page06', 'page07', 'page97', 'page98', 'page99'
            ),
        /* 會計 */
        self::TYPE_A => array('page11', 'page03', 'page05', 'page06', 'page07', 'page98'),
        /* 廠務部 */
        self::TYPE_P => array('page02', 'page12', 'page98'),
        /* 客服 */
        self::TYPE_C => array('page10', 'page98'),
        /* 指揮站 */
        self::TYPE_L => array('page09', 'page98'),
        /* 雷達站 */
        self::TYPE_R => array('page08', 'page98'),
    );

    static $departtypes = array(
        self::TYPE_S => '主管', 
        self::TYPE_A => '會計部',
        self::TYPE_P => '廠務部', 
        self::TYPE_C => '客服部'
    );
    static $agenttypes = array(
        self::TYPE_L => '專業經理人', 
        self::TYPE_R => '展示中心'
    );

    static $validate_rules = array(
        array(
            'selector' => '[name=account]',
            'column' => 'age004',
            'rules' => array(
                'unique' => array('agent', 'age004', 'age001'),
                'required' => array(),
            )
        ),
        array(
            'selector' => '[name=password]',
            'column' => 'age005',
            'rules' => array(
                'required' => array(),
                'length' => array(4, 16)
            )
        ),
        // array(
        //     'selector' => '[name=password2]',
        //     'column' => 'age005',
        //     'rules' => array(
        //         'confirmPassword' => array(),
        //     )
        // ),
        array(
            'selector' => '[name=name]',
            'column' => 'age006',
            'rules' => array(
                'required' => array(),
            )
        ),
        array(
            'selector' => '[name=phone]',
            'column' => 'age012',
            'rules' => array(
                'uniquePhone' => array('agent', 'age012', 'age001'),
                'requiredPhone' => array(),
            )
        ),
        array(
            'selector' => '[name=rebate]',
            'column' => 'age017',
            'rules' => array(
                'between' => array(0, 100)
            )
        )
    );
    public function validateUniquePhone($value) {
        $count = 0;
        if (! empty($value)) {
            $options = array('conditions' => array(
                "age012 = ? AND age001 != ?",
                $value,
                ($this->age001 ?: 0)
            ));
            $count = intval(static::count($options));
        }
        return $count === 0 
            ? true
            : Lang::get('page01.validator.uniquePhone');
    }
    public function validateRequiredPhone($value) {
        if (in_array($this->age002, array_keys(static::$departtypes)) && empty($value)) {
            return true;
        } else {
            return (preg_match('/^\d{10}/', $value))
                ? true
                : Lang::get('page01.validator.phoneLength');
        }
    }
    public function validateConfirmPassword($value) {
        $confirm = Input::post('password2');
        return ($value === $confirm)
            ? true
            : Lang::get('page01.validator.confirmPassword');
    }
    public function afterSave() 
    {
        LogAgent::log($this);
        if (empty($this->age022)) $this->createQRCode();
    }

    /**
     * 是否有 $page 的權限
     * @param  [string] $page 傳入 pageX 的字串
     * @return [boolean]    true / false
     */
    public static function allowView($page) {
        $type = User::get('type') ?: null;
        $allow = isset(static::$allow_page[$type]) 
            ? static::$allow_page[$type] 
            : array();
        return User::isLogin() && ($allow === true || in_array($page, $allow));
    }
    /**
     * 取得登入的使用者能瀏覽的頁面
     * @return [array|boolean]  
     *         回傳 
     *             array 例: [page01, page05, page06]
     *             true (代表所有頁面都有權限) 
     *             false (代表所有頁面都無權限)
     */
    public static function allowPages() {
        $type = User::get('type') ?: null;
        return isset(static::$allow_page[$type]) 
            ? static::$allow_page[$type] : false;
    }

    public static function getCorrespondTypes($key = null) 
    {

        if (isset(static::$departtypes[$key])) {
            $type = static::$departtypes[$key];
        } else if (isset(static::$agenttypes[$key])) {
            $type = static::$agenttypes[$key];
        } else {
            $type = null;
        }
        return $type;
    }

    public static function getTypes($key = null) 
    {

        if ($key == 1) {
            return static::$departtypes;
        } else if ($key == 2) {
            return static::$agenttypes;
        }
        return null;
    }


    public static function findUser($account) 
    {

        return Agent::find_by_age004($account) ?: null;

    }

    public static function getInfoByNo($no) 
    {
        $option = array(
            'conditions' => "age003 = '{$no}'",
        );

        $result = Agent::find('all', $option) ?: array();

        return $result;
    }

    public function createQRCode()
    {
        $code = '';
        do {
            $code = $this->randInvitationCode();
        } while (Agent::count(array('conditions' => array('age022' => $code))));
        $this->age022 = $code;

        $this->age020 = "{$code}.png";
        $path = Image::qrcodePath($this->age020);

        $txt = System::get('url') . "/pub/gateway.php?cmd=201&site=1&code={$code}";
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 4;
        QRcode::png($txt, $path, $errorCorrectionLevel, $matrixPointSize, 2);

        /* 必免觸發 afterSave */
        $sql = "UPDATE `agent` SET age020 = ?, age022 = ? WHERE age001 = ?";
        $values = array($this->age020, $this->age022, $this->age001);
        return static::connection()->query($sql, $values);
    }

    public function getQRCodeUrl() {
        return empty($this->age020) ? false : Image::qrcodeUrl($this->age020);
    }


    /**
     * 取得未被停用的指揮站清單 (不建分頁, 並且回傳陣列)
     * @return array(
     *             id <string> => no - name <string> 
     *             ...... 
     *         );
     */
    static function getLAgentList() {
        $options = array(
            'select' => implode(',', array(
                'age001 AS id',
                'age003 AS no',
                'age006 AS name',
                'age016 AS disabled'
            )),
            'conditions' => array(
                'age002 = ?', 
                'L'
            ),
            'order' => 'age003'
        );
        $rows = array();
        $result = Agent::find('all', $options) ?: array();
        foreach ($result as $row) {
            $disabled = $row->disabled ? ' ( 已停用 ) ' : '';
            $rows[$row->id] = "{$row->no} - {$row->name} {$disabled}";
        }
        return $rows;
    }

    /**
     * 取得雷達站清單 (不建分頁, 並且回傳陣列)
     * @param  [integer] $lid 指揮站 id
     * @return array(
     *             id <string> => no - name <string>
     *             ...... 
     *         );
     */
    static function getRAgentList($lid) {
        $options = array(
            'select' => implode(',', array(
                'age001 AS id',
                'age003 AS no',
                'age006 AS name',
                'age016 AS disabled'
            )),
            'conditions' => array(
                'age002 = ? AND age018 = ? ', 
                'R',
                $lid,
            ),
            'order' => 'age003',
        );
        $rows = array();
        $result = Agent::find('all', $options) ?: array();
        foreach ($result as $row) {
            $disabled = $row->disabled ? ' ( 已停用 ) ' : '';
            $rows[$row->id] = "{$row->no} - {$row->name} {$disabled}";
        }
        return $rows;
    }
    /**
     * 查詢 Agent 使用者是否存在
     * @param  [type]  $id [age001]
     * @return boolean     [description]
     */
    public static function hasAgent($id) {
        $options = array(
            'conditions' => array('age001 = ? AND age016 = 0', $id)
        );
        return intval(Agent::count($options)) > 0;
    }

    public static function getAgentData($aid) 
    {
        $option = array(
            'conditions' => "age001 = '{$aid}'",
        );

        $result = Agent::find('all', $option) ?: array();

        return $result;
    }

}

