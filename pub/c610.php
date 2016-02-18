<?php
/* 購物金 - 統計表 清單 */

use model\Member;
use model\Order;

class c610 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        $result = $this->getOptions();

        $rows = array();

        foreach ($result as $row) {
            if (!$row)
                continue;
            $tmp = $row->attributes(true);
            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => count(
                $this->getOptions(true)
            ),
        );
        
    }

    private function getOptions($getCount = false) 
    {
        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        /* 每頁筆數 */
        $rp = Input::post('rp') ?: 10;

        $searchKind = Input::post('searchKind');
        $search = Input::post('search');

        $date1 = Input::post('date1');
        $date2 = Input::post('date2');

        /* mem_no */
        $where = 'mem002';

        if ($searchKind == 'mem_name')
            $where = 'mem005';
        if ($searchKind == 'age_no')
            $where = 'age003';
        if ($searchKind == 'age_name')
            $where = 'age006';

        $sql = "SELECT 
                #訂單編號no
                odm002 AS ono
                #核帳日期
                , odm005 AS verification_date
                #交易日期
                , odm006 AS trans_date
                #實收款結果(扣除退貨)
                , (odm030 - odm032) AS pay_amount
                #使用購物金結果(扣除退貨)
                , (odm004 - odm033) AS pay_point
                #發放點數
                , FLOOR(
                    (
                        (odm030 - odm032) * odm028 / 100
                    )
                ) AS give_point
                #雷達站編號
                , age.age003 AS age_no
                #會員編號
                , mem.mem002 AS mem_no

                FROM 
                    order_manager
                    , agent AS age
                    , member AS mem

                WHERE
                    #發送購物金日期
                    odm031 BETWEEN ? AND ?
                    #agentId
                    AND odm012 = age.age001
                    #memberId
                    AND odm013 = mem.mem001
                    #member 除會
                    #AND mem.mem014 = 0
                    AND {$where} like ?

                ORDER BY 
                    #發送購物金日期
                    odm031 DESC
                ";

        $values = array($date1, $date2, "%{$search}%");

        if (!$getCount) {
            $offset = (($page - 1) * $rp);
            $sql .= "LIMIT {$rp} OFFSET {$offset}";
        }

        $result = Order::find_by_sql($sql, $values);

        return $result;
    }

}