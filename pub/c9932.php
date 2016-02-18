<?php
use model\LogProduct;
class c9932 {

    public function run() 
    {
        $lid = Input::post('lid') ?: 0;
        $log = LogProduct::find_by_lpd001($lid);
        $rows = $log ? $log->content() : array();
        return array(
            'page' => 1,
            'rows' => $rows,
            'total' => 1,
        );
    }
}