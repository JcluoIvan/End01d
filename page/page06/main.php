<?php

    include '../../conf/config.php';

    $filepath = "page06_main.tpl";
    $rightMain = "give_point.php";

    $tpl->assign('rightMain',$rightMain);
    $tpl->assign('filepath',$filepath);
    $tpl->display('ifr_main.tpl');