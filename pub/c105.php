<?php
// 會員新增修改

use model\Member;
use model\Agent;

// 修改
// 設定無法修改
// 回饋% 預設值

/*
驗證
    密碼與確認密碼
    手機
    雷達站
*/

class c105 extends pub\GatewayApi{

    public function run() {
        // 上層pid
        $pid = Input::post('pid') ?: null;

        // 修改的id (若沒有id則為新增)
        $id = Input::post('id') ?: null;

        $parent = Agent::find_by_age001($pid) ?: new Agent;

        if (empty($parent->age001)) {
            return $this->fail(Lang::get('page01.validator.mem017'));
        }

        /* 設定會員資料 */
        $member = Member::find_by_mem001($id) ?: new Member;
        $member = $this->setMemData($member, $parent);

        /* 驗證 */
        $member->validates();

        if (empty($member->mem001)) {
            $member = $this->setMemData(
                Member::createMemberNo($parent->age001, $parent->age003),
                $parent
            );
        }
        
        if ($member->save()) {
            return $this->success();
        } else {
            return $this->fail(Lang::get('save.fail'));
        }
    }

    /* 邀請碼於 createQRCode 時產生 */
    /* qrocde 產生在 Member->afterSave() 產生 */
    public function setMemData($member, $parent) {

        /* 新建立的會員才能修改的欄位 */
        if (empty($member->mem003)) {
            $phone = Input::post('phone');
            $member->mem003 = $phone; // acc
            $member->mem005 = Input::post('name');
            $member->mem011 = $phone;
        }
        $member->mem002 = $member->mem002 ?: 0; // no

        if (trim(Input::post('password'))) {
            $member->mem004 = trim(Input::post('password'));
        }

        $member->mem007 = Input::post('born') ?: '';
        $member->mem008 = Input::post('city') ?: '';
        $member->mem009 = Input::post('address') ?: '';
        $member->mem012 = Input::post('email') ?: '';
        $member->mem013 = $member->mem013 ?: 0; // loging error num
        $member->mem014 = $member->mem014 ?: 0; // isDisable
        $member->mem015 = $member->mem015 ?: 20; // 回饋%
        $member->mem016 = $member->mem016 ?: $parent->age018; // lv1
        $member->mem017 = $member->mem017 ?: $parent->age001; // lv2
        $member->mem018 = $member->mem018 ?: 0; // mlv1
        $member->mem019 = $member->mem019 ?: 0; // mlv2
        $member->mem020 = $member->mem020 ?: 0; // mlv3

        $member->addValidate('[name=password2]', 'mem004', function($value) use($member) {
            return (Input::post('password') !== Input::post('password2'))
                ? '兩次輸入的密碼不相同' : true;
        });

        return $member;
    }
}