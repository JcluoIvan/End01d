<?php
use model\Reject;
use model\Agent;
use model\Member;
use model\Order;

class c805 {

    public function run() {

        $page = Input::post('page') ?: 1;
        $oid = Input::post('oid');
        $date1 = Input::post('date1');
        $date2 = Input::post('date2');

        $rows = array();
        $result = Reject::find('all', $this->getOptions());
        // echo "<pre> result:"; print_r($result); echo "</pre>";
        $sql = Reject::connection()->last_query;
        // echo "<pre>"; print_r($sql); echo "</pre>";
        $count = intval(Reject::count($this->getOptions('count')));

        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            $agentData = Agent::find_by_age001($tmp['aid']);
            $agent = $agentData->attributes(true);
            $memberData = Member::find_by_mem001($tmp['mid']);
            $member = $memberData->attributes(true);
            $orderData = Order::find_by_odm001($tmp['oid']);
            $order = $orderData->attributes(true);
            $tmp['oid'] = $order['oid'];
            $tmp['rno'] = $agent['no'];
            $tmp['mno'] = $member['no'];
            $tmp['status'] = Reject::getType($row->odr013);
            $rows[] = $tmp;
        }
        // echo "<pre>"; print_r($tmp); echo "</pre>";

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions() 
    {
        //雷達站帳號登入資訊
        $account = User::get('account');
        $name = User::get('name');
        $lv2Rid = User::get('id');

        $search_date2 = Input::post('date2');
        $today = date("Y-m-d");
        $oid = Input::post('oid');
        $no = Input::post('no');
        if($search_date2==$today){
             $date2 = date("Y-m-d", strtotime($search_date2."+1 day"));
        }else{
            $date2 = Input::post('date2');
        }
        
        $where = array();
        //搜尋一：只搜尋訂單編號 + 日期
        if (Input::post('no') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odr005 = ? AND odr003 LIKE ? AND odr012 BETWEEN ? AND ?";
            $params[] = $lv2Rid;
            $params[] = "%".$no."%";
            $params[] = Input::post('date1');
            $params[] = $date2;
        //搜尋二：搜尋日期
        }elseif (!Input::post('no') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odr005 = ? AND odr002 = ? AND odr012 BETWEEN ? AND ?";
            $params[] = $lv2Rid;
            $params[] = $oid;
            $params[] = Input::post('date1');
            $params[] = $date2;
        //搜尋二：搜尋訂單編號 
        }elseif (Input::post('no')) {
            $where[] = 'odr005 = ? AND odr003 LIKE ?';
            $params[] = $lv2Rid;
            $params[] = "%".$no."%"; 
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

}