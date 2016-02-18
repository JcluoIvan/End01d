<?php

    include '../../conf/config.php';

    $year = date('Y');
    $month = intval(date('m'));

    $year_ary = array();
    $month_ary = array();
    for ($i = 2006; $i <= intval($year); $i++) {
        $year_ary[$i] = $i;
    }

    for ($i = 1; $i <= 12; $i++) {
        $month_ary[$i] = $i; 
    }

    krsort($year_ary);

    $tpl->assign('month', $month); 
    $tpl->assign('month_ary', $month_ary);
    $tpl->assign('year_ary', $year_ary);
    $tpl->display('page05_report_month.tpl');