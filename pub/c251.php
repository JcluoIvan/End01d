<?php
use model\ProductPurchaseDetail;
use model\Product;
use model\Agent;
use pub\GatewayApi;

/* 查詢 purchase detail */
class c251 extends GatewayApi{

    public function run() {

        $result = ProductPurchaseDetail::with(
            ProductPurchaseDetail::all($this->options()),
            array('product', 'product.item')
        );

        $rows = array();
        $columns = array('id', 'count');
        foreach ($result as $r) {

            $product = $r->product ?: new Product;
            $item = $product->item ?: new Item;
            $rows[] = $r->attributes($columns) + 
                array(
                    'product_no' => $product->pdm002 ?: ' - ',
                    'product_name' => $product->pdm004 ?: ' - ',
                    'product_item' => $item->pdi002 ?: ' - '
                );
        }
        return array(
            'page' => $this->page(),
            'total' => ProductPurchaseDetail::count($this->options(true)),
            'rows' => $rows
        );

    

    }

    public function options($is_count = false) 
    {

        $parent = Input::post('parent') ?: 0;  

        $options = array(
            'conditions' => array('ppd002 = ? ', $parent)
        );

        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();

            $options['order'] = 'ppd001';
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;

        }
        return $options;

    }

}