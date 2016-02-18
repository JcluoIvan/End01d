<?php
/* 購物金 - 雷達 - 統計表 清單 */

use model\Member;
use model\Order;

class c710 {

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

        /*phone*/
        $where = 'age.age012';
        if ($searchKind == 'no')
            $where = 'age.age003';
        if ($searchKind == 'name')
            $where = 'age.age006';

        $sql = "SELECT 
                odm001 AS oid
                #訂單編號no
                ,odm002 AS ono
                #核帳日期
                , odm005 AS verification_date
                #交易日期
                , odm006 AS trans_date
                #percen
                , odm027 AS percent
                #實收款結果(扣除退貨)
                , SUM(odm030 - odm032) AS pay_amount
                #使用購物金結果(扣除退貨)
                , SUM(odm004 - odm033) AS pay_point
                #應付獎金(實收款 * 雷達站% / 100)
                , SUM(FLOOR((odm030 - odm032) * odm027 / 100)) AS give_bonus
                #入帳(購物金)日期
                ,odm031 AS give_point_date

                #雷達站流水號
                , age.age001 AS age_id
                #雷達站編號
                , age.age003 AS age_no
                #店名
                , age.age014 AS age_store

                #獎金核帳日
                , bon.bon004 AS bonus_verification

                FROM 
                    order_manager
                        , bonus AS bon
                        , agent AS age
                WHERE
                    #訂單核帳日
                    odm005 NOT IN ('null', '0000-00-00', '')
                    #購物金入帳日期
                    AND odm031 NOT IN ('null', '0000-00-00', '')
                    #agentId
                    AND odm022 = age.age001
                    #顯示雷達站
                    AND age.age018 != 0 

                    #核帳日期
                    AND bon004 BETWEEN ? AND ?
                    AND odm001 = bon002
                    AND odm022 = bon003

                    #搜尋
                    AND {$where} like ?
                    
                GROUP BY
                    odm001
                ORDER BY 
                    #雷達站 #核帳日期
                    odm022, bon004 DESC
                ";

        $values = array($date1, $date2, "%{$search}%");

        if (! $getCount) {
            $offset = (($page - 1) * $rp);
            $sql .= "LIMIT {$rp} OFFSET {$offset}";
        }

        $result = Order::find_by_sql($sql, $values);

        return $result;
    }

}