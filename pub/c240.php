<?php
/* 庫存查詢(公司) 清單 */

use model\Product;
use model\ProductItem;
use model\ProductInventory;
use model\ProductInventoryDetail;
use model\Agent;

class c240 {

    public function run() 
    {

        $result = Product::with(
            Product::find('all', $this->options()),
            array(
                'item' => array(), 
                'inventory' => array(
                    'conditions' => array('pin002 = 0')
                )
            )
        ) ?: array();

        $rows = array();
        $columns = array('id', 'no', 'type', 'name', 'sort');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['count'] = $row->inventory 
                ? $row->inventory->pin004 : 0;
            $tmp['type'] = $row->item ? $row->item->pdi002 : '?';
            $tmp['sort'] /= 10;
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Product::count($this->options(true)),
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
            'conditions' => array('1')
        );

        if ($type = Input::post('product-type')) {
            $options['conditions'] = array('pdm003 = ?', $type);
        }

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