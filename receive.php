<?php
    include 'conf/config.php';
    use model\OrderDetailCache;
    use model\OrderCache;
    use model\OrderDetail;
    use model\Order;

    $xml = Input::post('strRsXML') ?: '';
    
/*$xml = <<<XML_STRING
<?xml version='1.0' encoding='UTF-8'?>
<CUBXML>
    <CAVALUE>驗證值</CAVALUE>
    <ORDERINFO>
        <STOREID>特店代號</STOREID>
        <ORDERNUMBER>訂單編號</ORDERNUMBER>
        <AMOUNT>金額</AMOUNT>
    </ORDERINFO>
    <AUTHINFO>
        <AUTHSTATUS>授權狀態</AUTHSTATUS>
        <AUTHCODE>授權碼</AUTHCODE>
        <AUTHTIME>授權時間</AUTHTIME>
        <AUTHMSG>授權訊息</AUTHMSG>
    </AUTHINFO>
</CUBXML>
XML_STRING;*/
    
try {
    $xml = simplexml_load_string($xml);
    if (empty($xml)) {
        exit('Error.');
    }

    $storeid = System::get('payment.storeid');
    $cubkey = System::get('payment.cubkey');
    $no = $xml->ORDERINFO->ORDERNUMBER;
    $amount = $xml->ORDERINFO->AMOUNT;
    $status = $xml->AUTHINFO->AUTHSTATUS;
    $code = $xml->AUTHINFO->AUTHCODE;
    // $cavalue = md5($storeid . $no . $amount . $status . $code . $cubkey);
    // if ($xml->CAVALUE != $cavalue) {
    //     exit('CAVALUE Error.');
    // }

    $cache = OrderCache::find_by_odm002($no);
    if (empty($cache)) {
        exit('data Error');
    }

    $cache->odm036 = $amount;
    $cache->odm037 = $status;
    $cache->odm038 = $code;
    $cache->odm039 = $xml->AUTHINFO->AUTHTIME;
    $cache->odm040 = $xml->AUTHINFO->AUTHMSG;

    $cavalue = md5(System::get('domain') . $cubkey);

    # 授權成功 (交易成功)
    if ($status == '0000') {
        $order = new Order($cache->attributes());
        $order->odm001 = null;

        # 將 order_cache 的資料存入 order 
        if (! $order->save(false)) exit('save error');
        $options = array('conditions' => array('odd002 = ?', $cache->odm001));

        $details = OrderDetailCache::all($options);
        foreach ($details as $row) {
            $detail = new OrderDetail($row->attributes());
            $detail->odd001 = null;
            $detail->odd002 = $order->odm001;
            if (! $detail->save()) {
                $order->detail(true);
                exit('detail 轉移失敗');
            }
        }

        $order->sendMail();
        // $sql = "INSERT INTO order_detail 
        //         SELECT NULL, {$order->odm001}, `odd003`, `odd004`, `odd005`, `odd006`, NULL
        //         FROM order_detail_cache
        //         WHERE odd001 = {$cache->odm001}";

        // if (! Order::connection()->query($sql)) {
        //     $order->delete(true);
        //     exit('detail 轉移失敗');
        // }

        # 將 cache 的資料刪除 (實體刪除)
        // $cache->delete(true);
        exit("<?xml version='1.0' encoding='UTF-8'?><MERCHANTXML><CAVALUE>{$cavalue}</CAVALUE><RETURL>http://www.win8899.net/payment_success.php?no={$no}</RETURL></MERCHANTXML>");

    } elseif (! $cache->save(false)) {
        exit('save error');
    }
    exit("<?xml version='1.0' encoding='UTF-8'?><MERCHANTXML><CAVALUE>{$cavalue}</CAVALUE><RETURL>http://www.win8899.net/payment_fail.php?no={$no}</RETURL></MERCHANTXML>");


} catch (Exception $e) {

    exit('Error Exception' . $e->getMessage());

}

