<?php
use model\Member;

/**
 * 會員個資修改
 */

class w205 {

    public function run()
    {
        $member = User::data();
        // $member = Member::find_by_mem001(User::get('id'));
    
        // $member->mem005 = Input::post('name');
        // $member->mem007 = Input::post('born');
        $member->mem008 = Input::post('city');
        $member->mem009 = Input::post('address');
        $member->mem010 = Input::post('bank_account');
        $member->mem027 = Input::post('bank_code');
        $member->mem012 = Input::post('email');

        if ($member->save()) {
            return array(
                'status' => true,
                'message' => '資料更新成功',
                'user' => $member->loginMemberData()
            );
        }

        return array(
            'status' => false,
            'message' => '資料更新失敗',
        );
    }
}