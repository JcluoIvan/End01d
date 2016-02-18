<?php
chdir(__DIR__);
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../';
require '../conf/config.php';
require './PHPMailer/PHPMailerAutoload.php';

use model\Setting;
use model\Member;
use model\Order;
use model\OrderDetail;

#$argv = isset($argv) ? $argv : array();
$oid = isset($argv[1]) ? $argv[1] : null;

$order = Order::with(
    Order::find_by_odm001($oid),
    array('member', 'al', 'ar')
);

$obj = Setting::value('EmailNotice');
$obj = $obj ? json_decode($obj) : new stdClass;

$emails = isset($obj->emails) ? explode(';', $obj->emails) : null;
$disabled = empty($obj->disabled) ? false : true;

if ($disabled || empty($emails) || empty($order)) return ;

$mail = new PHPMailer;

# Tell PHPMailer to use SMTP
$mail->isSMTP();

# Enable SMTP debugging
#  0 = off (for production use)
#  1 = client messages
#  2 = client and server messages
// $mail->SMTPDebug = 2;

# 設定SMTP需要驗證
$mail->SMTPAuth = true; 

# Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

# Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

# Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

$mail->Encoding = "base64";

$mail->CharSet = "utf-8"; 

# Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

# Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "hu98ing@gmail.com";

$mail->Password = 'A12399abcd';

$mail->setFrom('hu98ing@gmail.com', '不老神話');

foreach ($emails as $mail_address) {
    $mail->addAddress($mail_address);
}

$mail->Subject = sprintf("新增一筆購物記錄, 訂單編號 : %s", $order->odm002);

$mail->msgHTML(getContentHtml($order));

$mail->isHTML(true);
// $mail->AltBody = 'This is a plain-text message body';
// sleep(2);
// exit(getContentHtml($order));

if (!$mail->send()) {
   echo "Mailer Error: " . $mail->ErrorInfo;
} else {
   echo "Message sent!";
}



function getContentHtml($order) {
    $member = $order->member ?: new Member;
    $agent1 = $order->al ?: new Agent;
    $agent2 = $order->ar ?: new Agent;

    $details = OrderDetail::with(
        OrderDetail::all(array('conditions' => array('odd002 = ?',$order->odm001))),
        array('product')
    );

    ob_start();
        // extract(array('order' => $order));
        include './contents.php';
        $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}

// $data = sprintf("is run on %s \n%s", date('Y/m/d H:i:s'), $order_no);

// file_put_contents('run.txt', $data);