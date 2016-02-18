<?php

    include '../../conf/config.php';
    use model\Agent;

    $pid = Input::get('pid') ?: Input::get('lid');

    $url = $pid ? "organize_member.php" : "organize.php";

    $type = $pid ? 'R' : 'L';
    $backTitle = '';

    if ($type == 'R')
        $backTitle = '專業經理人';

    $title = Agent::getCorrespondTypes($type);


    $tpl->assign('url', $url);
    $tpl->assign('backTitle', $backTitle);
    $tpl->assign('title', $title);
    $tpl->assign('pid', $pid);

    $tpl->display('page01_organize.tpl');



