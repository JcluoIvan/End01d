<?php
use model\LogMember;
class c9912 {

    public function run() 
    {
        $lid = Input::post('lid') ?: 0;
        $log = LogMember::find_by_lmb001($lid);
        $rows = $log ? $log->content() : array();
        return array(
            'page' => 1,
            'rows' => $rows,
            'total' => 1,
        );
    }
}