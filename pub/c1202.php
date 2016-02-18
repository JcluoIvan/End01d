<?php
use model\Agent;
use model\Order;
use model\Reject;
use model\Member;
use model\Product;

class c1202 extends pub\GatewayApi{

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


            $tmp['checkDate'] = $row->isProcessing() 
                ? 'N' : $row->dateFormat('odr016');

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

    private function sdate() {
        $time = strtotime(Input::post('date1')) ?: time();
        return date('Y-m-d', $time);
    }
    private function edate() {
        $time = strtotime(Input::post('date2')) ?: time();
        return date('Y-m-d 23:59:59', $time);
    }

    public function options ($is_count = false) 
    {
        $conditions = array('', );
        $where = array();

        $query = Input::post('no');
        if (mb_strlen($query) > 0) {
            $mids = $this->findMember($query);
            $conditions[] = $this->findOrder($query, $mids, $query) ?: array(0);
            $where[] = "odr002 IN (?)";
        } else {
            // $item = Input::post('item');
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