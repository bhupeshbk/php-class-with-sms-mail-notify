<?php
include_once("class_sms_mail_notify.php");

$SMSsend = 0;
$PhpMail = 0;
$SmtpMail = 1;
$pushNotify = 0;

/* —————————————————————————————————————————————————————————————————————————————————————
* Send SMS
* ————————————————————————————————————————————————————————————————————————————————————— */
if($SMSsend == 1){		
	$sms_host = "192.168.0.101";
    $sms_port = "8080";
    $sms_username = "bhupesh";
    $sms_password = "*******";
    $sms_sender = "PRAGMA";
	$message = "Hello";
	$mobile = "9924773417";
	
	$push = new sendSMS($sms_host ,$sms_port ,$sms_username ,$sms_password ,$sms_sender ,$message ,$mobile);
	$res = $push->sendSmtpMail();
	print_r($res);
}
/* —————————————————————————————————————————————————————————————————————————————————————
* Send Simple PHP Mail
* ————————————————————————————————————————————————————————————————————————————————————— */
if($PhpMail == 1){	
	$to = "bhupeshbk@yahoo.com";
    $cc = "bhupeshbk.143@gmail.com";
    $Subject = "Send Mail";
    $from = "notification.ckpcet@gmail.com";
	$html = "Hello,Phpmail";
	
	$push = new PHPsendMail($to ,$cc ,$Subject ,$from ,$html);
	$res = $push->sendPhpMail();
	print_r($res);
}
/* —————————————————————————————————————————————————————————————————————————————————————
* Send SMTP PHP Mail
* ————————————————————————————————————————————————————————————————————————————————————— */
if($SmtpMail == 1){
	$Username = "notification.ckpcet@gmail.com";
    $Password = "ckpcet2015";
    $SMTPSecure = "tls";
    $Port = "587";
    $Subject = "Send Mail";
    $to = "bhupeshbk@yahoo.com";
	$to_name = "Bhupesh Kushwaha";
	$html = "Hello,Phpmail";
	
	$push = new SMTPsendMail($Username ,$Password ,$SMTPSecure ,$Port ,$Subject ,$to ,$to_name ,$html);
	$res = $push->sendSmtpMail();
	print_r($res);
}
/* —————————————————————————————————————————————————————————————————————————————————————
* Push Notification Android
* ————————————————————————————————————————————————————————————————————————————————————— */
if($pushNotify == 1){
	$push_token = "dFYO7QmTdDU:APA91bG-ovainribbeTKs6dcXMBqiXLYO6vPIZyRoB54mvY7hsvtAd0Ic1pS8V8R0fX3YrPiCrrK27zuBBzeV1RybrlbfoyLw5tFqV6Y5ipg436zflcjCGrzG9YzOxVlyyfjMLqsQmH8";
	$c_id = "180";
	$push = new PushNotification_Android('The push title','The message',$push_token ,$c_id);
	$ret = $push->sendToAndroid();
	print_r($ret);
	
	$push_token = "d6QqUsX17D4:APA91bFo4X733hkYWXygdL6kVfEtc-rJA6jug0qEP0y9yWt7zFAwt0dBEb1AYoMVAYcKaV_lRBJRLlrtTEOeRYnpmOSZZlLL1BRqFda8pAUFUJ8XKwLOfWgte1PrbWg_muWWQBu5T9St";
	$d_id = "33";
	$push = new PushNotification_Android('The push title','The message',$push_token ,$d_id);
	$ret = $push->sendToAndroid();
	print_r($ret);
}

?>