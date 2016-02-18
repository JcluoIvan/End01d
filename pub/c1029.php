<?php
use model\Agent;
use model\Order;
use model\Reject;
use model\Member;
use model\Product;

class c1029 extends pub\GatewayApi{

    public function run() {
        $page = Input::post('page') ?: 1;
        $rows = array();
        $reject = array();
        $item = Input::post('item');
        $datetype = Input::post('datetype');
        $no = Input::post('no');
        
        $reject = Reject::with(
            Reject::find('all', $this->getOptions()),
            array('order','member','ar','product')
        );
        $rows = array();
        foreach ($reject as $row) {
            $order = $row->order ?: new Order;
            $oorder = $order->attributes(true);
            $member = $row->member ?: new Member;
            $ar = $row->ar ?: new Agent;
            $product = $row->product ?: new Product;
            $tmp = $row->attributes(true);
            $tmp['datecheck'] = $oorder['check_date'];
            $tmp['ono'] = $order->odm002;
            $tmp['mname'] = $order->odm014;
            $tmp['mno'] = $member->mem002;
            $tmp['arno'] = $ar->age003;
            $tmp['pname'] = $product->pdm004;
            $tmp['checkDate'] = $row->odr016 ? $row->odr016->format('Y-m-d') : '';
            $tmp['rejectdate'] = $row->odr017 ? $row->odr017->format('Y-m-d') : '';
            $rejectdate = explode(" ", $tmp['rejectdate']);
            $tmp['rejectdate'] = $rejectdate[0];
            // $tmp['status'] = Reject::getType($row->odr013);
            if($tmp['status']==null or $tmp['status']==0){
                $tmp['statusName'] = '處理中';
                $tmp['checkDate'] = "N";
                $tmp['checkDate2'] = null;
                $tmp['canceldate'] = null;
            }elseif($tmp['status']==1){
                $tmp['statusName'] = '核帳';
                $date = explode(" ", $tmp['checkDate']);
                $tmp['checkDate2'] = $date[0];
                $tmp['canceldate'] = null;
            }elseif($tmp['status']==2){
                $tmp['statusName'] = '註銷';
                $tmp['checkDate'] = "cancel";
                $tmp['checkDate2'] = null;
                $tmp['canceldate'] = $row->dateFormat('odr016');
            }
            // $date = explode(" ", $tmp['checkDate']);
            // $tmp['checkDate'] = $date[0] ?: "N";
            // $tmp['checkDate2'] = $date[0];
            $rows[] = $tmp;
        }
        // $count = count($rows);
        // $count = intval(Reject::count($options));
        $count = intval(Reject::count($this->getOptions('count')));
                    
        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
    }
    private function findOrder($no, $mids = array(0), $phone = '') {
        $options = array(
            'select' => 'odm001 AS id',
            'conditions' => array(
                'odm002 = ? OR odm013 IN (?) OR odm015 = ? ',
                $no,
                $mids,
                $phone
            )
        );
        $values = array();
        foreach (Order::all($options) as $row) {
            $values[] = $row->id;
        }
        return $values ?: array(0);
    }

    private function getOptions() 
    {
        $no = Input::post('no');
        $item = Input::post('item');
        $datetype = Input::post('datetype');
        $search_date2 = Input::post('date2');
        $today = date("Y-m-d");
        if($search_date2==$today){
             $date2 = date("Y-m-d", strtotime($search_date2."+1 day"));
        }else{
            $date2 = Input::post('date2');
        }
        $date1 = Input::post('date1');

        $where = array();

        if ($query = Input::post('no')) {
            $memberID = $this->findMember($query);
            $orderID = $this->findOrder($query, $memberID, $query);
            $where[] = "odr002 IN (?)";
            $params[] = $orderID ?: array(0);
        } else {
            switch ($item) {
                case 'all':
                    $data1 = null;
                    $data2 = 0;
                    
                    $where[] = "odr017 is null or odr017 is not null";
                    $params[] = $data2;
                    break;
                case 'RN':
                    $data1 = null;
                    $data2 = 0;
                    
                    $where[] = "odr017 is null or odr017 = ?";
                    $params[] = $data2;  
                    break;
                case 'RY':
                    $data1 = null;
                    $data2 = 0;
                    
                    $where[] = "(odr016 is null or odr016 is not null) AND odr017 is not null";
                    $params[] = $data2;   
                    break;
                // 未核帳
                case 'N':
                    $data1 = null;
                    $data2 = '0000-00-00 00:00:00';
                    
                    $where[] = "odr016 is null or odr016 = ?";
                    $params[] = $data2;
                    break;
                // 已核帳
                case 'Y':
                    $data1 = null;
                    $data2 = 0;
                        
                    $where[] = "odr016 is not null AND odr016 BETWEEN ? AND ?";
                    $params[] = $date1;
                    $params[] = $date2;
                    break;
                // 已註銷
                case 'cannel':
                    $cannel = 2;
                        
                    $where[] = "odr013 = ?";
                    $params[] = $cannel;
                    break;
                default:
                    # code...
                    break;
            }
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