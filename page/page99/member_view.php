<?php
    include '../../conf/config.php';
    use model\LogMember;
    use model\Member;
    use model\Agent;

    $id = Input::get('id') ?: 0;

    $log = LogMember::with(
        LogMember::find_by_lmb001($id),
        array('member')
    );

    if (!$log) exit('資料不正確');


    $tpl->assign('log', $log);
    $tpl->assign('member_name', $log->member ? $log->member->mem005 : 'unknown');

    $tpl->display('page99_member_view.tpl');
