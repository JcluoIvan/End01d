<?php
    include '../../conf/config.php';
    use model\ProductPurchase;
    use model\ProductItem;
    use model\Product;
    use model\Agent;

    $aid = Input::get('aid') ?: 0;
    $id = Input::get('id') ?: 0;
    $purchase = ProductPurchase::with(
            ProductPurchase::find_by_pdp001($id),
            array('agent')
        ) ?: new ProductPurchase;
    $agent = $purchase->agent ? $purchase->agent : Agent::find_by_age001($aid);
    $purchase->pdp004 = $purchase->pdp004 ?: date('Y-m-d');

    $items = PageApp::items();
    list($iid) = array_keys($items);
    $products = PageApp::products($iid);

    $tpl->assign('purchase', $purchase);
    $tpl->assign('agent',$agent);
    $tpl->assign('items', $items);
    $tpl->assign('products', $products);
    $tpl->assign('title', $purchase->pdp001 ? '修改退貨記錄' : '建立退貨記錄');
    $tpl->display('page02_return_modify.tpl');

    class PageApp {

        static function items() {

            $options = array(
                'conditions' => array('pdi004 = 0'),
                'order' => 'pdi003'
            );
            $result = ProductItem::find('all', $options);
            $rows = array();
            foreach ($result as $r) {
                $rows[$r->pdi001] = $r->pdi002;
            }
            return $rows;
        }
        static function products($iid = 0) {

            $options = array(
                'conditions' => array('pdm003 = ?', $iid),
                'order' => 'pdm014'
            );
            $result = Product::find('all', $options);
            $rows = array();
            foreach ($result as $r) {
                $rows[$r->pdm001] = $r->pdm004;
            }
            return $rows;
        }



        static function agentTree() {

            $options = array(
                'conditions' => array(
                    "age002 = 'L' AND age016 = 0"
                ),
            );
            return Agent::with(
                Agent::find('all', $options),
                array('agent')
            );
        }
        static function productTree() {

            $options = array(
                'conditions' => array(
                    "pdi004 = 0"
                ),
                'order' => 'pdi003'
            );
            return ProductItem::with(
                ProductItem::find('all', $options),
                array('product')
            );
        }
    }