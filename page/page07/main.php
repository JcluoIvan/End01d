<?php

    include '../../conf/config.php';

    $filepath = "page07_main.tpl";
    $rightMain = "radar_bonus.php";

    $tpl->assign('rightMain',$rightMain);
    $tpl->assign('filepath',$filepath);
    $tpl->display('ifr_main.tpl');