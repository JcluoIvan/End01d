<?php
use model\Agent;
use model\Reject;
use model\Member;
use model\Order;
use model\Product;

class c1027 {

    public function run() {

        $page = Input::post('page') ?: 1;
        $oid = Input::post('oid');
        $date1 = Input::post('date1');
        $date2 = Input::post('date2');

        $rows = array();
        $result = Reject::with(
                        Reject::find('all', $this->getOptions()),
                        array('order','ar','member','product')
                    );
        // echo "<pre> result:"; print_r($result); echo "</pre>";
        
        $sql = Reject::connection()->last_query;
        // echo "<pre>"; print_r($sql); echo "</pre>";
        $count = intval(Reject::count($this->getOptions('count')));

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
            if($tmp['status']==null or $tmp['status']==0){
                $tmp['status'] = '處理中';
            }elseif($tmp['status']==1){
                $tmp['status'] = '核帳';
            }elseif($tmp['status']==2){
                    $tmp['status'] = '註銷';
            }
            // $tmp['status'] = Reject::getType($row->odr013);
            $rows[] = $tmp;
        }
        // echo "<pre> tmp:"; print_r($tmp); echo "</pre>";

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions() 
    {
        $oid = Input::post('oid');
        $date1 = Input::post('date1');
        $date2 = Input::post('date2');
        
        $where = array();
        //搜尋一：只搜尋退貨單編號 + 日期
        if (Input::post('oid') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odr002 = ? AND odr012 BETWEEN ? AND ?";
            $params[] = $oid;
            $params[] = $date1;
            $params[] = $date2;
        }

        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array(
            'order' => 'odr012 DESC, odr001 DESC',
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