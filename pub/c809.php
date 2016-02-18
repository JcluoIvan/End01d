<?php
use model\Reject;
use model\Agent;
use model\Member;
use model\Order;

class c809 {

    public function run() {

        $page = Input::post('page') ?: 1;
        $sn = Input::post('sn');
        $date1 = Input::post('getdate1');
        $date2 = Input::post('getdate2');

        $rows = array();
        $result = Reject::find('all', $this->getOptions());
        // echo "<pre> result:"; print_r($result); echo "</pre>";
        $sql = Reject::connection()->last_query;
        // echo "<pre>"; print_r($sql); echo "</pre>";
        $count = intval(Reject::count($this->getOptions(true)));

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

    private function getOptions($is_count = false) 
    {
        //雷達站帳號登入資訊
        $account = User::get('account');
        $name = User::get('name');
        $lv2Rid = User::get('id');
        $sn = Input::post('sn');
        $date1 = Input::post('getdate1');
        $date2 = Input::post('getdate2');
        
        $where = array();
        if (Input::post('getdate1') && Input::post('getdate2')) {
            $where[] = "odr005 = ? AND odr004 = ? AND YEAR(odr012) = ? AND MONTH(odr012) = ?";
            $params[] = $lv2Rid;
            $params[] = $sn;
            $params[] = $date1;
            $params[] = $date2;
        }

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