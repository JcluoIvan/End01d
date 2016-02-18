<?php
    include 'conf/config.php';
    use model\OrderCache;
    $no = Input::get('no');
    $order = OrderCache::find_by_odm002($no);
?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8; nocache">
</head>
<body>
    <?php if (empty($order)) : ?>
        <script>
            function _postMessage() {
                window.parent.postMessage({
                    status: false,
                    message: '處理程序錯誤, 交易失敗'
                }, '*');
            }
        </script>
    <?php else : ?>
        <input type="hidden" id="order-no" value="<?= $order->odm002 ?>" />
        <input type="hidden" id="order-point" value="<?= $order->getMemberPoint(true) ?>" />
        <script>
            function _postMessage() {
                window.parent.postMessage({
                    status: false,
                    message: $order->odm040
                }, '*');
            }
        </script>
    <?php endif; ?>
    <script>
        setTimeout(_postMessage, 100);
    </script>
</body>
</html>    