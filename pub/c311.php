<?php
use model\Agent;
use model\Product;
use model\Order;
use model\OrderDetail;
use model\Reject;
use model\RejectDetail;
use model\Swap;
use model\SwapDetail;
use model\Member;

class c311 extends pub\GatewayApi{

    public function run() {
        $rows = array();
        $order = Order::all($this->orderOptions(true));
        $rrows = array();
        $oid = array(0);
        foreach ($order as $k) {
            $oid[] = $k->odm001;
        }

        $result = Product::with(
            Product::all($this->productOptions(false)),
            array(
                'order_detail' => array(
                    'select' => 'odd003, SUM(odd006) AS count',
                    'conditions' => array("odd002 IN (?)", $oid),
                    'group' => 'odd003'
                ),
                'reject_detail' => array(
                    'select' => 'odr006,  SUM(odr008) as count',
                    'conditions' => array("odr002 IN (?) AND odr013 = 1", $oid),
                    'group' => 'odr006'
                ),
                'swap_detail' => array(
                    'select' => 'ods006,  SUM(ods008) as count',
                    'conditions' => array("ods002 IN (?) AND ods013 = 1", $oid),
                    'group' => 'ods006'
                )
            )
        );
        
        // 資料筆數
        $count = Product::count($this->productOptions(true));

        foreach ($result as $row) {
            $tmp = array();// $row;
            $tmp['name'] = $row->pdm004;
            $tmp['no'] = $row->pdm002;
            $tmp['order_count']     = ($row->order_detail)  ? $row->order_detail[0]->count  : 0;
            $tmp['reject_count']    = ($row->reject_detail) ? $row->reject_detail[0]->count : 0;
            $tmp['swap_count']      = ($row->swap_detail)   ? $row->swap_detail[0]->count   : 0;

            //合計
            $tmp['total_count'] = $tmp['order_count'] - $tmp['reject_count'];
            $rows[] = $tmp;

        }
        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function orderOptions($is_count = false) 
    {
        $formSearch = Input::post('rid');
        $formSearchID = Input::post('no');
        $formDate1 = Input::post('date1');
        $formDate2 = Input::post('date2');

        $where = array();
        $values = array();
        // 訂單日期
        $where[] = " odm006 BETWEEN ? AND ? ";        
        $values[] = $formDate1;
        $values[] = $formDate2;
        // 查詢指揮站
        if ($formSearch=="L") {
            $id = $this->getAgentID($formSearchID);
            $id = implode(',', $id);
            $where[] = " AND odm021 IN (?) ";                   
            $values[] = intval($id);
        }
        // 查詢雷達站
        if ($formSearch=="R") {
            $id = $this->getAgentID($formSearchID);
            $id = implode(',', $id);
            $where[] =  " AND odm022 IN (?) ";                   
            $values[] = intval($id);
        }
        // 查詢會員
        if ($formSearch=="M") {
            $id = $this->findMember($formSearchID);
            $id = implode(',', $id);
            $where[] =  " AND odm013 IN (?) ";                   
            $values[] = intval($id);
        }

        $where = count($where) ? implode(' ', $where) : '';
        array_unshift($values, $where);

        $options = array();
        $options['conditions'] = $values;
        return $options;
    }

    public function page() 
    {
        /* 目前頁數 */
        return intval(Input::post('page')) ?: 1;
    }
    public function rp() 
    {
        /* 每頁筆數 */
        return intval(Input::post('rp')) ?: 1;
        // return 1;
    }

    private function productOptions($is_count = false) 
    {
        if (! $is_count) {
            $rp = $this->rp();
            $page = $this->page();
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'pdm014';
        }else{
            $options['order'] = 'pdm014';
        }

        return $options;
    }

    public function getAgentID($formSearchID) {
        $sql = 'SELECT * '
                    . ' FROM agent '
                    . " WHERE age003 LIKE ? ";
        $result = Agent::find_by_sql($sql, array("%{$formSearchID}%"));
        $id = array();
        foreach ($result as $r) {
            $id[] = $r->age001;
        }
        return $id;
    }

    public function getMemberID($formSearchID) {
        $sql = 'SELECT * '
                    . ' FROM member '
                    . " WHERE mem003 LIKE ? ";
        $result = Member::find_by_sql($sql, array("%{$formSearchID}%"));
        $id = array();
        foreach ($result as $r) {
            $id[] = $r->mem001;
        }
        return $id;
    } 

}