<?php
/*date_default_timezone_set('asia/kolkata');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require 'Send_Mail.php';
$to = "shachishsneh@gmail.com";
$subject = "Test Mail Subject";
$body = "Hi<br/>Test Mail<br/>Amazon SES"; // HTML  tags
Send_Mail($to,$subject,$body);
?>