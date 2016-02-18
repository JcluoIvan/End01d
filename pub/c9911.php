<?php
use model\LogMember;
class c9911 {

    public function run() 
    {
        $result = LogMember::with(
                LogMember::find('all', $this->options()),
                array('member', 'editor')
            );

        $rows = array();
        $columns = array('id', 'title', 'notice_for', 'time');
        if (Input::post('type') !== 'app') $columns[] = 'content';

        $columns = array('id', 'ip', 'datetime');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['action'] = $row->action();
            $tmp['phone'] = $row->member ? $row->member->mem011 : 'unknown';
            $tmp['name'] = $row->member ? $row->member->mem005 : 'unknown';
            $tmp['editor'] = $row->editor ? $row->editor->age006 : 'unknown';
            $tmp['list'] = $row->member ? $row->member->mem001 : 0;
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => LogMember::count($this->options(true)),
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
            'conditions' => array('lmb003 = ?',  Input::post('mid', 0)) 
        );
        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'lmb007 DESC';
        }
        return $options;
    }


}