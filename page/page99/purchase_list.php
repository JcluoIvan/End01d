<?php
    include '../../conf/config.php';
    use model\ProductPurchaseDetail;
    use model\ProductPurchase;
    use model\LogPurchase;
    use model\Product;
    use model\Agent;

    $id = Input::get('id');
    // $agent = Agent::find_by_age001($id);
    $log = LogPurchase::with(
        LogPurchase::find_by_lpc001($id),
        array('agent')
    );
    if (! $log) exit('error');

    $agent = $log->agent ?: new Agent;

    $agent_name = $agent->age006 ?: '資料遺失';

    $title = '';
    $tag = '';

    /* 主單 */
    if ($log->lpc007 == LogPurchase::TYPE_MAIN) {
        $main = ProductPurchase::find_by_pdp001($log->lpc006) ?: new ProductPurchase;
        $no = $main->pdp002 ?: '資料遺失';
        $title = "{$agent_name} / 進貨編號 {$main->pdp002} ";
        $tag = "主單 [ {$no} ] 操作歷程";
    } else {

        $detail = ProductPurchaseDetail::with(
                ProductPurchaseDetail::find_by_ppd001($log->lpc006),
                array('purchase', 'product')
            ) ?: new ProductPurchaseDetail;
        $main = $detail->purchase ?: new ProductPurchase;
        $no = $main->pdp002 ?: '資料遺失';
        $product = $detail->product ?: new Product;
        $pname = $product->pdm004 ?: '資料遺失';
        $title = "{$agent_name} / 進貨編號 {$no} / 商品 {$pname}";
        $tag = "明細 [ {$no} / {$pname} ] 操作歷程";
    }


    $tpl->assign('log', $log);
    $tpl->assign('tag', $tag);
    $tpl->assign('title', $title);
    $tpl->display('page99_purchase_list.tpl');
