<?php
    include '../../conf/config.php';
    use model\MobileTitle;

    $images = MobileTitle::all(array('order' => 'mbt004'));
    $tpl->assign('images', $images);
    $tpl->display('page97_title_image.tpl');
