<?php
    include '../../conf/config.php';
    use model\ProductItem;
    use model\Agent;

    $aid = Input::get('aid') ?: 0;


    /* 預設選取的雷達站 */
    $def_agent = Agent::find_by_age001($aid) ?: new Agent;

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
        // if ($lrow->age001 == $def_agent->age018) {
        //     $r_agent = array();
        //     foreach ($lrow->childs as $rrow) {
        //         $r_agent[$rrow->age001] = $rrow->age006;
        //     }
        // }
    }
    if ($r_agent === null) {
        $first = isset($result[0]) ? $result[0] : null;
        $rows = $first ? $first->childs : array();
        foreach ($rows as $r) {
            $disabled = $r->age016 ? ' (已停用) ' : '';
            $r_agent[$r->age001] = "{$r->age006} {$disabled}";
        }
    }

    // $l_agent = Agent::getLAgentList();
    // $r_agent = array();
    // if (count($l_agent)) {
    //     $lids = array_keys($l_agent);
    //     $r_agent = Agent::getRAgentList($lids[0]);
    // }

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
    $tpl->assign('def_agent',$def_agent);
    $tpl->assign('l_agent',$l_agent);
    $tpl->assign('r_agent',$r_agent);

    $tpl->display('page02_inventory.tpl');

