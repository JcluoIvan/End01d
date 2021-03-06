<?php
use model\Product;
class c262 {

    public function run() {

        $result = Product::find('all', $this->options());
        $rows = array();

        $columns = array('id', 'name');
        foreach ($result as $r) {
            $rows[] = $r->attributes($columns);
        }

        return array(
            'status' => true,
            'rows' => $rows,
        );
    }

    public function options() {
        $iid = Input::post('iid') ?: 0;
        return array(
            'conditions' => array('pdm003 = ?', $iid),
        );
    }


}