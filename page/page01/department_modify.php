<?php
    include '../../conf/config.php';
    use model\Agent;
    
    $id = Input::get('id') ?: 0;

    $row = Agent::find_by_age001($id) ?: new Agent;

    $title = $id ? '修改部門成員' : '新增部門成員';

    $modifyreadonly = $id ? 'readonly' : '';

    $city = array('台中市');

    $tpl->assign('modifyreadonly', $modifyreadonly);
    $tpl->assign('title', $title);
    $tpl->assign('city', $city);
    $tpl->assign('id', $id);

    $tpl->assign('row', $row->attributes());
    $tpl->assign('types', Agent::getTypes(1));
    $tpl->display('page01_department_modify.tpl');