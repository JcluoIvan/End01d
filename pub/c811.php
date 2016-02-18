<?php
use model\Agent;
use model\Order;
use model\Reject;
use model\Member;
use model\Product;

class c811 extends pub\GatewayApi{

    public function run() {
        
        $reject = Reject::with(
            Reject::find('all', $this->options()),
            array('order','member','ar','product')
        );
        $rows = array();
        foreach ($reject as $row) {
            $order = $row->order ?: new Order;
            $member = $row->member ?: new Member;
            $ar = $row->ar ?: new Agent;
            $product = $row->product ?: new Product;
            $tmp = $row->attributes(true);
            $tmp['datecheck'] = $order->odm005;
            $tmp['ono'] = $order->odm002;
            $tmp['mname'] = $order->odm014;
            $tmp['mno'] = $member->mem002;
            $tmp['arno'] = $ar->age003;
            $tmp['pname'] = $product->pdm004;
            $tmp['rejectdate'] = $row->dateFormat('odr017');

            # 處理狀態
            $tmp['statusName'] = $row->getItemType();

            # 取消日期
            $tmp['canceldate'] = $row->cancelDate();

            # 核帳日 
            $tmp['checkDate2'] = $row->finishDate();
            $rows[] = $tmp;
        }
                    
        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Reject::count($this->options(true)),
        );
    }
    private function findOrder($no, $mids = array(0), $phone = '') {
        //登入者的ID
        $id = User::get('id');
        $options = array(
            'select' => 'odm001 AS id',
            'conditions' => array(
                'odm002 LIKE ? OR odm013 IN (?) OR odm015 = ? AND odm022 = ?',
                "%".$no."%",
                $mids,
                $phone,
                $id
            )
        );
        $values = array();
        foreach (Order::all($options) as $row) {
            $values[] = $row->id;
        }
        return $values ?: array(0);
    }


    private function sdate() {
        $time = strtotime(Input::post('date1')) ?: time();
        return date('Y-m-d', $time);
    }
    private function edate() {
        $time = strtotime(Input::post('date2')) ?: time();
        return date('Y-m-d 23:59:59', $time);
    }

    public function options( $is_count = false) 
    {
        $conditions = array('', User::get('id'));
        $where = array('odr005 = ?');

        $query = Input::post('no');
        if (mb_strlen($query) > 0) {
            $mids = $this->findMember($query);
            $conditions[] = $this->findOrder($query, $mids, $query) ?: array();
            $where[] = "odr002 IN (?)";
        } else {
            switch (Input::post('item')) {
                case 'RY': 
                    $where[] = 'odr017 IS NOT NULL';
                    break;
                case 'N':
                    $where[] = 'odr013 = 0';
                    break;
                case 'Y':
                    $where[] = 'odr013 = 1';
                    break;
                case 'cancel':
                    $where[] = 'odr013 = 2';
                    break;
            }

            switch (Input::post('itemdate')) {
                case 'build':
                    $where[] = "odr012 BETWEEN ? AND ?";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
                case 'reject':
                    $where[] = "odr017 BETWEEN ? AND ?";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
                case 'check':
                    $where[] = "odr013 = 1 AND odr016 BETWEEN ? AND ? ";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
                case 'cannel':
                    $where[] = "odr013 = 2 AND odr016 BETWEEN ? AND ?";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
            }
            // switch ($item) {
            //     case 'all':
            //         $data1 = null;
            //         $data2 = 0;

            //         switch ($itemdate) {
            //             case 'build':
            //                 $where[] = "odr005 = ? AND odr012 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;    
            //                 break;
            //             case 'reject':
            //                 $where[] = "odr005 = ? AND odr013 = 0 AND odr017 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //             case 'check':
            //                 $where[] = "odr005 = ? AND odr013 = 1 AND odr016 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //             case 'cannel':
            //                 $where[] = "odr005 = ? AND odr013 = 2 AND odr016 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //         }
                    
            //         break;
            //     case 'RN':
            //         $data1 = null;
            //         $data2 = 0;
                    
            //         switch ($itemdate) {
            //             case 'build':
            //                 $where[] = "odr005 = ? AND odr013 = 0 AND odr012 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;    
            //                 break;
            //         }

            //         // $where[] = "odr017 is null or odr017 = ?";
            //         // $params[] = $data2;  
            //         break;
            //     case 'RY':
            //         $data1 = null;
            //         $data2 = 0;
                    
            //         switch ($itemdate) {
            //             case 'build':
            //                 $where[] = "odr005 = ? AND odr013 = 0 AND odr012 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;    
            //                 break;
            //             case 'reject':
            //                 $where[] = "odr005 = ? AND odr013 = 0 AND odr017 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //         }

            //         // $where[] = "(odr016 is null or odr016 is not null) AND odr017 is not null";
            //         // $params[] = $data2;   
            //         break;
            //     // 未核帳
            //     case 'N':
            //         $data1 = null;
            //         $data2 = '0000-00-00 00:00:00';
                    
            //         switch ($itemdate) {
            //             case 'build':
            //                 $where[] = "odr005 =? AND odr013 = 0 AND odr012 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;    
            //                 break;
            //             case 'reject':
            //                 $where[] = "odr005 = ? AND odr013 = 0 AND odr017 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //         }

            //         // $where[] = "odr016 is null or odr016 = ?";
            //         // $params[] = $data2;
            //         break;
            //     // 已核帳
            //     case 'Y':
            //         $data1 = null;
            //         $data2 = 0;
                     
            //         switch ($itemdate) {
            //             case 'build':
            //                 $where[] = "odr005 = ? AND odr013 = 1 AND odr012 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;    
            //                 break;
            //             case 'reject':
            //                 $where[] = "odr005 = ? AND odr013 = 1 AND odr017 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //             case 'check':
            //                 $where[] = "odr005 = ? AND odr013 = 1 AND odr016 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //         }
                    
            //         // $where[] = "odr016 is not null AND odr016 BETWEEN ? AND ?";
            //         // $params[] = $date1;
            //         // $params[] = $date2;
            //         break;
            //     // 已註銷
            //     case 'cannel':
            //         $cannel = 2;
                    
            //         switch ($itemdate) {
            //             case 'cannel':
            //                 $where[] = "odr005 = ? AND odr013 = ? AND odr016 BETWEEN ? AND ?";
            //                 $params[] = $id;
            //                 $params[] = $cannel;
            //                 $params[] = $date1;
            //                 $params[] = $date2;
            //                 break;
            //         }

            //         // $where[] = "odr013 = ?";
            //         // $params[] = $cannel;
            //         break;
            //     default:
            //         # code...
            //         break;
            // }
        }

        $conditions[0] = implode(' AND ', $where);
        $options = array(
            'conditions' => (empty($where) ? array('1') : $conditions),
        );

        if (! $is_count){
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'odr003 DESC';
        }

        return $options;
    }

}