<?php

    include '../../conf/config.php';
    use model\News;

    $list = News::find('all', array('order' => 'new005'));

    $tpl->display('page04_app.tpl');
