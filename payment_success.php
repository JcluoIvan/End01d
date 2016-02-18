<?php
    include 'conf/config.php';
    use model\Order;
    $no = Input::get('no');
    $order = Order::find_by_odm002($no);
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
                    message: '查無訂單資料'
                }, '*');
            }
        </script>
    <?php else : ?>
        <input type="hidden" id="order-no" value="<?= $order->odm002 ?>" />
        <input type="hidden" id="order-point" value="<?= $order->getMemberPoint(true) ?>" />
        <script>
            function _postMessage() {
                window.parent.postMessage({
                    status: true,
                    no: document.getElementById('order-no').value,
                    point: document.getElementById('order-point').value
                }, '*');
            }
        </script>
    <?php endif; ?>
    <script>
        setTimeout(_postMessage, 100);
    </script>
</body>
</html>    