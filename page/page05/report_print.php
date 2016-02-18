<?php
    include '../../conf/config.php';

    use model\Agent;
    use model\Order;

    $result = getSqlResult() ?: array();

    $rows = array();

    foreach ($result as $row) {
        if (!$row)
            continue;
        $tmp = $row->attributes(true);

        $rows[] = $tmp;
    }
    
    $tpl->assign('rows', $rows);
    $tpl->display('page05_report_print.tpl');

function getSqlResult() {

    $kind = Input::get('kind') ?: 'day';

    $where = 1;
    $data = array();

    if ($kind == 'day') {
        $date1 = Input::get('date1');
        $where = "odm006 = :data";
        $data = array(':data' => $date1);
    } else {
        $year = Input::get('year');
        $month = Input::get('month');
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

    $result = Order::find_by_sql($sql, $data);

    return $result;
}