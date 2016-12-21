<?php
/* 購物金 - 雷達 - 明細列表 */

use model\Order;
use model\Bonus;


class c721 extends pub\GatewayApi {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;
        // $aid = Input::post('aid');

        $result = Order::find('all', $this->options());

        $rows = array();

        foreach ($result as $row) {
            $rows[] = array(
                'sn' => $row->odm002,
                'total' => $row->odm003,
                'coupon' => $row->odm004,
                'money' => $row->odm030,
                'percent' => $row->odm027,
                'bonus' => floor(($row->odm030 - $row->odm032) * $row->odm027 / 100)
            );
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => Order::count($this->options(true))
        );

    }

    private function options($getCount = false)
    {
        $oid = Input::post('oid') ?: null;
        if ($oid) {
            $oid = explode(',', $oid);
            $oid = array_map('intval', $oid);
        }
        $oid = implode(',', $oid ?: array(0));

        $options = array(
            'conditions' => array(
                "odm001 IN ($oid)"
            )
        );




        if (! $getCount) {
            $rp = $this->rp();
            $page = $this->page();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'odm006, odm001';

        }
        return $options;
    }

}