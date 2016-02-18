<?php
    /* 客服記錄 新增 修改 */

    include '../../conf/config.php';
    use model\Dialogue;
    use model\Agent;

    $id = Input::get('id');
    $mid = Input::get('mid');

    $row = $id ? Dialogue::find_by_dia001($id) : new Dialogue;
    $rows = $row->attributes();

    $rows['dia005'] = $rows['dia005']
        ? date_format($rows['dia005'], 'Y-m-d H:i:s')
        : date('Y/m/d H:i:s');

    // $rows['dia003'] = $rows['dia003'] ?: User::get('name');

    if ($id) {
        $agent = Agent::find_by_age001($rows['dia003']) ?: new Agent;
        $rows['dia003'] = $agent->age006;
    }

    $title = $id ? '修改客服記錄' : '新增客服記錄';

    $tpl->assign('mid', $mid);
    $tpl->assign('title', $title);
    $tpl->assign('id', $id);
    $tpl->assign('rows', $rows);
    $tpl->display('page01_dialogue_modify.tpl');


    

