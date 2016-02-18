<?php
/* 產品管理修改 */


use model\Product;
use model\ProductPhoto;


class c221 extends pub\GatewayApi{

    public function run() {

        $id         = Input::post('id') ?: 0;
        $sort       = Input::post('sort') ?: 0;

        $product = Product::find_by_pdm001($id) ?: new Product;
        $product->pdm002 = Input::post('no');
        $product->pdm003 = Input::post('type');
        $product->pdm004 = Input::post('name');
        $product->pdm005 = Input::post('price');
        $product->pdm006 = Input::post('member_price');
        $product->pdm007 = Input::post('selling') ?: 0;
        $product->pdm008 = Input::post('video_url');
        $product->pdm009 = Input::post('how_use');
        $product->pdm010 = Input::post('capacity');
        $product->pdm011 = User::get('id');
        $product->pdm013 = Input::post('main') ?: 0;
        $product->pdm014 = ($sort * 10) + (($product->pdm014 / 10 < $sort) ? 1 : -1);
        $product->pdm015 = Input::post('introduce');
        $product->pdm016 = Input::post('element');
        $product->pdm017 = Input::post('object');
        $product->pdm018 = Input::post('remark');
        $product->pdm019 = Input::post('sell_type');
        $result = $product->save();
        
        /* 排序 sort */
        $result && Product::sort('pdm014');

        if ($result && isset($_FILES['photo'])) {
            $this->updateImage(function($filename) use ($product) {
                $photo = new ProductPhoto;
                $photo->pdo002 = $product->pdm001;
                $photo->pdo003 = $filename;
                $photo->pdo004 = 1;
                $photo->save() && $photo->createMinImage();
            }, $_FILES['photo']);
        }
        if ($result && isset($_FILES['sgs'])) {
            $this->updateImage(function($filename) use ($product) {
                $photo = new ProductPhoto;
                $photo->pdo002 = $product->pdm001;
                $photo->pdo003 = $filename;
                $photo->pdo004 = 2;
                $photo->save() && $photo->createMinImage();
            }, $_FILES['sgs']);
        }
        if ($result && isset($_FILES['edm'])) {
            $this->updateImage(function($filename) use ($product) {
                $photo = new ProductPhoto;
                $photo->pdo002 = $product->pdm001;
                $photo->pdo003 = $filename;
                $photo->pdo004 = 3;
                $photo->save() && $photo->createMinImage();
            }, $_FILES['edm']);
        }

        return $result ? $this->success() : $this->fail('資料儲存失敗');


    }

    /**
     * 處理圖片上傳的動作
     * @param  Closure $closure 圖片處理完後, 會執行此匿名函數, 並傳入圖片路徑 
     * @param  array   $files   上傳的圖片(檔案)陣列
     * @void
     */
    public function updateImage(Closure $closure, array $files) {
        foreach ($files['name'] as $i => $filename) {
            if (empty($filename)) continue;
            $filename = explode('.', $filename);
            $sub = array_pop($filename);
            $filename[] = time() . rand(1, 1000);
            $filename = md5(implode('', $filename)) . ".{$sub}";
            $path = Image::productPath($filename);
            if (move_uploaded_file($files['tmp_name'][$i], $path)) {
                $closure($filename);
            }
        }
    }


}