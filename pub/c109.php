<?php
// 主管 會計 廠務 客服 清單

use model\Agent;

class c109 extends pub\GatewayApi{

    public function run() 
    {
        $id = Input::post('id') ?: 0;
        $option = array(
            'conditions' => array('age001 = ?', $id)
        );
        $agent = Agent::find('first', $option) ?: '';
        
        if (! $agent) {
            return $this->fail(Lang::get('save.fail'));
        }

        $agent->age016 = $agent->age016 ? 0 : 1;

        if ($agent->save()) {
            return $this->success();
        } else {
            return $this->fail(Lang::get('save.fail'));
        }


    }
}