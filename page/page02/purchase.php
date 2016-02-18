<?php
    include '../../conf/config.php';
    use model\ProductItem;
    use model\Agent;

    // $aid = Input::get('aid') ?: 0;
    // $pid = Input::get('pid') ?: 0;

    // $agent = Agent::find_by_age001($aid) ?: false;

    // $product = Product::find_by_pdm001($pid) ?: false;

    // if (empty($agent) || empty($product)) exit('error');


    $options = array(
        'conditions' => array("age002 = 'L'"),
        'order' => 'age003'
    );
    $l_agent = array();
    $r_agent = null;
    $result = Agent::with(Agent::all($options), array('childs'));
    
    foreach ($result as $lrow) {
        $disabled = $lrow->age016 ? ' (已停用) ' : '';
        $l_agent[$lrow->age001] = "{$lrow->age006} {$disabled}";
    }
    if ($r_agent === null) {
        $first = isset($result[0]) ? $result[0] : null;
        $rows = $first ? $first->childs : array();
        foreach ($rows as $r) {
            $disabled = $r->age016 ? ' (已停用) ' : '';
            $r_agent[$r->age001] = "{$r->age006} {$disabled}";
        }
    }

    /* 產品類別 */
    $options = array(
        'conditions' => array('pdi004 = 0'),
        'order' => 'pdi003'
    );
    $rows = ProductItem::find('all', $options);

    $types = array('0' => '所有產品分類');
    foreach ($rows as $row) {
        $types[$row->pdi001] = $row->pdi002;
    }



    $tpl->assign('types', $types);
    $tpl->assign('l_agent',$l_agent);
    $tpl->assign('r_agent',$r_agent);
    // $tpl->assign('agent', $agent);
    // $tpl->assign('product', $product);

    $tpl->display('page02_purchase.tpl');

