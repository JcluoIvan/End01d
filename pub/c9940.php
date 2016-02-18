<?php
use model\LogPurchase;
use model\Agent;
class c9940 {

    public function run() 
    {
        
        $result = LogPurchase::with(
                LogPurchase::find('all', $this->options()),
                array('purchase', 'agent', 'editor')
            );

        $rows = array();
        $columns = array('id', 'ip', 'datetime', 'aid', 'action');
        foreach ($result as $row) {
            $agent = $row->agent ?: new Agent;
            $editor = $row->editor ?: new Agent;
            $tmp = $row->attributes($columns);
            $tmp['action_name'] = $row->action();
            $tmp['type_name'] = $row->typeName();
            $tmp['agent'] = $row->lpc004 ? ($agent->age004 ?: 'unknown') : '公司';
            $tmp['editor'] =($editor->age004 ?: 'unknown');
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => LogPurchase::count($this->options(true)),
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
            $options['order'] = 'lpc011 DESC';
        }
        return $options;
    }


}