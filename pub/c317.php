<?php
use model\Receipt;

// echo "<pre>";
// var_dump($_POST);
// exit;

class c317 extends pub\GatewayApi{
    public function run()
    {
        $id = Input::post('id') ?: 0;
        // $files = Input::post('files') ?:array();
        
        // foreach ($files as $key => $value) {

        //     $photo = Receipt::find_by_rec003($value);

        //     $result = $photo->delete();

        //     $path = Image::receiptPath($value);

        //     unlink($path);

        //     $path = $photo->getMinImagePath($value);

        //     unlink($path);
        // }

        // $ary = array(
        //     'images' => array(),
        //     'total'  => array(
        //         'img' => 0,
        //     ),
        // );

        // $photo = Receipt::getAllPhotoByOrderId($id);
        if ($photo = Receipt::find_by_rec001($id)) {
            if ($photo->delete()) {
                return $this->success('發票刪除成功');
            }
        } else {
            return $this->fail('資料不正確，發票刪除失敗');
        }


        return $ary;

        // echo "<pre>";
        // print_r($photo);
        // echo "</pre>";
        exit;

        foreach ($files as $key => $value) {

            $photo = Receipt::find_by_rec003($value);

            $result = $photo->delete();

            $path = Image::receiptPath($value);

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

        $photo = Receipt::getAllPhotoByOrderId($id);
        
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