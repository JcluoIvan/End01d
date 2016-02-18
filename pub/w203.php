<?php
// 註冊會員

use model\Agent;
use model\Member;
use model\MemberPointRecord;

class w203 {

    public function run()
    {
        // 上層pid
        $pid = Input::post('pid');

        $utp = Input::post('utp');

        $parentData = array();

        if ($utp == 'A') {
            $parent  = Agent::find_by_age001($pid) ?: new Agent;
            $parentData['lv1'] = $parent->age018 ?: 0;
            $parentData['lv2'] = $parent->age001 ?: 0;
            $parentData['mlv1'] = 0;
            $parentData['mlv2'] = 0;
            $parentData['mlv3'] = 0;
            $parentData['id'] = $parent->age001;
            $parentData['no'] = $parent->age003;
        } else {
            $parent = Member::find_by_mem001($pid) ?: new Member;
            $parentData['lv1'] = $parent->mem016 ?: 0;
            $parentData['lv2'] = $parent->mem017 ?: 0;
            $parentData['mlv1'] = $parent->mem019 ?: 0;
            $parentData['mlv2'] = $parent->mem020 ?: 0;
            $parentData['mlv3'] = $parent->mem001 ?: 0;
            $agent = Agent::find_by_age001($parent->mem017) ?: new Agent;
            $parentData['id'] = $agent->age001;
            $parentData['no'] = $agent->age003;
        }
        /* 設定會員資料 */
        $member = $this->setMemData(new Member, $parentData);

        $member->addValidate('[name=password2]', 'mem004', function($value) use ($member) {
            return (Input::post('password2') === $value)
                ? true
                : '兩次密碼不相同';
        });


        $member->addValidate('#born-year', 'mem007', function($value) use ($member) {
            return $member->dateFormat('mem007') ? true : '請選擇生日「年」';
        });
        $member->addValidate('#born-month', 'mem007', function($value) use ($member) {
            return $member->dateFormat('mem007') ? true : '請選擇生日「月」';
        });

        $member->addValidate('#born-date', 'mem007', function($value) use ($member) {
            return $member->dateFormat('mem007') ? true : '請選擇生日「日」';
        });
        /* 驗證 */
        $member->validates();

        $member = Member::createMemberNo($parentData['id'], $parentData['no']);

        if (!$member) {
            return array(
                'status' => false,
                'message' => Lang::get('error'),
            );
        }

        $member = $this->setMemData($member, $parentData);


        // $member->addValidate('#born-year', 'mem007', function($value) use ($row) {
        //     return '請選擇生日';
        // });
        // $member->addValidate('#born-month', 'mem007', function($value) use ($row) {
        //     return date($value) ? true : '請選擇生日';
        // });

        // $member->addValidate('#born-date', 'mem007', function($value) use ($row) {
        //     return date($value) ? true : '請選擇生日';
        // });

        if ($member->save()) {

            $point = new MemberPointRecord;

            $point->mpr002 = $member->mem001;
            $point->mpr003 = MemberPointRecord::TYPE_REGISTER;
            $point->mpr004 = 0;
            $point->mpr005 = 500;
            $result = $point->save();
            
            return $result ?
                array('status' => true, 'message' => '註冊成功') :
                array(
                    'status' => false, 
                    'message' => '會員新增成功, 但您的購物金建立失敗, ' .
                                '請聯絡服務人員幫您處理'
                );
        } else {
            return array(
                'status' => false,
                'message' => '註冊失敗'
            );
        }



        if ($result) {
            return array(
                'status' => true,
                'message' => ''
            );
        } else {
        }
    }

        /* 邀請碼於 createQRCode 時產生 */
    /* qrocde 產生在 Member->afterSave() 產生 */
    public function setMemData($member, $parent) {

        $password = Input::post('password');
        $name = Input::post('name');
        $phone = Input::post('phone');

        $born = Input::post('born') ?: null;
        $city = Input::post('city') ?: '';
        $address = Input::post('address') ?: '';
        $bank_account = Input::post('bank_account') ?: null;
        $email = Input::post('email') ?: '';
        $bank_code = Input::post('bank_code') ?: '';

        $member->mem002 = $member->mem002 ?: 0; // no
        $member->mem003 = $member->mem011 ?: $phone; // acc
        $member->mem004 = $password ?: $member->mem004;
        $member->mem005 = $name ?: $member->mem005;
        $member->mem007 = $born ?: '';
        $member->mem008 = $city ?: '';
        $member->mem009 = $address ?: '';
        $member->mem010 = $bank_account ?: '';
        $member->mem011 = $member->mem011 ?: $phone;
        $member->mem012 = $email ?: '';
        $member->mem013 = $member->mem013 ?: 0; // loging error num
        $member->mem014 = $member->mem014 ?: 0; // isDisable
        $member->mem015 = $member->mem015 ?: 20; // 回饋%
        $member->mem016 = $member->mem016 ?: $parent['lv1']; // lv1
        $member->mem017 = $member->mem017 ?: $parent['lv2']; // lv2
        $member->mem018 = $member->mem018 ?: $parent['mlv1']; // mlv1
        $member->mem019 = $member->mem019 ?: $parent['mlv2']; // mlv2
        $member->mem020 = $member->mem020 ?: $parent['mlv3']; // mlv3
        $member->mem027 = $bank_code ?: null; //銀行名稱

        return $member;
    }
}