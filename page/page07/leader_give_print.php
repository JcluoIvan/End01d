<?php
    include '../../conf/config.php';

    use model\Agent;
    use model\Order;

    $result = getSqlResult();

    $rows = array();

    foreach ($result as $row) {
        if (!$row)
            continue;
        $tmp = $row->attributes(true);

        $rows[] = $tmp;
    }
    
    $tpl->assign('rows', $rows);
    $tpl->display('page07_leader_give_print.tpl');

function getSqlResult() {
    $searchKind = Input::get('searchKind');
    $search = Input::get('search');

    $date1 = Input::get('date1');
    $date2 = Input::get('date2');

    // if ($searchKind == 'no')
    $where = 'age.age003';

    if ($searchKind == 'name')
        $where = 'age.age006';

    if ($searchKind == 'percent')
        $where = 'odm027';

    $sql = "SELECT
                age.age001 AS aid
                , age.age003 AS ano
                , age014 AS store
                , GROUP_CONCAT(odm001) AS oid
                , odm027 AS percent
                , SUM(FLOOR((odm030 - odm032) * odm027 / 100)) AS bonus

            FROM order_manager
                    LEFT JOIN
                        bonus AS bon 
                        ON (odm001 = bon002 AND odm022 = bon003)
                    ,agent AS age
            WHERE
                #核帳日期
                odm005 BETWEEN ? AND ?
                #購物金入帳日期
                AND odm031 NOT IN ('null', '0000-00-00', '')
                #agentId
                AND odm022 = age.age001
                #搜尋
                AND {$where} like ?
                #獎金未核帳
                AND bon.bon004 IS NULL
            GROUP BY
                odm022, odm027
            ORDER BY
                odm022
    ";

    $values = array($date1, $date2, "%{$search}%");

    $result = Order::find_by_sql($sql, $values);

    return $result;
}