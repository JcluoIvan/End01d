<?php
use model\Product;
use model\Agent;
class c202 {

    public function run() {

        $no = Input::post('no');

        $row = $this->findRAgent($no);

        if ($row) {

            return array(
                'status' => true,
                'l_agent' => $row->age018,
                'r_agent' => $row->age001,
                'r_agent_rows' => Agent::getRAgentList($row->age018),
            );
        } 

        return array(
            'status' => false,
            'message' => '查無此展示中心'
        );
    }

    public function findRAgent($no) {
        $row = Agent::find_by_age003($no);
        return $row && intval($row->age016) === 0 && $row->age002 === 'R'
            ? $row
            : null;
    }


}