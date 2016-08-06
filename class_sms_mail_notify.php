<?php
/* —————————————————————————————————————————————————————————————————————————————————————
* Send SMS
* ————————————————————————————————————————————————————————————————————————————————————— */
class sendSMS
{
	private $sms_host;
	private $sms_port;
	private $sms_username;
	private $sms_password;
	private $sms_sender;
	private $message;
	private $mobile;

    public function __construct($sms_host, $sms_port, $sms_username , $sms_password ,$sms_sender ,$message ,$mobile){
        $this->sms_host = $sms_host;
        $this->sms_port = $sms_port;
        $this->sms_username = $sms_username;
		$this->sms_password = $sms_password;
		$this->sms_sender = $sms_sender;
		$this->message = $message;
		$this->mobile = $mobile;
    }
	
    public function sendSMS(){
		include_once('sms.php');
		
		$obj = new Sender($this->sms_host , $this->sms_port, $this->sms_username, $this->sms_password, $this->sms_sender, $this->message , $this->mobile, "0", "1");
					
		if($obj->Submit()) 
			return "done";
		else 
			return "failed";
	}
}
/* —————————————————————————————————————————————————————————————————————————————————————
* Send Simple PHP Mail
* ————————————————————————————————————————————————————————————————————————————————————— */
class PHPsendMail
{
	private $to;
    private $cc;
    private $subject;
    private $from;    
    private $html;
	var $headers;

    public function __construct($to, $cc, $subject , $from  ,$html){
        $this->to = $to;
        $this->cc = $cc;
        $this->subject = $subject;
		$this->from = $from;
		$this->headers  = NULL;  
		$this->html = $html;
    }
	
    public function sendPhpMail(){
		//parseBody
		if($this->html) 
		{
			$content = "
			<style>
				BODY {
				  font-family: verdana;
				  font-size: 10;
				}
			</style>
			".$this->html;
		}
		$this->body = $content;
		//setHeaders
		$this->headers = "From: $this->from\r\n";
		$this->headers.= "MIME-Version: 1.0\r\n";
		$this->headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		if(!empty($this->cc)){
			$this->headers.= "Cc: $this->cc\r\n";
		}
		//send
		if(mail($this->to, $this->subject, $this->body, $this->headers)) 
			return "done";
		else 
			return "failed";
	}

}
/* —————————————————————————————————————————————————————————————————————————————————————
* Send SMTP PHP Mail
* ————————————————————————————————————————————————————————————————————————————————————— */
class SMTPsendMail
{
	private $Username;
    private $Password;
    private $SMTPSecure;
    private $Port;
    private $Subject;
    private $to;
	private $to_name;
	private $html;

    public function __construct($Username, $Password, $SMTPSecure , $Port ,$Subject ,$to ,$to_name ,$html){
        $this->Username = $Username;
        $this->Password = $Password;
        $this->SMTPSecure = $SMTPSecure;
		$this->Port = $Port;
		$this->Subject = $Subject;
		$this->to = $to;
		$this->to_name = $to_name;
		$this->html = $to_name;
    }
	
    public function sendSmtpMail(){
		require 'PHPMailer/PHPMailerAutoload.php';
		require 'PHPMailer/class.phpmailer.php';
		$mail = new PHPMailer;				
		$mail->isSMTP(true);  
		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		);
		$mail->Host = gethostbyname('smtp.gmail.com');  
		$mail->SMTPAuth = true;  
		
		if($this->html) 
		{
			$content = "
			<style>
				BODY {
				  font-family: verdana;
				  font-size: 10;
				}
			</style>
			".$this->html;
		}
		$this->body = $content;
	
		$mail->Username = $this->Username;                 
		$mail->Password = $this->Password;                           
		$mail->SMTPSecure = $this->SMTPSecure;                            
		$mail->Port = $this->Port;                                 
		
		$mail->setFrom($this->Username,'Jain');
		$mail->addAddress($this->to, $this->to_name);     
		$mail->isHTML(true);                                  				
		$mail->Subject = $this->Subject;
		$mail->Body    = $this->body;				
		$host = "smtp.gmail.com";
		$port = $this->Port;
					
		if(!$mail->send()) 
			return $mail->ErrorInfo;
		else 
			return "done";
	}
}
/* —————————————————————————————————————————————————————————————————————————————————————
* Push Notification Android
* ————————————————————————————————————————————————————————————————————————————————————— */
Class PushNotification_Android {
    private $title;
    private $message;
    private $pushtoken;
	private $cd_id;
	private $type;

    private static $ANDROID_URL = 'https://android.googleapis.com/gcm/send';
    private static $ANDROID_API_KEY = 'YOUR-KEY';

    public function __construct($title, $message, $pushtoken , $cd_id ,$type){
        $this->title = $title;
        $this->message = $message;
        $this->pushtoken = $pushtoken;
		$this->cd_id = $cd_id;
		$this->type = $type;
    }
	
    public function sendToAndroid(){
        $fields = array(
            'registration_ids' => array($this->pushtoken),
            'data' => array( "title"=>$this->title, "message" => $this->message ,'type'=>$this->type ,'id'=>$this->cd_id),
        );

        $headers = array(
            'Authorization: key=' . self::$ANDROID_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, self::$ANDROID_URL);
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER , false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST , false );

        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch);

        if( curl_errno($ch) ){
            curl_close($ch);
            return json_encode(array("status"=>"ko","payload"=>"Error: ".curl_error($ch)));
        }

        curl_close($ch);
        return $result;
    }
}
?>
