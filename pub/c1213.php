<?php
use model\Agent;
use model\Swap;
use model\Member;
use model\Order;
use model\Product;

class c1213 {

    public function run() {

        $page = Input::post('page') ?: 1;
        $oid = Input::post('oid');

        $rows = array();
        $result = SWap::with(
                        Swap::find('all', $this->getOptions()),
                        array('order','ar','member','product')
                    );
        
        $sql = Swap::connection()->last_query;
        // echo "<pre>"; print_r($sql); echo "</pre>";
        $count = intval(Swap::count($this->getOptions('count')));

        foreach ($result as $row) {
            $order = $row->order ?: new Order;
            $ar = $row->ar ?: new Agent;
            $member = $row->member ?: new Member;
            $product = $row->product ?: new Product;
            $tmp = $row->attributes(true);
            $tmp['ono'] = $order->odm002;
            $tmp['arno'] = $ar->age003;
            $tmp['mno'] = $member->mem002;
            $tmp['pname'] = $product->pdm004;
            // $tmp['status'] = Swap::getType($row->ods013);
            if($tmp['status']==null or $tmp['status']==0){
                $tmp['status'] = '處理中';
            }elseif($tmp['status']==1){
                $tmp['status'] = '核帳';
            }elseif($tmp['status']==2){
                $tmp['status'] = '註銷';
            }

            $rows[] = $tmp;
        }
        // echo "<pre> tmp:"; print_r($tmp); echo "</pre>";

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => intval(Swap::count($this->getOptions('count'))),
        );
        
    }

    private function getOptions() 
    {
        $date1 = Input::post('date1');
        $date2 = Input::post('date2');
        $oid = Input::post('oid');
        
        $where = array();
        //搜尋一：只搜尋換貨單編號 + 日期
        if (Input::post('oid') && Input::post('date1') && Input::post('date2')) {
            $where[] = "ods002 = ? AND ods012 BETWEEN ? AND ?";
            $params[] = $oid;
            $params[] = $date1;
            $params[] = $date2;
        }

        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array(
            'order' => 'ods012 DESC, ods001 DESC',
            'offset' => ($page - 1) * $rp,
            'limit' => $rp,   
        );
        
        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}