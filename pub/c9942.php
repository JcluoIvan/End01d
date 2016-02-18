<?php
use model\LogPurchase;
class c9942 {

    public function run() 
    {
        $lid = Input::post('lid') ?: 0;
        $log = LogPurchase::find_by_lpc001($lid);
        $rows = $log ? $log->content() : array();
        return array(
            'page' => 1,
            'rows' => $rows,
            'total' => 1,
        );
    }
}