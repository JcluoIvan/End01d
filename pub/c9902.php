<?php
use model\LogAgent;
class c9902 {

    public function run() 
    {
        $lid = Input::post('lid') ?: 0;
        $log = LogAgent::find_by_lag001($lid);
        $rows = $log ? $log->content() : array();
        return array(
            'page' => 1,
            'rows' => $rows,
            'total' => 1,
        );
    }
}