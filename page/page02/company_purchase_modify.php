<?php
    include '../../conf/config.php';
    use model\ProductPurchase;
    use model\ProductItem;
    use model\Product;
    use model\Agent;


    $aid = 0;
    $id = Input::get('id') ?: 0;
    $purchase = ProductPurchase::find_by_pdp001($id) ?: new ProductPurchase;
    $purchase->pdp004 = $purchase->pdp004 ?: date('Y-m-d');

    $items = PageApp::items();
    list($iid) = array_keys($items);
    $products = PageApp::products($iid);

    $tpl->assign('purchase', $purchase);
    $tpl->assign('items', $items);
    $tpl->assign('products', $products);
    $tpl->assign('title', $purchase->pdp001 ? '修改進貨記錄' : '建立進貨記錄');
    $tpl->display('page02_company_purchase_modify.tpl');

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