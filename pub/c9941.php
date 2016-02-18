<?php
use model\LogPurchase;
use model\Product;
use model\Agent;
class c9941 {

    public function run() 
    {
        
        $result = LogPurchase::with(
                LogPurchase::find('all', $this->options()),
                array('product', 'purchase', 'agent', 'editor')
            );

        $rows = array();
        $columns = array('id', 'ip', 'datetime', 'aid', 'action');
        foreach ($result as $row) {
            $product = $row->product ?: new Product;
            $agent = $row->agent ?: new Agent;
            $agent = $row->agent ?: new Agent;
            $tmp = $row->attributes($columns);
            $tmp['type_name'] = $row->typeName();
            $tmp['action_name'] = $row->action();
            $tmp['product_name'] = 
                $row->lpc007 == LogPurchase::TYPE_MAIN 
                    ? ' - ' : ($product->pdm004 ?: '資料遺失');
            $tmp['agent'] = $row->agent->age006 ?: '資料遺失';
            $tmp['editor'] = $row->editor->age006 ?: '資料遺失';
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
        $log = LogPurchase::find_by_lpc001(Input::post('id'));

        $options = array(
            // 'conditions' => array('? IN (lpc001, lpc',  Input::post('aid', 0)) 
            'conditions' => array('lpc003 = ?', $log->lpc003)
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