<?php
    include '../../conf/config.php';

    if(User::get('type') != 'R'){ exit(); }

    $filepath = "page08_main.tpl";
    $rightMain = "command_list.php";

    $tpl->assign('rightMain',$rightMain);
    $tpl->assign('filepath',$filepath);
    $tpl->display('ifr_main.tpl');

?>