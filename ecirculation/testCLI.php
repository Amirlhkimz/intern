#!/opt/lampp/bin/php-5.2.9
<?php
ini_set('include_path','/opt/lampp/lib/php/');
require_once('Mail.php');
$recipients = "kamal@spa.gov.my";
$headers["From"]="kamal@spa.gov.my";
$headers["To"]="kamal@spa.gov.my";
$headers["Subject"]="Cuba CLI";
$mailmsg="Ini percubaan CLI dan Cronjob 4";

$smtpinfo["host"]= "postmaster.1govuc.gov.my";
$smtpinfo["port"]="25";
$smtpinfo["auth"]= false;

$mail_object =& Mail::factory("smtp",$smtpinfo);

$mail_object->send($recipients, $headers, $mailmsg);
?>
