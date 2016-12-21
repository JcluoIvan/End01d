<?php
/* 購物金 - 雷達 = 發放 清單 */

use model\Order;
use model\Bonus;


class c740 {

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

        /* phone */
        $where = 'age.age012';

        if ($searchKind == 'no')
            $where = 'age.age003';
        if ($searchKind == 'name')
            $where = 'age.age006';
        if ($searchKind == 'percent')
            $where = 'odm026';

        $sql = "SELECT
                    age.age001 AS aid
                    , age.age003 AS ano
                    , GROUP_CONCAT(odm001) AS oid
                    , odm026 AS percent
                    , SUM(FLOOR((odm030 - odm032) * odm026 / 100)) AS bonus

                FROM order_manager
                        LEFT JOIN
                            bonus AS bon
                            ON (odm001 = bon002 AND odm021 = bon003)
                        ,agent AS age
                WHERE
                    #核帳日期
                    odm005 BETWEEN ? AND ?
                    #購物金入帳日期
                    AND (odm031 IS NOT NULL AND odm031 > 0)
                    #agentId
                    AND odm021 = age.age001
                    #搜尋
                    AND {$where} like ?
                    #獎金未核帳
                    AND bon.bon004 IS NULL
                    AND odm041 IS NULL
                GROUP BY
                    odm021, odm026
                ORDER BY
                    odm021
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