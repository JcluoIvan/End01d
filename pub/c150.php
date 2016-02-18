<?php
// 開放、鎖定 旗下會員瀏覽店家的權限

use model\Agent;

class c150 extends pub\GatewayApi{

    public function run() 
    {
        $id = Input::post('id') ?: 0;
        $locked = Input::post('is_locked') ? 1 : 0;
        $option = array(
            'conditions' => array('age001 = ?', $id)
        );
        $agent = Agent::find('first', $option) ?: '';
        
        if (! $agent) {
            return $this->fail(Lang::get('save.fail'));
        }

        $agent->age025 = $locked;

        if ($agent->save()) {
            return $this->success();
        } else {
            return $this->fail(Lang::get('save.fail'));
        }


    }
}