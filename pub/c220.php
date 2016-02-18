<?php
/* 產品管理 清單 */

use model\Product;
class c220 {

    public function run() {

        $result = Product::with(
            Product::find('all', $this->options()),
            array('item', 'operate')
        );
        $rows = array();
        $columns = array(
            'id', 
            'no', 
            'name',
            'price', 
            'member_price', 
            'selling', 
            'editor',
            'main',
            'sell_type',
            'sort');
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['type'] = $row->item ? $row->item->pdi002 : ' ? '; 
            $tmp['editor'] = $row->operate ? $row->operate->age006 : ' ? '; 
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
        $conditions = array(array('1'));
        // $options = array('conditions' => array());

        $type = Input::post('product-type');
        if ($type) {
            $conditions[0][] = 'pdm003 = ?';
            $conditions[] = $type;
        }

        $sell = Input::post('sell-type');
        if (is_numeric($sell)) {
            $conditions[0][] = 'pdm019 = ?';
            $conditions[] = $sell ? 1 : 0;
        }

        $selling = Input::post('selling');
        if (is_numeric($selling)) {
            $conditions[0][] = 'pdm007 = ?';
            $conditions[] = $selling ? 1 : 0;
        }

        $main = Input::post('main');
        if (is_numeric($main)) {
            $conditions[0][] = 'pdm013 = ?';
            $conditions[] = $main ? 1 : 0;
        }


        $conditions[0] = implode(' AND ', $conditions[0]);
        $options = array('conditions' => $conditions);

        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'pdm014';
        }
        return $options;
    }
}