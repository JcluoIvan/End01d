<?php
include 'conf/config.php';
use model\AppRegister;
// include 'pub/c361.php';

// $cmd = new c361;
// $cmd->run();

// AppRegister::pushNotification('推播 Test ~~ ', array(2));

// return;


echo '<pre>';
// exit;
$message = '推播 Test ~~ 收到請聯絡 Ivan 我。';
echo 'start';
// $rid = '418c0df1f12675f0e3d1aa8328d0309c377ddf88cb9ec8db8ecb572742339cff';
// AppRegister::connection()->query("DELETE FROM app_register_id WHERE ari004 = '{$rid}'");
// exit;
// AppRegister::pushNotification('推播 Test ~~ ', array(2));
// return;
$rids = array('3afa2c2149a1bf7ca7a371527d4b323de6ef17998adaa91df8932e4a34863f82');
$rids = array(
  // "418c0df1f12675f0e3d1aa8328d0309c377ddf88cb9ec8db8ecb572742339cff",
  "0ee42a28a03ddaa8f47e01c74574536978adcc05b86d0793340d9b8bfc6708c1",
  "5b2c91c9787a980e201001847f20e116ba229a464f78f0e2b9c159c221d59993",
  "1dea15b48a10efc38958878437ef82801f384ff96fe1ddebbb703e91ec583a97",
  "fd5a022dee81e973d0d9d947f221e83da88b720bd0d01f96c3ad10ca21116b07",
  "b5836b282192c3d5167db8b59e2612f223b72e582e115d30fcd5433b15412b3e",
  "b93347b35d2829de787d0f76aa600f8539b21dd4555db837dcd5579cb3389671",
  "c1271b549cf71e72aacd15006c0d432848514526506dbedd7c4268bd4ecc0960",
  "2313c02c0bfe69ea9253d6670e2438414332ff0c8e1ea363f942126d734ed92b",
  "0dc7ec1b790a98aca1f3a3303de80e359f5707e7551dd184e0695cf12f20d0fa",
  "3afa2c2149a1bf7ca7a371527d4b323de6ef17998adaa91df8932e4a34863f82",
);
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
$pem = System::get('ios.push.pem');
// $pem = 'push/160505-ck.pem';//System::get('ios.push.pem');
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
    fwrite($apns, $message);
    // echo "run [{$rid}] >> " . $message . " << : " . fwrite($apns, $message, strlen($message));
}

if (checkAppleErrorResponse($apns)) {
    exit('err');
}
if (! $apns) {
    var_dump($error, $errorString);
    // return false;
}

    if (checkAppleErrorResponse($apns)) {

        return false;
    }
//     var_dump($error, $errorString);
//    $response = stream_get_contents($apns);
// var_dump($response);

echo "<br/>";
// $count = 50;
// while (!feof($apns) && ($count --) > 0) {
//     echo "line >> " . fgets($apns, 1024);
//     echo "<br/>";
// }
fclose($apns);

echo 'finish';


//FUNCTION to check if there is an error response from Apple
//         Returns TRUE if there was and FALSE if there was not
function checkAppleErrorResponse($fp) {

   //byte1=always 8, byte2=StatusCode, bytes3,4,5,6=identifier(rowID). Should return nothing if OK.
   // $apple_error_response = fread($fp, 6);
   //NOTE: Make sure you set stream_set_blocking($fp, 0) or else fread will pause your script and wait forever when there is no response to be sent.
    $apple_error_response = fgets($fp);

   if ($apple_error_response) {
        //unpack the error response (first byte 'command" should always be 8)
        $error_response = unpack('Ccommand/Cstatus_code/Nidentifier', $apple_error_response);
        var_dump(unpack("N1timestamp/n1length/H*devtoken", $apple_error_response));
        if ($error_response['status_code'] == '0') {
            $error_response['status_code'] = '0-No errors encountered';
        } else if ($error_response['status_code'] == '1') {
            $error_response['status_code'] = '1-Processing error';
        } else if ($error_response['status_code'] == '2') {
            $error_response['status_code'] = '2-Missing device token';
        } else if ($error_response['status_code'] == '3') {
            $error_response['status_code'] = '3-Missing topic';
        } else if ($error_response['status_code'] == '4') {
            $error_response['status_code'] = '4-Missing payload';
        } else if ($error_response['status_code'] == '5') {
            $error_response['status_code'] = '5-Invalid token size';
        } else if ($error_response['status_code'] == '6') {
            $error_response['status_code'] = '6-Invalid topic size';
        } else if ($error_response['status_code'] == '7') {
            $error_response['status_code'] = '7-Invalid payload size';
        } else if ($error_response['status_code'] == '8') {
            $error_response['status_code'] = '8-Invalid token';
        } else if ($error_response['status_code'] == '255') {
            $error_response['status_code'] = '255-None (unknown)';
        } else {
            $error_response['status_code'] = $error_response['status_code'] . '-Not listed';
        }

        echo '<br><b>+ + + + + + ERROR</b> Response Command:<b>' . $error_response['command'] . '</b>&nbsp;&nbsp;&nbsp;Identifier:<b>' . $error_response['identifier'] . '</b>&nbsp;&nbsp;&nbsp;Status:<b>' . $error_response['status_code'] . '</b><br>';
        echo 'Identifier is the rowID (index) in the database that caused the problem, and Apple will disconnect you from server. To continue sending Push Notifications, just start at the next rowID after this Identifier.<br>';
            echo "\n";
            var_dump($error_response);
        return true;
   }
   return false;
}