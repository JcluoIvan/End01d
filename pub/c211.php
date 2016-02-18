<?php
use model\Product;
use model\Agent;
class c211 {

    public function run() {

        $lid = Input::post('lid');
        $rows = Agent::getRAgentList($lid);

        return array(
            'status' => true,
            'rows' => $rows,
        );
    }


}