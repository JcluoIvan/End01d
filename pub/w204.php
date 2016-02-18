<?php
// 修改會員

use model\Agent;
use model\Member;

// echo "<pre>";
// var_dump($_POST);

// 修改
// db mem007 生日 預設 1991-01-01
// 回饋% 預設值

// 判斷
// 是否有此雷達站 或 會員
// utp 為雷達站 或 會員
// 修改時手機是否一樣
// 密碼 名稱 手機 == ""
// 產生QRcode是否成功


class w204 {

    public function run()
    {
        // 上層pid
        $pid = Input::post('pid');

        $utp = Input::post('utp');
        
        // 修改的id (若沒有id則為新增)
        $mid = Input::post('mid');

        // 新增時所需的參數
        $password = Input::post('password');
        $name = Input::post('name');
        $born = Input::post('born') ?: '1991-01-01';
        $city = Input::post('city') ?: '';
        $address = Input::post('address') ?: '';
        $bank = Input::post('bank') ?: '';
        $phone = Input::post('phone');
        $email = Input::post('email') ?: '';
        $bankAccount = Input::post('bankAccount') ?: null;

        // test
        // $mid = 7;
        // $name = 'mid007';
        // $born = '1990-05-05';
        // $city = '台中';
        // $address = '東興路';
        // $email = 'mid007@endold.net';
        // $bank = 'm007';


        if ($utp == 'A') {
            $parent  = Agent::find_by_age001($pid) ?: new Agent;
            $lv1 = $parent->age018 ?: 0;
            $lv2 = $parent->age001 ?: 0;
            $mlv1 = 0;
            $mlv2 = 0;
            $mlv3 = 0;
        } else {
            $parent = Member::find_by_mem001($pid) ?: new Member;
            $lv1 = $parent->mem016 ?: 0;
            $lv2 = $parent->mem017 ?: 0;
            $mlv1 = $parent->mem019 ?: 0;
            $mlv2 = $parent->mem020 ?: 0;
            $mlv3 = $parent->mem001 ?: 0;
        }
        $codeId = Member::createQRCodeID() ?: null;
        $member = Member::find_by_mem001($mid)
            ?: Member::createMemberNo($parent->age003);

        $member->mem002 = $member->mem002 ?: $phone; // no
        $member->mem003 = ""; // acc
        $member->mem004 = $member->mem004 ?: $password;
        $member->mem005 = $name;
        $member->mem007 = $born;
        $member->mem008 = $city;
        $member->mem009 = $address;
        $member->mem010 = $bank;
        $member->mem011 = $member->mem011 ?: $phone;
        $member->mem012 = $email;
        $member->mem013 = $member->mem013 ?: 0; // loging error num
        $member->mem014 = $member->mem014 ?: 0; // isDisable
        $member->mem015 = $member->mem015 ?: 20; // 回饋%
        $member->mem016 = $member->mem016 ?: $lv1;
        $member->mem017 = $member->mem017 ?: $lv2;
        $member->mem018 = $member->mem018 ?: $mlv1;
        $member->mem019 = $member->mem019 ?: $mlv2;
        $member->mem020 = $member->mem020 ?: $mlv3;
        $member->mem027 = $bankAccount ?: null; //銀行名稱 
        $member->mem028 = $member->mem028 ?: $codeId; //QRCodeID

        // $attr = array_keys($member->attributes());
        // foreach ($attr as $key) {
        //     if ($key === 'mem001') continue;
        //     $member->$key = $member->$key ?: '';
        // }

        $result = $member->save();

        if ($result && $member->createQRCode()) {
            return array(
                'status' => true,
                'message' => ''
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Error'
            );
        }


    }
}