<?php
use model\LogError;
class c9980 {

    public function run() 
    {
        
        $result = LogError::all($this->options());

        $rows = array();
        $columns = array('id', 'time', 'path', 'type', 'caption');

        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $user = $row->ler004 ? json_decode($row->ler004) : null;
            $tmp['user'] = $user ? $user->name : '未登入使用者';
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => LogError::count($this->options(true)),
        );
        

    }

    public function page() 
    {
        /* 目前頁數 */
        return intval(Input::post('page')) ?: 1;
    }
    public function rp() 
    {
        /* 每頁筆數 */
        return intval(Input::post('rp')) ?: 10;
    }

    public function options($is_count = false) 
    {
        $options = array(
            'conditions' => array('1') 
        );
        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'ler001 DESC';
        }
        return $options;
    }


}