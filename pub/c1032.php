<?php
use model\Order;

class c1032 {

    public function run() {

        $year = Input::post('year') ? Input::post('year') : date("Y");
        $month = Input::post('month') ? Input::post('month') : date("m");
        $page = Input::post('page') ?: 1;
        $id = Input::post('agentid') ?: null;
        
        $rows = array();
        $options = array(
            'conditions' => array(
                'odm022 = ? AND YEAR(odm006) = ? AND MONTH(odm006) = ?', 
                $id, $year, $month
            )
        );
        
        $rp = Input::post('rp') ?: 10;
        $options['offset'] = ($page - 1) * $rp;
        $options['limit'] = $rp;
        // $options['order'] = 'odm001 ASC';

        $result = Order::find('all', $options);
        $count = count($result);
        
        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            $rows[] = $tmp;
        }
        
        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions() 
    {
        $shipment = Input::post('shipmentno');
        
        $where = array();
        if($shipment > 0){
            if(Input::post('no')){
                $where[] = 'odm002 LIKE ? or odm011 LIKE ?';
                $params[] = "%".Input::post('no')."%";
                $params[] = "%".Input::post('no')."%";    
            }elseif(!Input::post('no') && Input::post('date1') && Input::post('date2')){
                $where[] = "odm006 BETWEEN ? AND ?";
                $params[] = Input::post('date1');
                $params[] = Input::post('date2');
            }elseif (Input::post('no') && Input::post('date1') && Input::post('date2')) {
                $where[] = "odm006 BETWEEN ? AND ?";
                $params[] = Input::post('date1');
                $params[] = Input::post('date2');

                $where[] = 'odm002 LIKE ? or odm011 LIKE ?';
                $params[] = "%".Input::post('no')."%";
                $params[] = "%".Input::post('no')."%"; 
            }
            
        }else{
            //搜尋一：只搜尋訂單編號
            if (Input::post('no') && Input::post('date1') && Input::post('date2')) {
                $where[] = "odm006 BETWEEN ? AND ?";
                $params[] = Input::post('date1');
                $params[] = Input::post('date2');

                $where[] = 'odm002 LIKE ?';
                $params[] = "%".Input::post('no')."%"; 
            //搜尋二：搜尋日期
            }elseif (!Input::post('no') && Input::post('date1') && Input::post('date2')) {
                $where[] = "odm006 BETWEEN ? AND ?";
                $params[] = Input::post('date1');
                $params[] = Input::post('date2');
            //搜尋二：搜尋訂單編號 + 日期
            }elseif (Input::post('no')) {
                $where[] = 'odm002 LIKE ?';
                $params[] = "%".Input::post('no')."%"; 
            }
        }

        // if (Input::post('no')) {
        //     $no = Input::post('no');
        //     $where[] = 'odm002 = ?';
        //     $params[] = Input::post('no');
        // }

        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array(
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