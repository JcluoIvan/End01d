<?php
// 會員訂購記錄 清單

use model\Order;


// echo "<pre>";
// var_dump($_POST);


class c1106 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;
        
        // 結果
        $result = Order::find('all', $this->getOptions());

        $rows = array();


        // 變更索引值
        $cols = array('sn', 'oid', 'date1', 'money', 'coupon', 'fare', 'reject_shopgold');

        foreach ($result as $row) {
            $tmp = $row->attributes($cols);
            $tmp['date'] = $tmp['date1'];
            /* 總金額  = 實收 + 運費  + 使用購物金 - 退貨*/
            $tmp['money'] = 
                intval($tmp['money']) + intval($tmp['fare']) + intval($tmp['coupon']) - intval($tmp['reject_shopgold']);

            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => count(
                Order::find('all', $this->getOptions(true))
            ),
        );
        
    }

    private function getOptions($getCount = false) 
    {
        $id = Input::post('id');

        $where[] = 'odm013 = ?';
        $params[] = $id;

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        /* 每頁筆數 */
        $rp = Input::post('rp') ?: 10;

        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array();
        if (!$getCount) {
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'odm006 DESC';
        }

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}