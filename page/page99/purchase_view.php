<?php
    include '../../conf/config.php';
    use model\LogPurchase;
    use model\ProductPurchase;
    use model\Agent;

    $id = Input::get('id') ?: 0;

    $log = LogPurchase::with(
        LogPurchase::find_by_lpc001($id),
        array('agent', 'purchase')
    );

    if (! $log) exit('資料不正確');

    // $product = $log->purchase ? $log->purchase->product : null;
    // $agent = Agent::find_by_age001($log->lpc004);
    $agent = $log->agent ?: new Agent;


    $agent_name = $log->agent 
        ? ($log->agent->age006 ?: "資料遺失")
        : '公司';
        
    // $product_name =  $product 
    //     ? $product->pdm004 
    //     : "資料已刪除 ( {$log->lpc003} )";

    $tpl->assign('log', $log);
    $tpl->assign('agent_name', $agent_name);
    // $tpl->assign('product_name', $product_name);

    $tpl->display('page99_purchase_view.tpl');
