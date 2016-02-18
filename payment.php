<?php
    include 'conf/config.php';
    use model\OrderCache;

    $order = OrderCache::find_by_odm002(Input::get('no'));
    if ($order) {
        $CUBKEY = System::get('payment.cubkey');
        $storeid = System::get('payment.storeid');
        $no = $order->odm002;
        $amount = $order->odm029 + $order->odm030;
        // $amount = 1;
        $CAVALUE = md5($storeid.$no.$amount.$CUBKEY); //STOREID+ORDERNUMBER+AMOUNT+CUBKEY,以MD5演算法加密

        $post ="<MERCHANTXML>\n";
        $post.="<CAVALUE>{$CAVALUE}</CAVALUE>\n";   
        $post.="<ORDERINFO>\n";
        $post.="<STOREID>{$storeid}</STOREID>\n";    //廠商代號
        $post.="<ORDERNUMBER>{$no}</ORDERNUMBER>\n"; //訂單編號
        $post.="<AMOUNT>{$amount}</AMOUNT>\n";   //授權金額
        $post.="</ORDERINFO>\n";
        $post.="</MERCHANTXML>\n";
    }

?>
<html>
<head> </head>
<body>
    <?php if (User::isLogin() && $order) : ?>
        <h3> 交易連線中 ... </h3>
        <form id="payment-form" action="https://sslpayment.uwccb.com.tw/EPOSService/Payment/Mobile/OrderInitial.aspx" method="post" style="display: none">
            <input type="hidden" name="strRqXML" value="<?php echo $post;?>">
            <input type="submit" name="button" value="授權">
        </form>
        <script>
            document.getElementById('payment-form').submit();
        </script>
    <?php else : ?>
        <h3>付款程序錯誤，請重新操作</h3>
    <?php endif; ?>
</body>
</html>