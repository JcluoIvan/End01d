<?php
use model\Order;
/* 取得購買記錄 */
class w106 {

    public function run() {

        
        $rows = array();
        $result = Order::find('all', $this->options());

        foreach ($result as $row) {
            $rows[] = array(
                'id' => $row->odm001,
                'no' => $row->odm002,
                'money' => $row->odm003,
                'cancel' => false,
                'type' => $row->getPayType(),
            );
        }

        return array(
            'status' => true,
            'message' => '',
            'rows' => $rows,
            'total' => Order::count($this->options(true))
        );

    }

    public function rp() {
        return 15;
    }

    public function options($is_count = false) 
    {
        $mid = User::get('id'); //Input::post('mid');

        if ($lid = Input::post('lid')) {
            $options['conditions'] = array(
                'odm013 = ? AND odm001 < ? ',
                $mid,
                $lid
            );
        } else {
            $options = array(
                'conditions' => array(
                    'odm013 = ? ',
                    $mid
                )
            );
        }

        if (! $is_count) {

            /* 每頁筆數 */
            $options['offset'] = Input::post('count') ?: 0;
            $options['limit'] = $this->rp();
            $options['order'] = 'odm001 DESC';
        }
        return $options;
    }

}