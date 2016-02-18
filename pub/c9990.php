<?php
use model\Setting;
class c9990 {

    public function run() 
    {
        
        $result = Setting::find('all', $this->options());

        $rows = array();
        $columns = array('id', 'title', 'notice_for', 'time');
        if (Input::post('type') !== 'app') $columns[] = 'content';

        $columns = array('id', 'caption');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $method = "parse{$row->set002}";

            $tmp['value'] = method_exists($this, $method)
                ? json_encode(call_user_func_array(array($this, $method), array($row)))
                : json_encode($row->attributes(array('key', 'value')));

            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Setting::count($this->options(true)),
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
            $options['order'] = 'set006';
        }
        return $options;
    }

    public function parseMobileTitleImage($row) {
        $data = $row->attributes(array('key', 'value'));
        $data['value'] = Image::mobileTitleUrl($row->set004);
        return $data;
    }

}