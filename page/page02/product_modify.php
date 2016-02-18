<?php
    include '../../conf/config.php';
    use model\Video;
    use model\Product;
    use model\ProductItem;
    use model\ProductPhoto;


    $id = Input::get('id');
    $product = 
    $row = Product::with(
        (Product::find_by_pdm001($id) ?: new Product),
        array(
            'photo' => array('conditions' => 'pdo004 = 1'),
            'sgs' => array('conditions' => 'pdo004 = 2'),
            'edm' => array('conditions' => 'pdo004 = 3'),
        )
    );

    $items = ProductItem::getItemArray();

    $photo = $row->photo ?: array();
    $sgs = $row->sgs ?: array();
    $edm = $row->edm ?: array();

    for ($i = 0; $i < 3; $i++) {
        (empty($photo[$i])) && $photo[$i] = new ProductPhoto;
        (empty($sgs[$i])) && $sgs[$i] = new ProductPhoto;

        if ($i > 0) continue;
        (empty($edm[$i])) && $edm[$i] = new ProductPhoto;
    }

    $options = array('conditions' => array('vdo002 = ?', $id));
    $videos = Video::all($options) ?: array(new Video);


    $tpl->assign('photo', $photo);
    $tpl->assign('sgs', $sgs);
    $tpl->assign('edm', $edm);
    $tpl->assign('row', $row);
    $tpl->assign('items', $items);
    $tpl->assign('videos', $videos);
    $tpl->assign('title', '新增商品');
    $tpl->display('page02_product_modify.tpl');

