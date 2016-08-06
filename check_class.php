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
        $sms_sender = "BHUPESH";
	$message = "Hello";
	$mobile = "1234567890";
	
	$push = new sendSMS($sms_host ,$sms_port ,$sms_username ,$sms_password ,$sms_sender ,$message ,$mobile);
	$res = $push->sendSMS();
	print_r($res);
}
/* —————————————————————————————————————————————————————————————————————————————————————
* Send Simple PHP Mail
* ————————————————————————————————————————————————————————————————————————————————————— */
if($PhpMail == 1){	
	$to = "to@yahoo.com";
        $cc = "cc@gmail.com";
        $Subject = "Send Mail";
        $from = "from@gmail.com";
	$html = "Hello,Phpmail";
	
	$push = new PHPsendMail($to ,$cc ,$Subject ,$from ,$html);
	$res = $push->sendPhpMail();
	print_r($res);
}
/* —————————————————————————————————————————————————————————————————————————————————————
* Send SMTP PHP Mail
* ————————————————————————————————————————————————————————————————————————————————————— */
if($SmtpMail == 1){
	$Username = "user@gmail.com";
        $Password = "password";
        $SMTPSecure = "tls";
        $Port = "587";
        $Subject = "Send Mail";
        $to = "to@yahoo.com";
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
	$type = "Demo Notify";
	$push_token = "Device REG-ID";
	$c_id = "180";
	$push = new PushNotification_Android('The push title','The message',$push_token ,$c_id,$type);
	$ret = $push->sendToAndroid();
	print_r($ret);
	
	$push_token = "Device REG-ID";
	$d_id = "33";
	$push = new PushNotification_Android('The push title','The message',$push_token ,$d_id,$type);
	$ret = $push->sendToAndroid();
	print_r($ret);
}

?>
