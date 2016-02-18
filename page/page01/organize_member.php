<?php

    include '../../conf/config.php';
    use model\Agent;
    
    $lid = Input::get('lid');
    $pid = Input::get('pid');

    $title = "會員";

    $tpl->assign('title', $title);
    $tpl->assign('lid', $lid);
    $tpl->assign('pid', $pid);
    $tpl->display('page01_organize_member.tpl');

