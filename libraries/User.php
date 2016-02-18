<?php
namespace libraries;
use model\Member;
use model\MemberLogin;
use model\AgentLogin;
use model\Agent;
use Lang;

class User {

    const LOGIN_SUCCESS = 'login-success';
    const LOGIN_FAIL = 'login-fail';
    const LOGIN_WRONG = 'login-wrong';
    const LOGIN_DISABLED = 'account-disabled';


    protected static $sid = null;
    protected static $user_data = null; /* Agent or Member row data */
    protected static $user = array(
        'id' => null, /* user id */
        'no' => null, /* user no */
        'account' => null, /* user account */
        'name' => null, /* user name */
        'type'  => null, /* user account type : A => Agent, M => member ..... */
        'bank' => null, /* bank account */
        'cell' => null, /* cell phone number */
        'email' => null, /* email */
        'qrcode' => null, /* qrcode url */
        'parent_agent' => null, /* array LV ~ LV5 */
        'parent_member' => null, /* member MLV1 ~ MLV3 */
        'point' => 0,           /* 可用購物金 (member) */
        'black' => null,       /* 是否為黑名單 */

    );
    protected static $user_code = null;
    protected static $user_type = null;
    protected static $fail_message = null;
    protected static $log_tables = array(
        'A' => array('table' => 'agent_login', 'affix' => 'agl'),
        'M' => array('table' => 'member_login', 'affix' => 'mem'),
    );

    public static function loginAgent($account, $password) 
    {
        $user = Agent::findUser($account);

        if ($user) {

            /* 密碼錯誤 */
            if ($user->age005 !== $password) {

                static::$fail_message = Lang::get('login.error');

                $user->age015 += 1;
                $user->save(false);

                return self::LOGIN_WRONG;

            }
            $result = static::setAgentUser($user);
            if ($result !== self::LOGIN_SUCCESS) return $result;

            static::$sid = static::createSID(
                static::$user_code, 
                $user->age001, 
                static::$user_type
            );

            AgentLogin::saveLog($user->age001, static::sid(), static::ip());

            return self::LOGIN_SUCCESS;

        } else { /* 查無帳號 or 密碼 */

            static::loginFail();

            static::$fail_message = Lang::get('login.error');

            return self::LOGIN_WRONG;

        }

    }

    protected static function setAgentUser($user) 
    {

        static::$user_data = $user;

        static::$user_code = 'usa';

        static::$user_type = 'A';

        /* 停、啟用 (除帳？) */   
        if ($user->age016) { 

            static::$fail_message = Lang::get('login.disabled');

            return self::LOGIN_DISABLED;

        }

        $parent_agent = array(
            $user->age018, /* LV1 */
            $user->age019, /* LV2 */
        );

        static::$user = array(
            'id' => $user->age001,
            'type' => $user->age002,
            'no' => $user->age003,
            'account' => $user->age004,
            'name' => $user->age006,
            'bank_account' => $user->age011,
            'bank_code' => $user->age021,
            'cell' => $user->age012,
            'email' => $user->age013,
            'parent_agent' => $parent_agent,
        );
        return self::LOGIN_SUCCESS;
    }

    public static function loginMember($phone, $password)
    {
        $user = Member::find_by_mem011($phone) ?: null;

        if ($user) {

            if ($user->mem004 !== $password) {

                static::$fail_message = Lang::get('login.error');

                $user->mem013 += 1;

                $user->save(false);

                return false;

            }

            if (! static::setMemberUser($user)) return false;

            static::$sid = static::createSID(
                static::$user_code, 
                $user->mem001, 
                static::$user_type
            );

            MemberLogin::saveLog($user->mem001, static::sid(), static::ip());

            return true;

        } else { /* 查無帳號 or 密碼 */

            static::loginFail();

            static::$fail_message = Lang::get('login.error');

            return false;

        }
    }

    protected static function setMemberUser($user) 
    {
        static::$user_code = 'usm';

        static::$user_type = 'M';

        static::$user_data = $user;

        /* 停、啟用 (除帳？) */   
        if ($user->mem014) {

            static::$fail_message = Lang::get('login.disabled');
            return false;

        } 

        $parent_agent = array(
            $user->mem016, /* LV1 */
            $user->mem017, /* LV2 */
        );

        $parent_member = array(
            $user->mem018, /* MLV1 */
            $user->mem019, /* MLV2 */
            $user->mem020, /* MLV3 */
        );

        static::$user = array(
            'id' => $user->mem001,
            'type' => 'M',
            'no' => $user->mem002,
            'account' => $user->mem003,
            'name' => $user->mem005,
            'bank' => $user->mem010,
            'cell' => $user->mem011,
            'email' => $user->mem012,
            'parent_agent' => $parent_agent,
            'parent_member' => $parent_member,
            'point' => $user->mem021,
            'black' => $user->mem023 ? true : false,
        );
        return true;
    }


    public static function logout() 
    {
        $id = static::get('id');
        if (static::get('type') == 'M') {
            $row = MemberLogin::find_by_mel001($id);
            if ($row) {
                $row->mel003 = '';
                $row->save();
            }
        } else {
            $row = AgentLogin::find_by_agl001($id);
            if ($row) {
                $row->agl003 = '';
                $row->save();
            }
        }
    }

    public static function getFailMessage()
    {
        return static::$fail_message;
    }

    public static function isAgent() 
    {
        // return static::
    }

    /* 即將棄用 @data(), 改用 @get() 較直覺, */
    public static function data() 
    {
        return static::$user_data;
    }
    public static function get($key = null) 
    {
        return $key === null 
            ? static::$user 
            : (isset(static::$user[$key]) ? static::$user [$key] : null);

    }
    public static function ip()
    {
        return ! empty($_SERVER["HTTP_X_FORWARDED_FOR"])
            ? $_SERVER["HTTP_X_FORWARDED_FOR"]
            : (! empty($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : 'location');
    }
    public static function sid() 
    {
        return static::$sid;
    }
    public static function loginFail()
    {
        static::$user = null;
    }
    protected static function createSID($wcode, $uid, $utp, $sidlen = 8){
        $debug = false;
        $wlen = strlen($wcode);
        $ilen = strlen($uid);
        // $llen = strlen($ulv);
        $tlen = strlen($utp);
        $aryRND = array();
        //計算需要產生的SID長度
        // $sidlen = $sidlen-($wlen+$ilen+$llen-4);
        $sidlen = $sidlen-($wlen+$ilen-4);
        $strTmp1 = '';
        $strTmp2 = '';
        for($i=0; $i<$sidlen; $i++){
            $rand1 = rand(1,9);
            $rand2 = rand(1,9);
            $strTmp1 = $strTmp1.$rand1;
            $strTmp2 = $strTmp2.$rand2;
            if(strlen($strTmp1)+strlen($strTmp2) >= $sidlen){ break; }
        }
        $intTmp1 = ((real)$strTmp1);
        $intTmp2 = ((real)$strTmp2);
        $strTmp2 = static::chgASCIIToEng($intTmp2);
        $intTmp3 = abs($intTmp1-$intTmp2);
        $strTmp3 = $intTmp3;
        if(strlen($intTmp3)>4){ $strTmp3 = substr($intTmp3,-4); }
        if(strlen($intTmp3)<4){ $strTmp3 = str_pad($intTmp3,4,"0",STR_PAD_LEFT); }
        if($debug){
            echo '['.$intTmp1.']-['.$intTmp2.'] = ';
            echo 'ABS(['.$intTmp3.'])<br>';
            echo '4 char : ['.$strTmp3.']<br>['.$strTmp2.']<br>';
        }

        // $intTmp0 = ($wlen+$ilen+$llen+$tlen);
        $intTmp0 = ($wlen+$ilen+$tlen);

        // $SID = $intTmp0. static::BlendEngNum($intTmp1,$strTmp2).$strTmp3.$wcode.$utp.$ulv.$uid;
        $SID = $intTmp0. static::BlendEngNum($intTmp1,$strTmp2).$strTmp3.$wcode.$utp.$uid;
        if($debug){ echo $SID."<br>"; }
        $SID = static::MixSID(strtoupper($SID));
        if($debug){ echo '[SID-'.strlen($SID).'--'.$SID.']<br>'; }
        return $SID;
    }

    //比對 SID
    public static function isLogin($SID = null){
        $debug = false;
        if (static::$user['id']) return true;
        
        if($debug){ echo "========== chkLogin_SID --- SID : ".$SID." ---==========<br /> \n"; }
        $arySIDinfo = static::DismantSID($SID);
        if($arySIDinfo==false){ return false; }
        $intTmp = $arySIDinfo['vft_n'][0] - $arySIDinfo['vft_n'][1];
        $intTmp = substr(abs($intTmp),-4);
        if($debug){ echo "VFT [".$intTmp."]==[".$arySIDinfo['vft_r']."]<br /> \n <br /> \n"; }
        if(((string)$intTmp)!=((string)$arySIDinfo['vft_r'])){
            if($debug){ echo "========== END Return ==========<br /> \n"; }
            return false;
        }
        $table = static::$log_tables[$arySIDinfo['utp']]['table'];
        $affix = static::$log_tables[$arySIDinfo['utp']]['affix'];

        // $sql = "SELECT COUNT(1) FROM {$table} "
        //     . " WHERE {$affix}001 = :id AND {$affix}003 = :sid";
        // $query = DB::prepare($sql);
        // $query->bindValue(':id', $arySIDinfo['uid']);
        // $query->bindValue(':sid', $SID);
        // $row = $query->first();
        static::$sid = $SID;
        switch ($arySIDinfo['utp']) {
            case 'A':
                $user = Agent::find_by_age001($arySIDinfo['uid']) ?: false;
                $log = AgentLogin::find_by_agl003($SID);
                if ($user && $log) {
                    return static::setAgentUser($user);
                }
                static::$fail_message = Lang::get('login.timeout');
                return static::LOGIN_FAIL;
            case 'M':
                $user = Member::find_by_mem001($arySIDinfo['uid']) ?: false;
                $log = MemberLogin::find_by_mel003($SID);
                if ($user && $log) {
                    return static::setMemberUser($user);
                }
                static::$fail_message = Lang::get('login.timeout');
                return false;
        }
        return false;

    }

    protected static function MixSID($SID){
        $intrnd = rand(2,7);
        $strTmp = substr($SID,($intrnd*-1));
        $lenSID = strlen($SID);
        $SID = substr($SID,0,($lenSID-$intrnd));
        $ary = array();
        for($i=0; $i<$intrnd; $i++){
            $strTmp2 = substr($strTmp,(($i+1)*-1),1);
            array_push($ary,$strTmp2);
        }
        $NSID = implode('',$ary).$SID.$intrnd;
        return $NSID;
    }

    //拆解SID
    /*
        輸入:
            $SID
        輸出:
            false 錯誤
            
            拆解出來的 資料陣列 
            array = (
                [uid] => 使用者編號
                [ulv] => 使用者層級          
                [utp] => 使用者類別
                [website] => 站台編號
                [vft_r] => array( [0]=>驗證碼 A, [1]=>驗證碼 B )
                [vft_n] => 驗證碼 二
            )
            備註： ( 絕對值 (驗證碼 A - 驗證碼 B) )後四碼 等同於 驗證碼 二 即認為通過
    */
    /**
     * 拆解SID
     * @param [type] $SID [description]
     */
    protected static function DismantSID($SID){
        $arySIDinfo = array();
        $debug = false;
        if($debug){ echo "<hr>".$SID."<br /> \n"; }
        $intTmp0 = substr($SID,-1); 
        if(preg_match("/[^0-9]/", $intTmp0)){ return false; }   
        $aryTmp = array();  
        $strTmp0 = substr($SID,0,$intTmp0);
        $strlen = strlen($strTmp0);
        for($i=0; $i<$strlen; $i++){
            $sTmp = substr($strTmp0,(($i+1)*-1),1);
            array_push($aryTmp,$sTmp);
        }
        $strTmp0 = implode('',$aryTmp);
        $strTmp1 = substr($SID,$intTmp0,(strlen($SID)-($intTmp0+1)));
        $SID = $strTmp1.$strTmp0;
        if($debug){ echo $SID."<br /> \n"; }

        $intTmp1 = substr($SID,0,1);
        $strTmp2 = substr($SID,($intTmp1*-1));
        $arySIDinfo['website'] = strtolower(substr($strTmp2,0,3));
        $arySIDinfo['utp'] = substr($strTmp2,3,1);
        // $arySIDinfo['ulv'] = substr($strTmp2,4,1);
        // $arySIDinfo['uid'] = substr($strTmp2,5);
        $arySIDinfo['uid'] = substr($strTmp2,4);
        $SID = substr($SID,1,(strlen($SID)-$intTmp1-1));

        if($debug){ echo $SID."<br /> \n"; }
        $arySIDinfo['vft_r'] = substr($SID,-4);
        $arySIDinfo['vft_n'] = static::DismantEngNum(substr($SID,0,(strlen($SID)-4)));
        $arySIDinfo['vft_n'][0] = static::chgEngToASCII($arySIDinfo['vft_n'][0]);

        if($debug){ echo "<pre>"; print_r($arySIDinfo); echo "</pre>"; }
        return $arySIDinfo;
    }

    //拆解英數混合
    protected static function DismantEngNum($engnum){
        $ary1 = array();
        $ary2 = array();
        $len = (strlen($engnum)/2);
        for($i=0; $i<$len; $i++){
            $strTmp = substr($engnum,($i*2),2);
            array_push($ary1,substr($strTmp,0,1));
            array_push($ary2,substr($strTmp,1,1));
        }
        $ary = array(implode('',$ary1),implode('',$ary2));
        return $ary;
    }

    //混編英數
    protected static function BlendEngNum($num,$eng){
        $ary = array();
        $len = strlen($num);
        for($i=0; $i<$len; $i++){
            $str1 = substr($num,$i,1);
            $str2 = substr($eng,$i,1);
            array_push($ary, $str2.$str1);
        }
        return implode('',$ary);
    }

    //從英文轉成ASCII碼
    protected static function chgEngToASCII($eng){
        $ary = array();
        $len = strlen($eng);
        for($i=0; $i<$len; $i++){
            $tmp = substr($eng,$i,1);
            array_push($ary, ((ord($tmp))-64));
        }
        return implode($ary);
    }

    //從ASCII碼轉成英文
    protected static function chgASCIIToEng($ascii){
        $ary = array();
        $len = strlen($ascii);
        for($i=0; $i<$len; $i++){
            $tmp = substr($ascii,$i,1);
            array_push($ary, (chr(($tmp+64))));
        }
        return implode($ary);
    }
}