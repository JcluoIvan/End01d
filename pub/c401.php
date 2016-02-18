<?php
use model\News;
class c401 {

    public function run() 
    {

        $result = News::find('all', $this->options());

        $rows = array();
        $columns = array('id', 'title', 'notice_for', 'time');
        if (Input::post('type') !== 'app') $columns[] = 'content';


        foreach ($result as $row) {

            $tmp = $row->attributes($columns);
            $tmp['type_name'] = $row->typeName();
            $tmp['notice_for'] = $row->noticeFor();
            $rows[] = $tmp;

        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => News::count($this->options(true)),
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
        $type = Input::post('type') === 'app' ? 'app' : 'sms';

        $options = array(
            'conditions' => array(
                'new002 = ?',
                $type
            )
        );
        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'new007 DESC';
        }
        return $options;
    }


}