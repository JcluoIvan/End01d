<?php
use model\Agent;
use model\Swap;
use model\Reject;
use model\Member;
use model\Order;
use model\OrderDetail;
use model\Product;

class c807 {

    public function run() {

        $page = Input::post('page') ?: 1;
        $oid = Input::post('id');

        $rows = array();
        
        $result = OrderDetail::find('all', $this->getOptions());
        $sql = OrderDetail::connection()->last_query;
        // echo "<pre>"; print_r($sql); echo "</pre>";
        $count = intval(OrderDetail::count($this->getOptions(true)));

        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            $reject = Reject::find_by_odr002($oid) ?: new Reject;
            $rowsReject = $reject->attributes(true);
            $rejectAmount = $rowsReject['status'] == 1 ? $rowsReject['amount'] : 0;
            $product = Product::find_by_pdm001($tmp['pid']);
            $amount = $tmp['count'] - $rejectAmount;
            $tmp['no'] = $product->pdm002;
            $tmp['name'] = $product->pdm004;
            $tmp['count'] = $amount;
            $tmp['total'] = $tmp['money']*$tmp['count'];
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

        if(!$is_count){
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