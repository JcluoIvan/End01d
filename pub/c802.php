<?php
use model\Order;
use model\Reject;
use model\Swap;
use model\Member;

class c802 extends pub\GatewayApi{

    public function run() {
        
        $rows = array();
        $result = Order::with(
            Order::all($this->options()),
            array('member')
        );

        foreach ($result as $row) {
            $member = $row->member ?: new Member;
            $tmp = $row->attributes(true);
            // $tmp['check_status'] = $row->odm005 ? $row->odm005 : null;
            $tmp['member_no'] = $member->mem002 ?: '資料遺失/不正確';
            $tmp['member_name'] = $member->mem005 ?: '資料遺失/不正確';
            $tmp['methods'] = Order::getMethods($row->odm009);
            // $tmp['getmode'] = Order::getMode($row->odm010);
            $cash = $tmp['total'] - $tmp['reject_shopgold'];
            $tmp['total'] = $cash;
            $tmp['getmode'] = implode(',', array(
                $row->odm010,
                $row->odm011,
                ($row->odm007 ? $row->odm007->format('Y-m-d') : ''),
            ));
            
            //購物金(回饋金)
            $tmp['shoppingGold'] = floor( ($tmp['money']-$tmp['reject_shopgold']) * $tmp['mpercent'] / 100);
            
            $rows[] = $tmp;
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Order::count($this->options(true)),
        );
        
    }

    public function options($is_count = false) {
        $rid = User::get('id');
        $type = Input::post('search');
        $search = Input::post('rno');

        $where = array(
            'odm022 = ? AND YEAR(odm006) = ? AND MONTH(odm006) = ? AND odm010 = ? ', 
            $rid,
            Input::post('year'),
            Input::post('month'),
            'csv'
        );
        /* 會員手機 or 訂單編號 or 會員編號 */
        if (mb_strlen($search)) {
            $search = "%{$search}%";
            if($type == 'phone'){
                $phone = Input::post('rno');
                $memberID = $this->findMember($phone);
                $where[0] .= ' AND odm013 IN (?) ';
                $where[] = $memberID;
            }elseif($type == 'oid'){
                $where[0] .= ' AND odm002 LIKE ? ';
                $where[] = $search;
            }else{
                $members = array();
                $options = array('conditions' => array('mem002 LIKE ?', $search));
                foreach (Member::all($options) as $row) {
                    $members[] = $row->mem001;
                }
                if (count($members)) {
                    $where[0] .= ' AND odm013 IN ?';
                    $where[] = $members;
                } else {
                    $where[0] .= ' AND 0';
                }
            }
        }

        $options = array(
            'conditions' => $where
        );
        if (! $is_count) {
            $rp = $this->rp();
            $page = $this->page();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'odm006 DESC, odm001 DESC';

        }
        return $options;
    }

    private function getOptions(){
            $id = User::get('id');
            $search = Input::post('search');
            $searchData = Input::post('rno');
            $methods = 'house';
            $year = Input::post('year');
            $month = Input::post('month');
            $where = array();

            switch ($search) {
                case 'oid':
                    if($searchData){
                        $where[] = 'odm002 LIKE ? AND odm010 = ? AND odm022 = ? AND ( YEAR(odm006) = ? AND MONTH(odm006) = ?)';
                        $params[] = "%".$searchData."%";
                        $params[] = $methods;
                        $params[] = $id;
                        $params[] = $year;
                        $params[] = $month;
                    }else{
                        // $where = array();
                        $where[] = 'odm010 = ? AND odm022 = ? AND ( YEAR(odm006) = ? AND MONTH(odm006) = ?)';
                        $params[] = $methods;
                        $params[] = $id;
                        $params[] = $year;
                        $params[] = $month;    
                    }
                    break;
                case 'mid':
                    if($searchData){
                        $memberData = Member::find_by_mem002($searchData);
                        $member = $memberData->attributes(true);
                        $searchData = $member['id'];

                        $where[] = 'odm013 LIKE ? AND odm010 = ? AND odm022 = ? AND ( YEAR(odm006) = ? AND MONTH(odm006) = ?)';
                        $params[] = "%".$searchData."%";
                        $params[] = $methods;
                        $params[] = $id;
                        $params[] = $year;
                        $params[] = $month;
                    }else{
                        // $where = array();
                        $where[] = 'odm010 = ? AND odm022 = ? AND ( YEAR(odm006) = ? AND MONTH(odm006) = ?)';
                        $params[] = $methods;
                        $params[] = $id;  
                        $params[] = $year;
                        $params[] = $month;  
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

}