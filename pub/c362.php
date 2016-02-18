<?php
use model\Order;
use model\Member;
class c362 extends pub\GatewayApi{

    public function run() 
    {
        
        $result = Order::with(
            Order::all($this->options()),
            array('member')
        );
        
        $rows = array();
        foreach ($result as $row) {
            $member = $row->member ?: new Member;
            $rows[] = array(
                'oid' => $row->odm002,
                'member' => "{$member->mem005} ( {$member->mem011} )",
                'date1' => $row->dateFormat('odm006'),  /* 交易日 */
                'date2' => $row->dateFormat('odm005'),  /* 核帳日 */
                'date3' => $row->dateFormat('odm031') ?: '-',  /* 獎金、購物金計算日 */
                'money' => $row->odm003 - $row->odm032,
                'point' => $row->getMemberPoint(),
            );
        }
        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Order::count($this->options(true))
        );

    }

    public function date($days) {
        // $clearing = System::get('clearing_date');
        // $diff_days = intval(Input::post('diff_days')) ?: 0;
        // if ($diff_days < $clearing) $this->fail("核帳未滿 {$clearing} 天，不能結算");

        $date = new DateTime;
        $date->sub(new DateInterval("P{$days}D"));
        return $date->format('Y/m/d');
    }

    public function options($is_count = false) 
    {
        
        $page = $this->page();
        $rp = $this->rp();
        $days = Input::post('days');
        $type = Input::post('type');

        $conditions = array('', $this->date($days));
        $where = array('odm006 = ?');

        $where[] = ($type  === 'pend') ? 'odm031 IS NULL' : 'odm031 IS NOT NULL';


        $conditions[0] = implode(' AND ', $where);
        $options = array(
            'conditions' => $conditions
        );
        if (! $is_count) {
            $options['order'] = 'odm001 DESC';
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
        }
        return $options;
    }


}