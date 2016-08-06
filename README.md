# php-class-with-sms-mail-notify-
Php class for sms,mail(php and smtp),notification for adnroid

#Installation
1. Download https://github.com/bhupeshbk/PHPMailer
2. add in this forder

#Class Features
<ul>
<li>1.Send SMS</li>
<li>2.SEND MAIL</li>
<li>3.SEND SMTP MAIL</li>
<li>4.SEND ANROID NOTIFICATION</li>
</ul>

#A Simple Example
<pre>

include_once("class_sms_mail_notify.php");
$SMSsend = 1;
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

</pre>

