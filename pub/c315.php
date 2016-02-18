<?php
use model\agent;
use model\Order;
use model\Reject;
use model\Swap;

class c315 extends pub\GatewayApi{

    public function run() {
        
        // $count = News::count()
        $page = Input::post('page') ?: 1;
        
        // $result = Order::getPage($page);
        $rows = array();
        $result = Order::with(
                        Order::find('all', $this->getOptions()),
                        array('al','ar')
                    );
       // echo "<pre>"; print_r($result); echo "</pre>";
        
        $sql = Order::connection()->last_query;
        // print_r($sql);
        $count = intval(Order::count($this->getOptions(true)));
        
        foreach ($result as $row) {
            $al = $row->al ?: new Agent;
            $ar = $row->ar ?: new Agent;
            $tmp = $row->attributes(true);
            $tmp['alno'] = $al->age003;
            $tmp['arno'] = $ar->age003;
            // $tmp['check_status'] = $row->odm005 ? $row->odm005 : null;
            $tmp['methods'] = Order::getMethods($row->odm009);
            $tmp['getmode'] = Order::getMode($row->odm010);

            //檢查換貨資料表是否有相同的訂單編號
            $swap = Swap::getOrderForSwap($row->odm001) ?: null;
            // $swap = Swap::getOrderForSwap($row->getOid()) ?: null;
            $tmp['swap'] = $swap ? $swap->ods001 : 0;

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
            
            $rows[] = $tmp;
        }
        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions( $is_count=false ) 
    {
        $shipment = Input::post('shipmentno');
        $methods = 'house';
        $phone = Input::post('no');
        $memberID = $this->findMember($phone);
        $where = array();
        
        if($shipment > 0){
            if(Input::post('no') && Input::post('date1') && Input::post('date2')){
                $where[] = "odm010 = ? AND odm007 BETWEEN ? AND ? AND (odm002 LIKE ? or odm011 LIKE ? or odm013 IN (?))";
                $params[] = $methods;
                $params[] = Input::post('date1');
                $params[] = Input::post('date2');
                $params[] = "%".Input::post('no')."%";
                $params[] = "%".Input::post('no')."%";  
                $params[] = $memberID;  
            }elseif(!Input::post('no') && Input::post('date1') && Input::post('date2')){
                $where[] = "odm010 = ? AND odm007 BETWEEN ? AND ?";
                $params[] = $methods;
                $params[] = Input::post('date1');
                $params[] = Input::post('date2');
            }
            
        }else{
            $search_date2 = Input::post('date2');
            $today = date("Y-m-d");
            if($search_date2==$today){
                $date2 = date("Y-m-d", strtotime($search_date2."+1 day"));
            }else{
                $date2 = Input::post('date2');
            }

            //搜尋一：只搜尋訂單編號
            if (Input::post('no') && Input::post('date1') && Input::post('date2')) {
                $where[] = "odm010 = ? AND odm007 BETWEEN ? AND ?";
                $params[] = $methods;
                $params[] = Input::post('date1');
                $params[] = $date2;

                $where[] = 'odm002 LIKE ?';
                $params[] = "%".Input::post('no')."%"; 
            //搜尋二：搜尋日期
            }elseif (!Input::post('no') && Input::post('date1') && Input::post('date2')) {
                $where[] = "odm010 = ? AND odm007 BETWEEN ? AND ?";
                $params[] = $methods;
                $params[] = Input::post('date1');
                $params[] = $date2;
            //搜尋二：搜尋訂單編號 + 日期
            }elseif (Input::post('no')) {
                $where[] = 'odm010 = ? AND odm002 LIKE ?';
                $params[] = $methods;
                $params[] = "%".Input::post('no')."%"; 
            }
        }

        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        if( !$is_count ){
            $options = array(
                'order' => 'odm001 DESC',
                'offset' => ($page - 1) * $rp,
                'limit' => $rp,   
            );
        }else{
            $options = array(
                'order' => 'odm001 DESC'  
            ); 
        }
        
        
        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}