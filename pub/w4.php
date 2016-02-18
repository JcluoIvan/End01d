<?php
use model\Bank;

/* 銀行代號 */
class w4 {

    public function run() 
    {
        
        $result = Bank::all();
        $rows = array();
        foreach ($result as $row) {
            $rows[] = array(
                'code' => $row->ban001,
                'name' => "{$row->ban001} - {$row->ban002}"
            );
        }

        return array(
            'status' => true,
            'bank' => $rows,
        );

    }

}