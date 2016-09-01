<?php

    include '../../conf/config.php';
    use model\Agent;

    $pid = Input::get('pid') ?: Input::get('lid');
    $type = $pid ? 'R' : 'L';

    $url = "organize_member.php";

    $backTitle = '展示中心';
    $title = Agent::getCorrespondTypes($type);


    $tpl->assign('url', $url);
    $tpl->assign('backTitle', $backTitle);
    $tpl->assign('title', $title);
    $tpl->assign('pid', $pid);

    $tpl->display('page13_organize_member.tpl');



