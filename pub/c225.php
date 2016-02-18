<?php
use model\Video;

# video list 
class c225 extends pub\GatewayApi{
    public function run()
    {
        $rows = array_map(function($row) {
            return $row->attributes(true);
        }, Video::all($this->options()));
        return array(
            'rows' => $rows,
            'page' => $this->page(),
            'total' => Video::count($this->options(true)),
        );
    }
    public function options($is_count = false) {
        $pid = Input::post('pid');
        $options = array(
            'conditions' => array('vdo002 = ?', $pid)
        );

        if (! $is_count) {
            $rp = $this->rp();
            $page = $this->page();
            $options['limit'] = $rp;
            $options['offset'] = ($page - 1) * $rp;
            $options['order'] = 'vdo001';
        }
        return $options;

    }
}