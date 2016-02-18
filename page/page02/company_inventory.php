<?php
    include '../../conf/config.php';
    use model\ProductItem;
    use model\Agent;

    $l_agent = Agent::getLAgentList();
    $r_agent = array();
    if (count($l_agent)) {
        $lids = array_keys($l_agent);
        $r_agent = Agent::getRAgentList($lids[0]);
    }

    /* 產品類別 */
    $options = array(
        'conditions' => array(
            'pdi004 = 0'
        )
    );
    $rows = ProductItem::find('all', $options);

    $types = array('0' => '所有產品分類');
    foreach ($rows as $row) {
        $types[$row->pdi001] = $row->pdi002;
    }



    $tpl->assign('types', $types);
    $tpl->assign('l_agent',$l_agent);
    $tpl->assign('r_agent',$r_agent);

    $tpl->display('page02_company_inventory.tpl');

