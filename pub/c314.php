<?php
use model\Agent;
use model\Reject;
use model\Swap;
use model\Member;
use model\Order;
use model\OrderDetail;
use model\Product;

class c314 {

    public function run() {

        $page = Input::post('page') ?: 1;
        $oid = Input::post('id');

        $rows = array();
        
        $result = OrderDetail::find('all', $this->getOptions());
        $sql = OrderDetail::connection()->last_query;
        // echo "<pre>"; print_r($sql); echo "</pre>";
        $count = intval(OrderDetail::count($this->getOptions(true)));
        // $count = Product::count($this->productOptions(true));

        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            $reject = Reject::find_by_odr002($oid) ?: new Reject;
            $tmpReject = $reject->attributes(true);
            $rejectAmount = $tmpReject['status'] ==1 ? $tmpReject['amount'] : 0;
            $rejectMoney = $tmpReject['status'] ==1 ? $tmpReject['rTmoney'] : 0;
            $product = Product::find_by_pdm001($tmp['pid']);
            // $amount = $tmp['count'] - $rejectAmount;
            $tmp['no'] = $product->pdm002;
            $tmp['name'] = $product->pdm004;
            $tmp['total'] = $tmp['money']*$tmp['count'];
            // $tmp['count'] = $amount;
            $tmp['reject_count'] = $rejectAmount;
            $tmp['reject_money'] = $rejectMoney;
            $tmp['totalcount'] = $tmp['count'] - $tmp['reject_count'];
            $tmp['totalmoney'] = $tmp['total'] - $tmp['reject_money'];
            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions($is_count = false) 
    {
        $oid = Input::post('id');
        
        $where = array();
        $where[] = 'odd002 = ?';
        $params[] = $oid; 

        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        if (! $is_count) {
            $options = array(
                'offset' => ($page - 1) * $rp,
                'limit' => $rp,   
            );
        }
        
        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}