<?php

use model\Agent;
// 主管 會計 廠務 客服 新增修改

/*
驗證
    帳號
    密碼與確認密碼
    手機

*/

class c101 {

    public function run() {

        $id = Input::post('id') ?: 0;
        $utp = Input::post('utp');

        $agent = Agent::find_by_age001($id) ?: new Agent;
        $agent->age002 = $utp;
        $agent->age003 = $agent->age003 ?: Input::post('account');
        $agent->age004 = $agent->age004 ?: Input::post('account');
        $agent->age005 = Input::post('password');
        $agent->age006 = Input::post('name');
        $agent->age012 = Input::post('phone');
        $agent->age013 = Input::post('email');
        $agent->age016 = $agent->age006 ?: 0;
        $agent->age017 = 0;

        $result = $agent->save();

        return array(
            'status' => ($result ? true : false),
            'message' => $agent->getError() 
                ?: ($result 
                    ? Lang::get('save.success') 
                    : Lang::get('save.fail')
                ),
        );


    }
}