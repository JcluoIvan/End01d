<?php

include 'conf/config.php';
include 'pub/c361.php';

$cmd = new c361;
$cmd->run();

// AppRegister::pushNotification('推播 Test ~~ ', array(2));

return;
echo '<pre>';
// exit;
$message = '推播 Test ~~ 收到請聯絡 Ivan 我。';
$rids = array('3afa2c2149a1bf7ca7a371527d4b323de6ef17998adaa91df8932e4a34863f82');
// $rids = array('b93347b35d2829de787d0f76aa600f8539b21dd4555db837dcd5579cb3389671');
$passphrase = System::get('ios.push.passphrase');
$payload = array(
    'aps' => array(
        'alert' => $message, 
        'badge' => 1, 
        'sound' => 'default'
    )
);
$output = json_encode($payload);

$payload_length = strlen($output);

$pem = 'push/endold.ck.pem';//System::get('ios.push.pem');
$pwd = System::get('ios.push.passphrase');
$stream = stream_context_create();
stream_context_set_option($stream, 'ssl', 'local_cert', $pem);
stream_context_set_option($stream, 'ssl', 'passphrase', $pwd);

$host = System::get('ios.push.host');
$error = null;
$errorString = null;
$apns = stream_socket_client(
    $host, 
    $error, 
    $errorString, 
    2, 
    STREAM_CLIENT_CONNECT, 
    $stream
);
foreach ($rids as $rid) {
    $message = 
        chr(0) . 
        pack('n', 32) . 
        pack('H*', $rid) . 
        pack('n', $payload_length) .
        $output;
    echo "run [{$rid}] >> " . $message . " << : " . fwrite($apns, $message);
}
if (! $apns) {
    var_dump($error, $errorString);
    // return false;
}

//     var_dump($error, $errorString);
//    $response = stream_get_contents($apns);
// var_dump($response);

echo "<br/>";
$count = 50;
while (!feof($apns) && ($count --) > 0) {
    echo "line >> " . fgets($apns, 1024);
    echo "<br/>";
}
fclose($apns);

echo 'finish';