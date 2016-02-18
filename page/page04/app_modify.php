<?php
    include '../../conf/config.php';
    use model\News;
    use model\Agent;

    $id = Input::get('id') ?: 0;

    $row = News::find_by_new001($id) ?: new News;

    $tpl->assign('row', $row);
    $tpl->assign('types', News::$type_names);
    $tpl->assign('notice_for', News::$notice_for);
    $tpl->display('page04_app_modify.tpl');
