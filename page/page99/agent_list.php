<?php
    include '../../conf/config.php';
    use model\Agent;
    $aid = Input::get('id');
    $agent = Agent::find_by_age001($aid) ?: null;
    if (! $agent) {
        $agent = new Agent;
        $agent->age006 = '原帳號刪除';
        $agent->age001 = $aid;
    }
    $tpl->assign('agent', $agent);
    $tpl->display('page99_agent_list.tpl');
