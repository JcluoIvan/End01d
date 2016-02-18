<?php
use model\Agent;
use model\Order;
use model\Reject;
use model\Swap;
use model\Member;

class c900 {

    public function run() {
        
        // $count = News::count()
        $page = Input::post('page') ?: 1;
        
        //登入的指揮站 ID
        $id = User::get('id');
        $searchData = Input::post('no');
        $result = Agent::find('all', $this->getOptions2());
        $count = intval(Agent::count($this->getOptions2(true)));
        $rows = array();
        foreach ($result as $row) {
            $tmp = $row->attributes(true);

            $date1 = Input::post('year');
            $date2 = Input::post('month');
            //加入本月累積總額
            $sqlRROrder = "SELECT SUM(odm003) as total, odm026, odm027, SUM(odm030) as total2 ,age001, bon003, bon004, odm001 as oid, odm006, odm031  
                            FROM order_manager, agent as age, bonus as bon
                            WHERE odm022 = ? AND odm005 NOT IN ('null', '0000-00-00', '') AND odm031 NOT IN ('null', '0000-00-00', '') AND YEAR(odm031) = ? AND MONTH(odm031) = ? 
                            AND odm022 = age.age001 AND age.age001 = ? AND age.age018 != 0
                            AND odm022 = bon.bon003 AND odm001 = bon.bon002 AND YEAR(bon004) = ? AND MONTH(bon004) = ? ";


            // $sqlRROrder = "SELECT SUM(odm003) as total, odm026, odm027, SUM(odm030) as total2 
            //                     FROM order_manager
            //                     WHERE EXISTS (
            //                         SELECT 1 
            //                         FROM agent 
            //                         WHERE age001 = ? 
            //                             AND age001 = odm022   
            //                         )
            //                     AND odm005 is not null AND YEAR(odm031) = ? AND MONTH(odm031) = ? ";
            $valuesRROrder = array($tmp['id'],$date1,$date2,$tmp['id'],$date1,$date2);
            $RROrder = Order::connection()
                        ->query($sqlRROrder, $valuesRROrder);
            
            foreach ($RROrder as $rrow) {
                $tmpr = $rrow;
                $tmp['total'] = $tmpr['total2'] ?: 0;
                $tmp['percent'] = $tmpr['odm026'] ?: 0;
                $tmp['total2'] = round(($tmpr['total2']*$tmpr['odm026'])/100) ?: 0;
            }

            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions2($is_count = false){
            $id = User::get('id');
            $memsearch = Input::post('memsearch');
            $searchData = Input::post('no');
            $where = array();

            switch ($memsearch) {
                case 'id':
                    if($searchData){
                        $where[] = 'age004 = ? AND age018 = ?';
                        $params[] = $searchData;
                        $params[] = $id;
                    }else{
                        $where = array();
                        $where[] = 'age018 = ?';
                        $params[] = $id;    
                    }
                    break;
                case 'name':
                    if($searchData){
                        $where[] = 'age003 LIKE ? AND age018 = ?';
                        $params[] = "%".$searchData."%";
                        $params[] = $id;
                    }else{
                        $where = array();
                        $where[] = 'age018 = ?';
                        $params[] = $id;    
                    }
                    break;
                
                default:
                    # code...
                    break;
            } 

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

    private function getOptions() 
    {
        // $shipment = Input::post('shipmentno');
        
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
            $search_date2 = Input::post('date2');
            $today = date("Y-m-d");
            if($search_date2==$today){
                $date2 = date("Y-m-d", strtotime($search_date2."+1 day"));
            }else{
                $date2 = Input::post('date2');
            }

            //搜尋一：只搜尋訂單編號
            if (Input::post('no') && Input::post('date1') && Input::post('date2')) {
                $where[] = "odm006 BETWEEN ? AND ?";
                $params[] = Input::post('date1');
                $params[] = $date2;

                $where[] = 'odm002 LIKE ?';
                $params[] = "%".Input::post('no')."%"; 
            //搜尋二：搜尋日期
            }elseif (!Input::post('no') && Input::post('date1') && Input::post('date2')) {
                $where[] = "odm006 BETWEEN ? AND ?";
                $params[] = Input::post('date1');
                $params[] = $date2;
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