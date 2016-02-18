<?php

    include '../../conf/config.php';

    $filepath = "page05_main.tpl";
    $rightMain = "report_day.php";

    $tpl->assign('rightMain',$rightMain);
    $tpl->assign('filepath',$filepath);
    $tpl->display('ifr_main.tpl');

