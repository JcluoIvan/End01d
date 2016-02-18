<?php
use model\LogProduct;
class c9930 {

    public function run() 
    {
        
        $result = LogProduct::with(
                LogProduct::find('all', $this->options()),
                array('product', 'editor')
            );

        $rows = array();
        $columns = array('id', 'ip', 'datetime');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['action'] = $row->action();
            $tmp['content'] = $row->lpd004 == LogProduct::ACTION_STATUS 
                ? $row->content() : 'view';
            $tmp['name'] = $row->product ? $row->product->pdm004 : 'unknown';
            $tmp['pid'] = $row->product ? $row->product->pdm001 : 0;
            $tmp['editor'] = $row->editor ? $row->editor->age006 : 'unknown';
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => LogProduct::count($this->options(true)),
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
            'conditions' => array('1', ) 
        );
        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'lpd007 DESC';
        }
        return $options;
    }


}