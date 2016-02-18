<?php
use model\Order;
use model\OrderDetail;
use model\Receipt;

class c308 {

    public function run() {
        $sn = Input::post('sn');
        $getno = Input::post('getno') ?: null;
        $delivery = strtotime(Input::post('delivery')) ?: null;
        $signoff = strtotime(Input::post('signoff')) ?: null;
        $receivable = strtotime(Input::post('receivable')) ?: null;
        $status = Input::post('status') ?: 1;
        // 最後修改人員
        $keyman = User::get('account');

        $order = Order::find_by_odm001($sn) ?: new Order;
        $order->odm005 = $signoff ? date("Y-m-d", $signoff) : null;             //核帳日期
        $order->odm007 = $delivery ? date("Y-m-d", $delivery) : null;           //取貨日期
        $order->odm008 = $receivable ? date("Y-m-d", $receivable) : null;       //收款日期
        $order->odm011 = $getno;                                                //取貨序號
        $order->odm034 = $keyman;                                               //最後修改人員

        $result = $order->save();

        // 統一發票直接上傳覆蓋掉原發票圖檔，先刪除原圖檔，再上傳新的發票圖檔
        $delPhoto = Receipt::find_by_rec002($sn);
        // if($delPhoto){
        //     $delPath = Image::receiptPath($delPhoto->rec003);
        //     unlink($delPath);
        //     $delPath = $delPhoto->getMinImagePath($delPhoto->rec003);
        //     unlink($delPath);
        // }

        foreach ($_FILES['files']['error'] as $kind => $row) {
            foreach ($row as $key => $value) {
                if (!$value && $result) {
                    $filenameAry = explode('.',$_FILES['files']['name'][$kind][$key]);
                    $sub = array_pop($filenameAry);
                    $filenameAry[] = date("YmdHis");
                    $filenameAry[] = rand(1,1000);
                    $filename = md5(implode('.', $filenameAry));
                    $filename .= ".{$sub}";
                    $path = Image::receiptPath($filename);
                    $result = move_uploaded_file($_FILES['files']['tmp_name'][$kind][$key], $path);
                    
                    if ($result) {
                        $photo = Receipt::find_by_rec002($sn) ?: new Receipt;
                        $photo->rec002 = $sn;
                        $photo->rec003 = $filename;
                        $photo->rec004 = date("Y-m-d H:i:s");
                        $result = $photo->save();

                        if ($result) {
                            $photo->createMinImage();
                        } 
                    }

                }
            }
        }

        return array(
            'status' => $result,
            'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        );
        
    }

}