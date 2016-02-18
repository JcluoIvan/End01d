<?php
    $_SERVER['DOCUMENT_ROOT'] = __DIR__;
    define('QUEUE_PROCESS', 1);
    include 'conf/config.php';
    include PUB_PATH . 'c361.php';


    use model\Order;

    if (
        (! empty($_SERVER['REQUEST_METHOD'])) ||
        (! empty($_SERVER['DOCUMENT_ROOT']))
    ) {
        header('Location: index.php');
    }
    $clearing_date = intval(System::get('clearing_date'));

    $options = array(
        'select' => 'DATEDIFF(CURDATE(), odm006) AS days, odm006 AS date',
        'conditions' => array('odm006 IS NOT NULL AND odm031 IS NULL'),
        'group' => 'odm006',
        'having' => 'days >= ' . $clearing_date 
    );
    $rows = Order::all($options);
    
    if (count($rows) === 0) exit(' no data ');

    $c361 = new c361;

    foreach ($rows as $row) {
        $_POST = array('days' => $row->days);
        try {
            $c361->run();
        } catch (Exception $e) {
            var_dump($e);
            echo "{$row->date} Error";
        }
        echo "{$row->date} OK";
    }


