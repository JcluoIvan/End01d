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
    $tpl->display('page07_radar_print.tpl');

function getSqlResult() {
    $searchKind = Input::get('searchKind');
    $search = Input::get('search');

    $date1 = Input::get('date1');
    $date2 = Input::get('date2');

    $where = $searchKind == 'no' ? "age003" : "age006";

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

    $result = Order::find_by_sql($sql, $values);

    return $result;
}