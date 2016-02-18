<?php
namespace model;
use ActiveRecord\Model;
use Image;
use QRcode;
use Lang;
use System;
use Input;

class Member extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'member';

    // explicit pk since our pk is not "id"
    static $primary_key = 'mem001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'al' => array('Agent', 'age001', 'mem016', 'single'),
        'ar' => array('Agent', 'age001', 'mem017', 'single'),
        'radar' => array('Agent', 'age001', 'mem017', 'single'),
        'operate' => array('Agent', 'age001', 'mem026', 'single'),
    );

    static $attribute_transform = array(
        'mem001' => 'id',
        'mem002' => 'no',
        'mem003' => 'account',
        'mem004' => 'password',
        'mem005' => 'name',
        'mem006' => 'time',
        'mem007' => 'born',
        'mem008' => 'city',
        'mem009' => 'address',
        'mem010' => 'bank_account',
        'mem011' => 'phone',
        'mem012' => 'email',
        'mem013' => 'error',
        'mem014' => 'is_disable',
        'mem015' => 'feedback',
        'mem016' => 'lv1',
        'mem017' => 'lv2',
        'mem018' => 'mlv3',
        'mem019' => 'mlv2',
        'mem020' => 'mlv1',
        'mem021' => 'point',
        'mem022' => 'qrcode',
        'mem023' => 'is_blacklist',
        'mem024' => 'blacklistDate',
        'mem025' => 'blacklistReason',
        'mem026' => 'operate',
        'mem027' => 'bank_code',
        'mem028' => 'qrcodeId',
    );

    static $validate_rules = array(
        array(
            'selector' => '[name=password]',
            'column' => 'mem004',
            'rules' => array(
                'required' => array(),
                'length' => array(4, 16)
            )
        ),
        // array(
        //     'selector' => '[name=password2]',
        //     'column' => 'mem004',
        //     'rules' => array(
        //         'confirmPassword' => array()
        //     ),
        // ),
        array(
            'selector' => '[name=name]',
            'column' => 'mem005',
            'rules' => array(
                'required' => array(),
                // 'length' => array(1, 10)
            )
        ),
        array(
            'selector' => '[name=phone]',
            'column' => 'mem011',
            'rules' => array(
                'uniquePhone' => array('member', 'mem011', 'mem001'),
                'length' => array(1, 10),
                )
        ),
        
    );

    public function validateUniquePhone($value, $table, $column, $not_column) {
        $where = "{$column} = ? AND {$not_column} != ?";
        $sql = "SELECT COUNT(1) AS count FROM {$table} WHERE {$where} ";
        list($row) = static::find_by_sql($sql, array($value, $this->$not_column ?: 0));
        return $row->count == 0
            ? true
            : Lang::get('page01.validator.uniquePhone');
    }
    public function validateConfirmPassword($value) {
        $confirm = Input::post('password2');
        return $confirm === null || $value === $confirm ||Input::get('site')
            ? true
            : Lang::get('page01.validator.confirmPassword');
    }

    public function afterSave() 
    {
        LogMember::log($this);

        /* 建立 QRCode */
        if (empty($this->mem028)) $this->createQRCode();
    }
    public static function getInfoByNo($no) 
    {
        $option = array(
            'conditions' => "mem002 = '{$no}'",
        );

        $result = Member::find('all', $option) ?: array();

        return $result;
    }

    public static function getInfoByMid($mid) 
    {
        $option = array(
            'conditions' => "mem001 = '{$mid}'",
        );

        $result = Member::find('all', $option) ?: array();

        return $result;
    }
    // 無
    public static function getInfoByPhone($phone) 
    {
        $option = array(
            'conditions' => "mem011 = '{$phone}'",
        );

        $result = Member::find('all', $option) ?: array();

        return $result;
    }

    public function createQRCode()
    {
        $code = '';
        do {
            $code = $this->randInvitationCode();
        } while (Member::count(array('conditions' => array('mem028' => $code))));
        $this->mem028 = $code;

        $this->mem022 = "{$code}.png";
        $path = Image::qrcodePath($this->mem022);

        $txt = System::get('url') . "/pub/gateway.php?cmd=201&site=1&code={$this->mem028}";
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 4;
        QRcode::png($txt, $path, $errorCorrectionLevel, $matrixPointSize, 2);

        /* 必免觸發 afterSave */
        $sql = "UPDATE `member` SET mem022 = ?, mem028 = ? WHERE mem001 = ?";
        $values = array($this->mem022, $this->mem028, $this->mem001);
        return static::connection()->query($sql, $values);
    }

    public function getQRCodeUrl() {
        return Image::qrcodeUrl($this->mem022);
    }

    /**
     * 取得會員的相關資訊 (app 登入後用的到的資訊 )
     * @return array()
     */
    public function loginMemberData() {
        $data = $this->attributes(array(
            'id', 
            'no', 
            'account', 
            'name', 
            'born', 
            'city',
            'address',
            'bank_code',
            'phone',
            'email',
            'point',
            'qrcode',
            'bank_account',
        ));
        $data['sid'] = \User::sid();
        $data['born'] = $this->mem007 ? $this->mem007->format('Y/m/d') : '';
        $data['qrcode'] = $this->getQRCodeUrl();
        $city = Post::row($this->mem008) ?: new Post;
        $data['country'] = $city->pos002;
        $data['code'] = $this->mem028;

        return $data;
    }

    public static function getMemberData($mid) 
    {
        $option = array(
            'conditions' => "mem001 = '{$mid}' AND mem014 = 0",
        );

        $result = Member::find('all', $option) ?: array();

        return $result;
    }

    /**
     * 重新計算會員的購物金
     * @return boolean 回傳執行結果
     */
    public function recalculatePoint() 
    {
        $options = array(
            'select' => 'IFNULL(SUM(mpr005), 0) AS point',
            'conditions' => array('mpr001 = ? ', $this->mem001)
        );
        $row = MemberPointRecord::find('first', $options);

        /* 更新此會員的購物金 (這裡不使用 ActiveRecord 的 save, 避免觸發 log 的記錄 */
        $values = array($row->point, $this->mem001);
        $sql = "UPDATE `member` SET `mem021` = ? WHERE `mem001` = ?";
        return static::connection()->query($sql, $values);

    }

    public static function createMemberNo($rId, $rNo)
    {
        $sql_max = "SELECT 
                        LPAD(
                            IFNULL(SUBSTR(MAX(mem002), 6), 0) + 1, 5, 0
                        )
                    FROM member AS mem
                    WHERE mem017 = :id ";

        $sql = "INSERT INTO member (mem002)
                VALUES (CONCAT(:no, ($sql_max)))";
        $data = array(':no' => $rNo, ':id' => $rId);
        
        Member::connection()->query($sql, $data);
        $id = Member::connection()->insert_id();

        return Member::find_by_mem001($id) ?: false;

    }


}

