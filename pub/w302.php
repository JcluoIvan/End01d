<?php
use model\News;

/* 取得最新消息 */
class w302 {

    public function run() 
    {

        $result = News::find('all', $this->options()) ?: array();
        $rows = array();
        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            $tmp['image'] = $row->url();
            $rows[] = $tmp;

        }

        return array(
            'status' => true,
            'message' => '',
            'rows' => $rows,
            'total' => News::count($this->options())
        );

    }
    public function rp() 
    {
        return 15;
    }
    public function options($is_count = false)
    {
        $options = array(
            'conditions' => array(
                "new002 = 'app'"
            )
        );
        if ($time = Input::post('last_time')) {
            $options['conditions'] = array(
                "new002 = 'app' AND new007 < ?",
                $time
            );
        }
        if (! $is_count) {
            $options['offset'] = Input::post('count') ?: 0;
            $options['limit'] = $this->rp();
            $options['order'] = 'new007 DESC';
        }
        return $options;
    }

}