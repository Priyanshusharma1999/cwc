<?php
/*date_default_timezone_set('asia/kolkata');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

function Send_Mail($to, $subject, $body, $bcc = array(), $cc = array())
{
require 'class.phpmailer.php';
$from = "hosting@vizzmedia.com";
$mail = new PHPMailer;
//$mail->IsSMTP(true); // SMTP
//$mail->SMTPDebug  = 2; 
$mail->SMTPAuth   = true;  // SMTP authentication
//$mail->AuthType = 'PLAIN';
//$mail->AuthType = 'LOGIN';
$mail->Mailer = "smtp";
$mail->SMTPSecure = 'tls';
//$mail->SMTPSecure = 'ssl';
$mail->Host       = "email-smtp.us-east-1.amazonaws.com"; // Amazon SES server, note "tls://" protocol
//$mail->Port       = 587;  
$mail->Port       = 587;                   // set the SMTP port
$mail->Username   = "AKIAIWXLF35TVRAJ5X4Q";  // SES SMTP  username
$mail->Password   = "348BJ3ergSQh5LvmZYOal6aKjDVJlfPl6b+/jJCT";  // SES SMTP password
//$mail->Username   = "AKIAIHPQKPP6ENMTL3PA";  // SES SMTP  username
//$mail->Password   = "fYP0Qhb161QpUbSsxavqdp43e+nRlvuZcGfQn4ir";  // SES SMTP password
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
$mail->SetFrom($from, 'vizzmedia');
$mail->AddReplyTo($from,'vizzmedia');
$mail->Subject = $subject;
$mail->MsgHTML($body);
//$address = $to;
//$mail->AddAddress($address, $to);
if (count($to) && is_array($to)) {
    foreach($to as $mail_id) {
        $mail->AddAddress($mail_id, $mail_id);
    }
}
elseif (count($to)) {
    $mail->AddAddress($to, $to);
}
if (count($bcc)) {
    foreach($bcc as $mail_id) {
        $mail->AddBCC($mail_id, $mail_id);
    }
}
if (count($cc)) {
    foreach($cc as $mail_id) {
        $mail->AddCC($mail_id, $mail_id);
    }
}
if(!$mail->Send())
    return "Mailer Error: " . $mail->ErrorInfo;
else
    echo "Success";
}
/*if (count($to) && is_array($to)) {
    foreach($to as $mail_id) {
        $mail->AddAddress($mail_id, $mail_id);
    }
}
elseif (count($to)) {
    $mail->AddAddress($to, $to);
}

if(!$mail->send())
   return "Mailer Error: " . $mail->ErrorInfo;
else
    echo "true";
}*/
?>