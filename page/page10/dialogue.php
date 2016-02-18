<?php
    /* 客服記錄 */

    include '../../conf/config.php';

    $mid = Input::get('id');

    $tpl->assign('mid', $mid);
    $tpl->display('page10_dialogue.tpl');