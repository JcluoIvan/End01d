<?php
    include '../../conf/config.php';

    if(User::get('type') != 'L'){ exit(); }

    $filepath = "page09_main.tpl";
    $rightMain = "command_list.php";

    $tpl->assign('rightMain',$rightMain);
    $tpl->assign('filepath',$filepath);
    $tpl->display('ifr_main.tpl');

?>