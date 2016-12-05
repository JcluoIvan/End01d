<?php
use model\Member;
use model\Setting;

/* membe 登入 */
class w0 extends pub\GatewayApi{

    public function run()
    {
        $sid = Input::post('sid');
        $phone = Input::post('phone');
        $password = Input::post('password');
        $result = false;


        if (empty($sid) && empty($phone)) return $this->fail('請輸入手機號碼');
        if (empty($sid) && empty($password)) return $this->fail('請輸入密碼');

        ($phone && $password) && ($result = User::loginMember($phone, $password));
        ($sid) && ($result = User::isLogin($sid));

        if ($result) {

            $member = Member::find_by_mem001(User::get('id'));
            $user = $member->loginMemberData();
            $user['no'] = $user['code'];
            return array(
                'status' => true,
                'user' => $user,
                'fare_lower_limit' => intval(Setting::value('FareLowerLimit')),
                // 'lang' => Lang::get(),
            );
        }
        return $this->fail(User::getFailMessage() ?: '登入失敗');

    }

}