<?php
use model\Product;
use model\ProductItem;
use model\ProductPhoto;
/* 取得 app 首頁的商品分類 & 主力產品 */
class w100 {

    public function run() {
        

        return array(
            'status' => true,
            'classifiers' => $this->getClassifier(),
            'main_products' => $this->getMainProduct(),
        );
    }
    public function getClassifier() 
    {

        $options = array(
            'conditions' => 'pdi004 = 0',
            'order' => 'pdi003',
        );
        $result = ProductItem::find('all', $options) ?: array();

        $rows = array();
        foreach ($result as $row) {
            $rows[] = $row->attributes(array('id', 'name'));
        }
        return $rows;
    }
    public function getMainProduct() 
    {

        $options = array(
            'conditions' => 'pdm007 = 1 AND pdm013 = 1',
            'order' => 'pdm014',
        );
        $with = array('photo' => array('conditions' => 'pdo004 = 1'));
        $result = Product::with(Product::find('all', $options), $with);

        $rows = array();
        foreach ($result as $row) {
            $tmp = $row->attributes(array('id', 'name'));
            $tmp['img'] = $row->photo ? $row->photo[0]->getMinImageUrl() : '';
            $rows[] = $tmp;
        }
        return $rows;

    }

}