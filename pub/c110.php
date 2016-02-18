<?php
// 公開 or 關閉 店家可見狀態

use model\Agent;

class c110 extends pub\GatewayApi{

    public function run() 
    {
        $id = Input::post('id') ?: 0;
        $public = Input::post('is_public') ? 1 : 0;
        $option = array(
            'conditions' => array('age001 = ?', $id)
        );
        $agent = Agent::find('first', $option) ?: '';
        
        if (! $agent) {
            return $this->fail(Lang::get('save.fail'));
        }

        $agent->age024 = $public;

        if ($agent->save()) {
            return $this->success();
        } else {
            return $this->fail(Lang::get('save.fail'));
        }


    }
}