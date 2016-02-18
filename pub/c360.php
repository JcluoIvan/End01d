<?php
use model\Order;

class c360 {

    public function run() 
    {
        
        // $result = Order::with(
        //         Order::find('all', $this->options()),
        //         array('agent', 'editor')
        //     );
        $result = Order::all($this->options());
        
        $rows = array();
        $clearing_date = System::get('clearing_date');
        foreach ($result as $row) {
            $tmp = $row->attributes();
            $time = strtotime($row->completed_at);
            $diff = strtotime(date('Y/m/d')) - $time;
            $tmp['days'] = floor($diff / (24 * 3600));
            $tmp['completed_at'] = date('Y-m-d', $time);
            $rows[] = $tmp;
        }
        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Order::count($this->options(true)),
            'clearing_date' => System::get('clearing_date'),
        );

    }

    public function page() 
    {
        /* 目前頁數 */
        return intval(Input::post('page')) ?: 1;
    }
    public function rp() 
    {
        /* 每頁筆數 */
        return intval(Input::post('rp')) ?: 10;
    }

    public function options($is_count = false) 
    {
        if ($is_count) {
            return array(
                'select' => 'odm006',
                'conditions' => 'odm006 IS NOT NULL',
                'group' => 'odm006'
            );
        }

        $page = $this->page();
        $rp = $this->rp();
         return array(
            'select' => implode(', ', array(
                'odm006 AS completed_at',
                'SUM(IF(odm031, 1, 0)) AS finish',
                'SUM(IF(odm031, 0, 1)) AS pend',
                'SUM(odm030) AS money'
            )),
            'conditions' => 'odm006 iS NOT NULL',
            'group' => 'odm006',
            'order' => 'odm006 DESC',
            'offset' => ($page - 1) * $rp,
            'limit' => $rp,
        );

    }

    public function old_options($is_count = false) 
    {
        if ($is_count) {
            return array('conditions' => 'odm005 is not null');
        }

        // $now = new DateTime;
        // $now->sub(new DateInterval("P7D"));

        $page = $this->page();
        $rp = $this->rp();

        $joins = implode(' ', array(
            'LEFT JOIN (
                SELECT COUNT(1) `count`, odm005 AS date
                FROM order_manager WHERE odm031 is null OR ! odm031 
                GROUP BY odm005
            ) AS p ON (odm005 = p.date)',
            'LEFT JOIN (
                SELECT COUNT(1) `count`, odm005 AS date 
                FROM order_manager WHERE odm031 is not null
                GROUP BY odm005
            ) AS f ON (odm005 = f.date)'
        ));
        $options = array(
            'select' => implode(',', array(
                'IFNULL(p.count, 0) AS padding',
                'IFNULL(f.count, 0) AS finish',
                'SUM(odm030) AS money',
                'odm005 AS completed_at'
            )),
            'conditions' => 'odm005 is not null',
            'joins' => $joins,
            'group' => 'odm005 DESC',
            'offset' => ($page - 1) * $rp,
            'limit' => $rp,
            'order' => 'odm005 DESC'
        );
        return $options;
    }


}