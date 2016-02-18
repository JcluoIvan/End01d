<?php
    include '../../conf/config.php';
    use model\LogError;

    $id = Input::get('id') ?: 0;

    $log = LogError::find_by_ler001($id);

    if (!$log) exit('資料不正確');

    $tpl->assign('log', $log);

    $tpl->display('page99_error_view.tpl');
