<?php
    include '../../conf/config.php';
    use model\Member;
    $mid = Input::get('id');
    $member = Member::find_by_mem001($mid) ?: null;
    if (! $member) {
        $member = new Member;
        $member->mem005 = '原帳號刪除';
        $member->mem001 = $mid;
    }
    $tpl->assign('member', $member);
    $tpl->display('page99_member_list.tpl');
