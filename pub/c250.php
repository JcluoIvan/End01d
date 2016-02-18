<?php
use model\ProductPurchase;
use model\ProductPurchaseDetail;
use model\Product;
use model\Agent;

/* 公司進貨記錄表記錄 */
class c250 extends \pub\GatewayApi{

    public function run() {


        $result = ProductPurchase::with(
            ProductPurchase::all($this->options()),
            array('editor')
        );

        $rows = array();
        $columns = array('id', 'no', 'date', 'remark');
        foreach ($result as $r) {
            $editor = $r->editor ?: new Agent;
            $row = $r->attributes($columns) + array(
                    'editor' => $editor->age006,
                );

            $row['remark'] = htmlspecialchars($row['remark']) ?: '';
            $row['date'] = date('Y-m-d', strtotime($row['date']));
            $rows[] = $row;
        }
        return array(
            'page' => $this->page(),
            'total' => ProductPurchase::count(array('conditions' => '1')),
            'rows' => $rows
        );



    }
    public function options($is_count = false) {

        $rid = Input::post('rid') ?: 0;     /* 雷達站 */
        $item = Input::post('item') ?: 0;   /* 產品分類 */
        $where = array('pdp003 = ? ', $rid);

        if ($item) {
            $result = Product::all(array('conditions' => array('pdm003 = ?', $item)));
            $data = array();
            foreach ($result as $r) {
                $data[] = intval($r->pdm001);
            }
            if (count($data)) {
                $where[0] .= ' AND pdp001 IN (
                    SELECT ppd002 
                    FROM product_purchase_detail
                    WHERE ppd004 IN (?)
                )';
                $where[] = $data;
            }

        }

        $options = array(
            'conditions' => $where
        );

        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();

            $options['order'] = 'pdp004 DESC, pdp001 DESC';
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;

        }
        return $options;
    }


}