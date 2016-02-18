<?php
use model\LogAgent;
class c9901 {

    public function run() 
    {
        
        $result = LogAgent::with(
                LogAgent::find('all', $this->options()),
                array('agent', 'editor')
            );

        $rows = array();
        $columns = array('id', 'title', 'notice_for', 'time');
        if (Input::post('type') !== 'app') $columns[] = 'content';

        $columns = array('id', 'ip', 'datetime');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['action'] = $row->action();
            $tmp['account'] = $row->agent ? $row->agent->age004 : 'unknown';
            $tmp['name'] = $row->agent ? $row->agent->age006 : 'unknown';
            $tmp['editor'] = $row->editor ? $row->editor->age006 : 'unknown';
            $tmp['list'] = $row->agent ? $row->agent->age001 : 0;
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => LogAgent::count($this->options(true)),
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
            'conditions' => array('lag003 = ?',  Input::post('aid', 0)) 
        );
        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'lag007 DESC';
        }
        return $options;
    }


}