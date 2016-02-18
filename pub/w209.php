<?php
use model\Order;
use model\Member;
use model\MemberPointRecord;
/**
 * 取得會員的購物金記錄
 */

class w209 extends pub\GatewayApi{

    public function run()
    {
        $mid = User::get('id');

        $result = Order::with(
            Order::all($this->options()),
            array(
                'point' => array(
                    'conditions' => array("mpr003 = 'order' AND mpr002 = ?", $mid)
                ),
                'detail' => array(),
                'rejectc' => array(),
            )
        );
        $rows = array();

        foreach ($result as $r) {
            $point = $r->point ?: new MemberPointRecord;
            $count_detail = 0;
            $count_reject = 0;
            foreach ($r->detail as $dtl) {
                $count_detail += $dtl ? $dtl->odd006 : 0;
            }
            foreach ($r->rejectc as $rej) {
                $count_reject += $rej ? $rej->odr008 : 0;
            }
            $cancel = ($count_detail == $count_reject);
            $finish = ($r->odm006 && $r->odm031) ? true : false;
            $get = $r->getMemberPoint(true);
            $get =  $finish ? $get : " ( 未入帳 : {$get} ) ";

            $surplus = max($point->mpr005, 0);
            if (! $finish) {
                $surplus .= " {$get}";
            }
            $row = array(
                'id' => $r->odm001,
                'no' => $r->odm002,
                'date' => $r->odm006->format('Y/m/d'),
                'finish' => $finish,
                'cancel' => $cancel,
                'point' => array(
                    'use' => $r->odm004,            /* 購物使用點數 */
                    /* 購物獎勵點數 */
                    'get' => $get,  
                    'recede' => $r->odm033,         /* 退貨歸還點數 */
                    /* 結果 , for app version 1.3.5- */
                    'surplus' => $surplus,    
                    /* 同上 , for app version 1.3.6+ */
                    'result' => $cancel ? '交易取消' : $get,
                )
            );

            /* 資料為下層會員的交易記錄 */
            if ($r->odm013 != $mid) {
                $row['point']['use'] = 0;
                $row['point']['recede'] = 0;
            }

            $rows[] = $row;


        }

        $page = $this->page();
        $rp = $this->rp();

        return array(
            'status' => true,
            'rows' => $rows,
            'total' => Order::count($this->options(true)),

        );

    }

    public function rp() {
        return 15;
    }

    public function options($is_count = false) 
    {

        $mid = User::get('id');
        $count = Input::post('count');

        $options = array(
            'conditions' => array(
                '? IN (odm013, odm023, odm024, odm025)', 
                $mid
            )
        );
        if (! $is_count) {
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = $count;
            $options['limit'] = $rp;
            $options['order'] = 'odm006 DESC, odm001 DESC';

        }
        return $options;
    }
}