<?php
/* 會員購買記錄 */

    include '../../conf/config.php';

    use model\Member;

    $id = Input::get('id') ?: 0;
    $member = Member::find_by_mem001($id) ?: new Member;

    $tpl->assign('member', $member);
    $tpl->display('page11_order_record.tpl');

