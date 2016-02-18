<?php
    include '../../conf/config.php';
    use model\Member;

    $id = Input::get('id') ?: 0;
    $row = Member::find_by_mem001($id) ?: new Member;

    $tpl->assign('row', $row);
    $tpl->assign('id', $id);
    $tpl->display('page01_friends.tpl');



