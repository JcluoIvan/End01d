<?php
use model\Agent;
use model\Order;
use model\Reject;
use model\Swap;
use model\Member;

class c800 extends pub\GatewayApi{

    public function run() {
        $page = Input::post('page') ?: 1;
        
        //登入的雷達站 ID
        $id = User::get('id');
        $bank_account = User::get('bank_account');
        $bank_code = User::get('bank_code');
        $searchData = Input::post('no');
        $result = Member::find('all', $this->getOptions2());

        $mids = array();
        foreach ($result as $row) {
            $mids[] = $row->mem001;
        }
        $mids = $mids ?: array(0);

        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array(
            'select' => implode(',', array(
                'odm001 as sn',
                'odm013 as mid',
                'SUM(odm003) as total',
                'odm027',
                'SUM(odm030) as total2',
                'SUM(odm032) AS reject'
            )),
            'conditions' => array(
                'odm013 IN (?) AND odm005 != 0 AND YEAR(odm031) = ? AND MONTH(odm031) = ?',
                $mids,
                Input::post('year'),
                Input::post('month')
            ),
            'group' => 'odm013, odm027',
            'offset' => ($page - 1) * $rp,
            'limit' => $rp, 
        );

        $options_count = array(
            'select' => implode(',', array(
                'odm001 as sn',
                'odm013 as mid',
                'SUM(odm003) as total',
                'odm027',
                'SUM(odm030) as total2',
                'SUM(odm032) AS reject'
            )),
            'conditions' => array(
                'odm013 IN (?) AND odm005 != 0 AND YEAR(odm006) = ? AND MONTH(odm006) = ?',
                $mids,
                Input::post('year'),
                Input::post('month')
            ),
            'group' => 'odm013, odm027',
        );

        $result = Order::find('all', $options);

        // $count = count($result);
        $count = intval(Order::count($options_count));
        $rows = array();
        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            $memberData = Member::find_by_mem001($tmp['mid']);
            $tmpMember = $memberData->attributes(true);
            $tmp['no'] = $tmpMember['no'];
            $tmp['name'] = $tmpMember['name'];
            $tmp['total3'] = round(( ($tmp['total2'] - $tmp['reject']) * $tmp['lv2percent'])/100) ?: 0;

            $rows[] = $tmp;
        }
        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions2(){
            $id = User::get('id');
            $memsearch = Input::post('memsearch');
            $searchData = Input::post('no');
            $year = Input::post('year');
            $month = Input::post('month');
            $where = array();

            switch ($memsearch) {
                case 'id':
                    if($searchData){
                        // $where[] = 'mem002 = ? AND mem017 = ? AND ( YEAR(mem006) = ? AND MONTH(mem006) = ?)';
                        $where[] = 'mem002 LIKE ? AND mem017 = ?';
                        $params[] = "%".$searchData."%";
                        $params[] = $id;
                    }else{
                        $where[] = 'mem017 = ? ';
                        $params[] = $id;   
                    }
                    break;
                case 'name':
                    if($searchData){
                        $where[] = 'mem005 LIKE ? AND mem017 = ? ';
                        $params[] = "%".$searchData."%";
                        $params[] = $id;
                    }else{
                        $where[] = 'mem017 = ? ';
                        $params[] = $id;  
                    }
                    break;
                case 'phone':
                    if($searchData){ 
                        $where[] = 'mem011 LIKE ? AND mem017 = ? ';
                        $params[] = "%".$searchData."%";
                        $params[] = $id;
                    }else{
                        $where[] = 'mem017 = ? ';
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