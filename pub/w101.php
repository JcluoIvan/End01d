<?php
use model\Product;
use model\ProductPhoto;
/* 購物車商品資料 */
class w101 {

    public function run() {

        $options = $this->options();

        $rows = array();
        $black = User::get('black');

        if ($options !== false) {

            $result = Product::find('all', $options) ?: array();

            foreach ($result as $row) {
                $tmp = $row->attributes(array(
                    'id', 'no', 'name', 'sell_type'
                ));
                $tmp['money'] = $row->pdm006;
                $tmp['OOS'] = $black;   /* 是否缺貨 (若為黑名單一率為缺貨) */
                $rows[] = $tmp;
            }

        }

        return array(
            'status' => true,
            'point' => max(User::get('point'), 0),
            'rows' => $rows,
        );

    }
    public function options() 
    {
    
        $pids = Input::post('pid');

        if (! is_array($pids) || count($pids) === 0) {
            return false;
        }

        return array(
            'conditions' => array(
                'pdm007 = 1 AND pdm001 IN (?)',
                $pids
            ),
            'order' => 'pdm014'
        );
    }
}