<?php
use model\LogOrder;
class c9922 {

    public function run() 
    {
        $lid = Input::post('lid') ?: 0;
        $log = LogOrder::find_by_lod001($lid);
        $rows = $log ? $log->content() : array();
        return array(
            'page' => 1,
            'rows' => $rows,
            'total' => 1,
        );
    }
}