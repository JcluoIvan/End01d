<?php
use model\ProductPhoto;

// echo "<pre>";
// var_dump($_POST);
// exit;

class c224 extends pub\GatewayApi{
    public function run()
    {
        $fails = array();

        $images = Input::post('images') ?: array(0);

        $options = array('conditions' => array('pdo001 IN (?)', $images));
        foreach (ProductPhoto::all($options) as $row) {
            if (! $row->delete()) {
                $fails[] = intval($row->pdo001);
            }
        }
        return $this->success('刪除成功', array('fails' => $fails));



        foreach ($files as $key => $value) {

            $photo = ProductPhoto::find_by_pdo003($value);

            $result = $photo->delete();

            $path = Image::productPath($value);

            unlink($path);

            $path = $photo->getMinImagePath($value);

            unlink($path);
        }

        $ary = array(
            'images' => array(),
            'total'  => array(
                'img' => 0,
                'sgs' => 0,
            ),
        );

        $photo = ProductPhoto::getAllPhotoByProductId($id);
        
        if ($photo) {
            foreach ($photo as $key => $value) {
                $ary['images'][$key]['sort'] = (int)$value->pdo004;
                $ary['images'][$key]['filename'] = $value->pdo003;
                $ary['images'][$key]['src'] = $value->getMinImageUrl();

                $ary['total']['img'] += (int)$value->pdo004 == 1 ? 1 : 0;
                $ary['total']['sgs'] += (int)$value->pdo004 == 2 ? 1 : 0;
            }
        }

        // echo "<pre>";
        // print_r($ary);
        return $ary;
    }
}