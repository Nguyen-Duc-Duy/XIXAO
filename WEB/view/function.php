<!-- hàm gửi email -->
<?php
//  hàm gửi email
function forgorPass($user,$content){
	include("../pre-admin/PHPMailer/class.phpmailer.php");
	include("../pre-admin/PHPMailer/class.smtp.php");
	$body = file_get_contents('../pre-admin/emailForgot.htm');
	$mail = new PHPMailer();

	$mail ->IsSMTP();
	$mail ->Host = 'tls://smtp.gmail.com:587';
	$mail ->SMTPAuth = true;
	$mail ->Username = 'shopxixao@gmail.com';
	$mail ->Password = 'shopxixao01';
	$mail ->Post = 587;
	$mail ->IsHTML(true);
	$mail ->SetFrom('shopxixao@gmail.com','shopxixao@gmail.com');
	$mail ->AddAddress($user,'my user');
	$mail ->CharSet  = "utf-8";
	$mail ->Subject = "Mã của bạn là $content";
	$mail ->Body = $body;
	//$mail ->MsgHTML($body);
	if(!$mail ->send()){
		echo "email chua duoc gui . xin thu lai !";
		echo "loi".$mail->ErrorInfo;

	}else{
		return "true";
	}

}
?>