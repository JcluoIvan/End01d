<?php
use model\LogOrder;
class c9920 {

    public function run() 
    {
        
        $result = LogOrder::with(
                LogOrder::find('all', $this->options()),
                array('order', 'order.member', 'editor')
            );

        $rows = array();
        $columns = array('id', 'ip', 'datetime');
        foreach ($result as $row) {
            $order = $row->order;
            $member = $order ? $order->member : null;
            
            $tmp = $row->attributes($columns);
            $tmp['action'] = $row->action() . $row->type_name();
            $tmp['order_no'] = $order ? $order->odm002 : 'unknown';
            $tmp['member_name'] = ($member) ? $member->mem005 : 'unknown';
            $tmp['editor'] = $row->editor ? $row->editor->age006 : 'unknown';
            $tmp['view'] = $row->lod006;
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => LogOrder::count($this->options(true)),
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
            $options['order'] = 'lod009 DESC';
        }
        return $options;
    }


}