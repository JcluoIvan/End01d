<?php
use model\Video;

/* 取得商品的影片清單 */
class w303 {

    public function run() 
    {

        $rows = array_map(function($row) {
            return array(
                'id' => $row->vdo001,
                'title' => $row->vdo003,
                'no' => $row->vdo004,
                'pid' => $row->vdo002,
                'pname' => $row->pdm004,
            );
        }, Video::all($this->options()));

        return array(
            'status' => true,
            'message' => '',
            'rows' => $rows,
            'sql' => $this->options(true),
            'cc' => Video::count($this->options(true)),
            'total' => Video::count($this->options(true))
        );


    }
    public function rp()
    {
        return 10;
    }
    public function options($is_count = false) {


        $options = array(
            'joins' => 'LEFT JOIN product_manager ON (pdm001 = vdo002)',
            'conditions' => array(
                "pdm007 = 1 AND vdo004 != '' ",
            ),

        );
        // if ($lid = Input::post('last_sort')) {
        //     $options['conditions'] = array(
        //         "pdm007 = 1 AND vdo004 != '' AND pdm014 > ?",
        //         $lid
        //     );
        // }
        if (! $is_count) {
            $options['select'] = 'vdo001, vdo002, vdo003, vdo004, pdm004';
            $options['limit'] = $this->rp();
            $options['offset'] = Input::post('count');
            $options['order'] = 'pdm014, vdo001';
        }
        return $options;


    }
    public function options_old($is_count = false) 
    {
        $options = array(
            'conditions' => array(
                "pdm007 = 1 AND pdm008 != '' ",
            ),
        );
        if ($lid = Input::post('last_sort')) {
            $options['conditions'] = array(
                "pdm007 = 1 AND pdm008 != '' AND pdm014 > ?",
                $lid
            );
        }

        if (! $is_count) {
            $options['offset'] = Input::post('count');
            $options['limit'] = $this->rp();
            $options['order'] = 'pdm014, vdo001';
        }
        return $options;

    }

}