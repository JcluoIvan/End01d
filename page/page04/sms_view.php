<?php
    include '../../conf/config.php';
    use model\News;

    $id = Input::get('id') ?: 0;

    $row = News::find_by_new001($id) ?: null;

    $tpl->assign('row', $row);
    $tpl->display('page04_sms_view.tpl');
