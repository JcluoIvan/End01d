<?php
use model\Order;

class c309 {

    public function run() {

        $year = Input::post('year') ? Input::post('year') : date("Y-m-d");
        $month = Input::post('month') ? Input::post('month') : date("Y-m-d");
        $page = Input::post('page') ?: 1;
        $id = Input::post('agentid') ?: null;
        
        $rows = array();
        $options = array(
            'conditions' => array(
                'odm022 = ? AND odm005 BETWEEN ? AND ?', 
                $id, $year, $month
            )
        );
        
        $rp = Input::post('rp') ?: 10;
        $options['offset'] = ($page - 1) * $rp;
        $options['limit'] = $rp;

        $result = Order::find('all', $options);
        
        /* */
        $options_count = array(
            'conditions' => array(
                'odm022 = ? AND odm005 BETWEEN ? AND ?', 
                $id, $year, $month
            )
        );
        /* */
        // $count = count($result);
        $count = intval(Order::count($options_count));
        
        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            if($tmp['openaccount']==0){
                $tmp['openaccountStatus'] = '未結';
            }elseif($tmp['openaccount']==1){
                $tmp['openaccountStatus'] = '已結';
            }
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