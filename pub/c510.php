<?php
// 報表 雷達站 清單

use model\Member;
use model\Order;

class c510 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        $result = $this->getOrderSql() ?: array();


        $rows = array();

        foreach ($result as $row) {
            if (!$row)
                continue;
            $tmp = $row->attributes(true);
            /* 收款 */
            // if (!$tmp['receive_date'])
            //     $tmp['pay_amount'] = 0;

            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => count($this->getOrderSql(false)),
        );
        
    }

    private function getOrderSql($getCount=true)
    {
        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        /* 每頁筆數 */
        $rp = Input::post('rp') ?: 10;

        $kind = Input::post('kind') ?: 'day';

        $where = 1;
        $data = array();

        if ($kind == 'day') {
            $date1 = Input::post('date1');
            $where = "odm006 = :data";
            $data = array(':data' => $date1);
        } else {
            $year = Input::post('year');
            $month = Input::post('month');
            $where = "YEAR(odm006) = :year AND MONTH(odm006) = :month";
            $data = array(':year' => $year, ':month' => $month);
        }

        $sql = "SELECT
                    #訂單Id
                    odm001 AS oid
                    #訂單編號no
                    , odm002 AS ono
                    #agentId
                    , odm012 AS aid
                    #核帳日
                    , odm005 AS verification_date
                    #交易日
                    , odm006 AS trans_date
                    #收款日
                    , odm008 AS receive_date
                    #總金額  = 實收 + 運費 + 使用購物金 - 退貨 
                    , SUM(odm030 + odm029 + odm004 - odm032) AS amount

                    #使用購物金
                    , SUM(odm004) AS pay_point
                    #商品金額 = 實收款 + 使用購物金
                    , SUM(odm030 + odm004) AS pay_amount
                    #運費
                    , SUM(odm029) AS fare
                    #退貨金額
                    , SUM(odm032) AS reject_amount

                    #agentNo
                    , age.age003 AS age_no
                    #agentName
                    , age.age004 AS age_name
                    #agent店名
                    , age.age014 AS age_store

                FROM 
                    order_manager
                        , agent AS age

                WHERE
                    {$where}
                    AND odm005 NOT IN ('null', '0000-00-00', '')
                    #agentId
                    AND odm012 = age.age001

                GROUP BY 
                    # 訂單編號， 雷達站id
                    odm002, odm012 
                ORDER BY
                    odm001 DESC ";

        if ($getCount) {
            $offset = (($page - 1) * $rp);
            $sql .= "LIMIT {$rp} OFFSET {$offset}";
        }

        $result = Order::find_by_sql($sql, $data);


        return $result;
    }

}