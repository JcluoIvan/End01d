<?php
use model\agent;
use model\Order;
use model\Reject;
use model\Swap;
use model\Member;

class c1025 extends pub\GatewayApi{

    public function run() {
        
        $page = Input::post('page') ?: 1;
                
        // $result = Order::getPage($page);
        $rows = array();
        $result = Order::with(
                        Order::find('all', $this->getOptions()),
                        array('al','ar','member')
                    );
       // echo "<pre>"; print_r($result); echo "</pre>";
        
        $sql = Order::connection()->last_query;
        // print_r($sql);
        // $count = intval(Order::count($this->getOptions(true)));
        
        foreach ($result as $row) {
            $al = $row->al ?: new Agent;
            $ar = $row->ar ?: new Agent;
            $member = $row->member ?: new Member;
            $tmp = $row->attributes(true);
            $tmp['alno'] = $al->age003;
            $tmp['arno'] = $ar->age003;
            // $tmp['check_status'] = $row->odm005 ? $row->odm005 : null;
            $tmp['methods'] = Order::getMethods($row->odm009);
            $tmp['getmode'] = implode(',', array(
                $row->odm010,
                $row->odm011,
                ($row->odm007 ? $row->odm007->format('Y-m-d') : ''),
            ));

            //檢查換貨資料表是否有相同的訂單編號
            $swap = Swap::getOrderForSwap($row->odm001) ?: null;
            // $swap = Swap::getOrderForSwap($row->getOid()) ?: null;
            $tmp['swap'] = $swap ? $swap->ods001 : 0;

            $tmp['check_date'] = $row->odm005 ? $row->odm005->format('Y-m-d') : '';
            $tmp['date1'] = $row->odm006 ? $row->odm006->format('Y-m-d') : '';
            $tmp['date2'] = $row->odm007 ? $row->odm007->format('Y-m-d') : '';
            $tmp['date3'] = $row->odm008 ? $row->odm008->format('Y-m-d') : '';

            //檢查退貨資料表是否有相同的訂單編號
            $reject = Reject::getOrderForReject($row->odm001) ?: null;
            // $reject = Reject::getOrderForReject($row->getOid()) ?: null;
            $tmp['reject'] = $reject ? $reject->odr002 : 0;
            $date1 = explode(" ", $tmp['date1']);
            $tmp['date1'] = $date1[0];
            $checkDate = explode(" ", $tmp['check_date']);
            $tmp['check_date'] = $checkDate[0];
            $date2 = explode(" ", $tmp['date2']);
            $tmp['date2'] = $date2[0];
            $date3 = explode(" ", $tmp['date3']);
            $tmp['date3'] = $date3[0];

            //現金
            $tmp['cash'] = $tmp['total'] - $tmp['fare'];

            //應收金額
            $tmp['total2'] = $tmp['cash'] + $tmp['fare'] - $tmp['coupon'] - $tmp['reject_shopgold'];
            
            // 會員編號
            $tmp['mno'] = $member->mem002;

            $rows[] = $tmp;
        }
        
        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => intval(Order::count($this->getOptions(true))),
        );
        
    }

    private function getOptions($is_count = false) 
    {
        $search_date2 = Input::post('date2');
        $today = date("Y-m-d");
        if($search_date2==$today){
            $date2 = date("Y-m-d", strtotime($search_date2."+1 day"));
        }else{
            $date2 = Input::post('date2');
        }
        $phone = Input::post('no');
        $memberID = $this->findMember($phone);

        //搜尋一：搜尋訂單編號+日期
        if (Input::post('no') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odm006 BETWEEN ? AND ? AND ( odm002 LIKE ? or odm015 LIKE ? or odm013 IN (?) )";
            $params[] = Input::post('date1');
            $params[] = $date2;
            $params[] = "%".Input::post('no')."%";
            $params[] = "%".Input::post('no')."%";
            $params[] = $memberID; 
        //搜尋二：搜尋日期
        }elseif (!Input::post('no') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odm006 BETWEEN ? AND ?";
            $params[] = Input::post('date1');
            $params[] = $date2;
        //搜尋三：只搜尋訂單編號
        }elseif (Input::post('no')) {
            $where[] = 'odm002 LIKE ?';
            $params[] = "%".Input::post('no')."%"; 
        }

        $options = array();
        
        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        if (! $is_count) {
            $page = Input::post('page') ?: 1;
            $rp = Input::post('rp') ?: 10;
            $page = intval($page) ?: 1;
            $rp = intval($rp) ?: 10;
            $options['limit'] =  $rp;
            $options['offset'] =  ($page - 1) * $rp;
            $options['order'] =  'odm001 DESC';
        }
        return $options;
    } 

}