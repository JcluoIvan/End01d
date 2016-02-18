<?php
    include '../../conf/config.php';
    use model\LogOrder;
    use model\Member;
    use model\Agent;

    $id = Input::get('id') ?: 0;

    $log = LogOrder::with(
        LogOrder::find_by_lod001($id),
        array('editor', 'order', 'order.member')
    );

    if (! $log) exit('資料不正確');

    $order = $log->order;
    $editor = $log->editor;
    $member = $order ? $order->member : null;

    // $editor = Agent::find_by_age001($log->lmb002);
    // $member = Member::find_by_mem001($log->lmb003);

    $tpl->assign('log', $log);
    $tpl->assign('order', $order);
    $tpl->assign('editor', $editor);
    $tpl->assign('member', $member);
    $tpl->display('page99_order_view.tpl');
