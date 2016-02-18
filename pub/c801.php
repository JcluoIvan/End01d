<?php
use model\Agent;
use model\Order;
use model\Reject;
use model\Swap;
use model\Member;
use model\Product;
use model\ProductInventory;

class c801 extends pub\GatewayApi{

    public function run() 
    {

        $id = User::get('id');
        $result = Product::with(
                Product::find('all', $this->options()),
                array(
                    'item' => array(),
                    'inventory' => array(
                        'conditions' => array('pin002 = ?', $id)
                    )
                )
        );
        $rows = array();
        $columns = array('id', 'no', 'type', 'name');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['count'] = $row->inventory
                ? $row->inventory->pin004 : 0;
            $tmp['type'] = $row->item ? $row->item->pdi002 : '資料不正確';
            $rows[] = $tmp;
        }
        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Product::count($this->options(true)),
        );

    }
    public function options($is_count = false) {
        $options = array(
            'conditions' => array(1)
        );
        if (! $is_count) {
            $rp = $this->rp();
            $page = $this->page();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'pdm014';
        }
        return $options;
    }

}