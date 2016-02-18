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
        $tmp['mlv1'] = $tmp['mlv1'] ? "{$tmp['mlv1']} / {$tmp['give_point']}" : null;
        $tmp['mlv2'] = $tmp['mlv2'] ? "{$tmp['mlv2']} / {$tmp['give_point']}" : null;
        $tmp['mlv3'] = $tmp['mlv3'] ? "{$tmp['mlv3']} / {$tmp['give_point']}" : null;

        $rows[] = $tmp;
    }
    
    $tpl->assign('rows', $rows);
    $tpl->display('page06_point_print.tpl');

    function getSqlResult() {

        $searchKind = Input::get('searchKind');
        $search = Input::get('search');

        $date1 = Input::get('date1');
        $date2 = Input::get('date2');

        /* mem_phone */
        $register_where = '1';
        $where = 'mem.mem011';

        if ($searchKind == 'mem_no'){
            $where = 'mem.mem002';
            if ($search) $register_where = "mem002 like '%" . mysql_escape_string($search) . "%'";
        }
        if ($searchKind == 'mem_name'){
            $where = 'mem.mem005';
            if ($search) $register_where = "mem005 like '%" . mysql_escape_string($search) . "%'";
        }
        if ($searchKind == 'age_phone')
            $where = 'age012';
        if ($searchKind == 'age_no')
            $where = 'age003';
        if ($searchKind == 'age_name')
            $where = 'age006';

        $sql = "SELECT tab.* 
                       , age003 AS age_no
                FROM (
                    SELECT 
                        '註冊加值' AS ono
                        #核帳日期
                        , '' AS verification_date
                        #交易日期
                        , '' AS trans_date
                        #人帳日期
                        , mem006 AS give_date

                        #使用購物金(扣退貨)
                        -- , (SUM(odm004) - IFNULL(SUM(odr.reject_point), 0)) AS pay_point

                        #實收金額
                        -- , (SUM(odm030) - IFNULL(SUM(odr.reject_amount), 0)) AS pay_amount
                        , 0 AS pay_amount
                        #發放點數(扣除點數) = 實收金額 * 會員%
                        , mpr005 AS give_point

                        #雷達站編號
                        #, '' AS age_no
                        #會員編號
                        , mem002 AS mem_no
                        #上層
                        , 0 AS mlv3
                        , 0 AS mlv2
                        , 0 AS mlv1
                        , mem017 AS parent_id
                    FROM member_point_record
                        LEFT JOIN member ON (mem001 = mpr002)

                    WHERE 
                        mpr003 = 'register'
                        AND mem006 BETWEEN ? AND ?
                        AND {$register_where}
                    UNION 
                    SELECT
                        #訂單編號
                        odm002 AS ono
                        #核帳日期
                        , odm005 AS verification_date
                        #交易日期
                        , odm006 AS trans_date
                        #人帳日期
                        , odm031 AS give_date

                        #使用購物金(扣退貨)
                        -- , (SUM(odm004) - IFNULL(SUM(odr.reject_point), 0)) AS pay_point

                        #實收金額
                        -- , (SUM(odm030) - IFNULL(SUM(odr.reject_amount), 0)) AS pay_amount
                        , (odm030 - odm032) AS pay_amount
                        #發放點數(扣除點數) = 實收金額 * 會員%
                        , FLOOR(
                            -- (SUM(odm030) - IFNULL(SUM(odr.reject_amount), 0)) * odm028 / 100
                            (odm030 - odm032) * odm028 / 100
                        ) AS give_point

                        #雷達站編號
                        #, age.age003 AS age_no
                        #會員編號
                        , mem.mem002 AS mem_no
                        #上層
                        , IFNULL(mlv3.mem005, NULL) AS mlv3
                        , IFNULL(mlv2.mem005, NULL) AS mlv2
                        , IFNULL(mlv1.mem005, NULL) AS mlv1
                        , odm013 AS parent_id
                    FROM
                        order_manager
                            LEFT JOIN (
                                SELECT mem001, mem005, mem011 FROM member
                            ) AS mlv3 ON (odm023 = mlv3.mem001)

                            LEFT JOIN (
                                SELECT mem001, mem005, mem011 FROM member
                            ) AS mlv2 ON (odm024 = mlv2.mem001)

                            LEFT JOIN (
                                SELECT mem001, mem005, mem011 FROM member
                            ) AS mlv1 ON (odm025 = mlv1.mem001)

                        # , agent AS age
                        , member AS mem

                    WHERE
                        #入帳日期
                        DATE(odm031) BETWEEN ? AND ?
                        #memberId
                        AND odm013 = mem.mem001
                        #agentId
                        # AND odm012 = age.age001

                        AND {$where} like ?

                    GROUP BY
                        odm001, odm002
                ) AS tab
                LEFT JOIN agent ON parent_id = age001
                ORDER BY give_date DESC
                    #ORDER BY
                    #    #入帳日期
                    #    odm031 DESC
        ";

        $values = array("{$date1} 00:00:00", "{$date2} 23:59:59", "{$date1}", "{$date2}", "%{$search}%");

        $result = Order::find_by_sql($sql, $values) ?: new Order;

        return $result;
}