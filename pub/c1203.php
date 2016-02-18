<?php
use model\Agent;
use model\Order;
use model\Swap;
use model\Member;
use model\Product;

class c1203 extends pub\GatewayApi{

    public function run() {
        $swap = Swap::with(
            Swap::find('all', $this->options()),
            array('order','ar','member','product')
        );


        $rows = array();
        foreach ($swap as $row) {
            $order = $row->order ?: new Order;
            $ar = $row->ar ?: new Agent;
            $member = $row->member ?: new Member;
            $product = $row->product ?: new Product;
            $tmp = $row->attributes(true);
            $tmp['ono'] = $order->odm002;
            $tmp['arno'] = $ar->age003;
            $tmp['mname'] = $order->odm014;
            $tmp['mno'] = $member->mem002;
            $tmp['pname'] = $product->pdm004;
            $tmp['swapdate'] = $row->dateFormat('ods015'); // ? $row->ods015->format('Y-m-d') : '';

            $tmp['checkDate'] = $row->isProcessing() ? 'N' : $row->dateFormat('ods014');
            
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
                'total' => Swap::count($this->options(true)),
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

    public function options( $is_count = false ) 
    {

        $conditions = array('', );
        $where = array();

        $query = Input::post('no');
        if (mb_strlen($query) > 0) {
            $where[] = "ods002 IN (?)";
            $mids = $this->findMember($query);
            $conditions[] = $this->findOrder($query, $mids, $query) ?: array(0);
        } else {
            switch (Input::post('item')) {
                case 'SY': 
                    $where[] = 'ods015 IS NOT NULL';
                    break;
                case 'N':
                    $where[] = 'ods013 = 0';
                    break;
                case 'Y':
                    $where[] = 'ods013 = 1';
                    break;
                case 'cancel':
                    $where[] = 'ods013 = 2';
                    break;
            }

            switch (Input::post('itemdate')) {
                case 'build':
                    $where[] = "ods012 BETWEEN ? AND ?";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
                case 'swap':
                    $where[] = "ods015 BETWEEN ? AND ?";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
                case 'check':
                    $where[] = "ods013 = 1 AND ods014 BETWEEN ? AND ? ";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
                case 'cannel':
                    $where[] = "ods013 = 2 AND ods014 BETWEEN ? AND ?";
                    $conditions[] = $this->sdate();
                    $conditions[] = $this->edate();
                    break;
            }
        }

        $conditions[0] = implode(' AND ', $where);
        $options = array(
            'conditions' => (empty($where) ? array('1') : $conditions),
        );

        if(!$is_count){
            $page = $this->page();
            $rp = $this->rp();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'ods003 DESC';
        }

        return $options;
    }



}