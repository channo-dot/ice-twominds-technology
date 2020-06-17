 <?php 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = true;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
}
function getStatus($id)
{
	global $db;
	$db->where("requests_id",$id);
	$data = $db->getOne("order_assigned");
	if($db->count > 0)
	{
		$db->where("id",$data["salesmen_id"]);
		$user = $db->getOne("salesman");
		return $user["fname"] . " " .$user["lname"];
	}
	else {
		return "Not Assigned yet";
	}
}
function clientStatus($request_id)
{
	global $db;
	$db->where("requests_id",$request_id);
	$db->where("client_accept_status",1);
	$d = $db->getOne("order_assigned");
	if($db->count > 0) {
		$db->where("id",$data["salesmen_id"]);
		$user = $db->getOne("salesman");
		return $user["fname"] . " " .$user["lname"];
	} else {
		 return "Not Accepted";
	}
	
}
function sendEmail($subject,$msg,$email)
{
$dummy = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' valign='top' ><br>
<br>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' style='border-radius: 5px 5px 0 0; valign='top'><h3 style='padding-top: 19px;font-family:Arial, Helvetica, sans-serif;font-size: 38px;margin-bottom: 0px;padding-bottom: 20px;'>
<img src='http://nano.greetinfo.com/assets/images/logo.png'>
</h3></td>
</tr>
<tr>

<td align='center' valign='top'   font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#fff; padding:12px;'><table width='100%' border='0' cellspacing='0' cellpadding='10' style='margin-bottom:10px;'>
<tr>
<td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; >
<div style='font-size:18px; >".$msg."
</div> </td>
</tr>
</table>
<hr>
</td>
</tr>  
<tr>
<td align='left' valign='top'  style='border-radius: 0 0 5px 5px;'><table width='100%' border='0' cellspacing='0' cellpadding='15'>
<tr>
<td align='left' valign='top'  font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Company Address <br>
Contact Person <br>
Phone: (123) 456-789 <br>
Email: info@nano.com<br>
Website: http://www.nano.com/</td>
</tr>
</table></td>
</tr>
</table>
<br>
<br></td>
</tr>
</table>"; 

	
$mail = new PHPMailer(true); 
try {
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'em2.pwh-r1.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vegas@greetinfo.com';                 // SMTP username
$mail->Password = 'id=K,=Z=RHym';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom("solar@greetinfo.com", 'Nano');
$mail->addAddress($email);     // Add a recipient
//$mail->addReplyTo('chera.navneet007@gmail.com', 'Information');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $dummy;
$mail->AltBody = $subject;
$mail->send();
	
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}

function sendEmailPdf($subject,$msg,$email,$atch)
{
$dummy = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' valign='top' ><br>
<br>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' style='border-radius: 5px 5px 0 0; valign='top'><h3 style='padding-top: 19px;font-family:Arial, Helvetica, sans-serif;font-size: 38px;margin-bottom: 0px;padding-bottom: 20px;'>
<img src='http://nano.greetinfo.com/assets/images/logo.png'>
</h3></td>
</tr>
<tr>

<td align='center' valign='top'   font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#fff; padding:12px;'><table width='100%' border='0' cellspacing='0' cellpadding='10' style='margin-bottom:10px;'>
<tr>
<td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; >
<div style='font-size:18px; >".$msg."
</div> </td>
</tr>
</table>
<hr>
</td>
</tr>  
<tr>
<td align='left' valign='top'  style='border-radius: 0 0 5px 5px;'><table width='100%' border='0' cellspacing='0' cellpadding='15'>
<tr>
<td align='left' valign='top'  font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Company Address <br>
Contact Person <br>
Phone: (123) 456-789 <br>
Email: info@nano.com<br>
Website: http://www.nano.com/</td>
</tr>
</table></td>
</tr>
</table>
<br>
<br></td>
</tr>
</table>"; 

	
$mail = new PHPMailer(true); 
try {
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'em2.pwh-r1.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vegas@greetinfo.com';                 // SMTP username
$mail->Password = 'id=K,=Z=RHym';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom("solar@greetinfo.com", 'Nano');
$mail->addAddress($email);     // Add a recipient
//$mail->addReplyTo('chera.navneet007@gmail.com', 'Information');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $dummy;
$mail->AltBody = $subject;
$mail->addAttachment($atch,"/");  
$mail->send();
	
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

}
function sendQuoteMail($subject,$msg,$email,$atch,$doc)
{
$dummy = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' valign='top' ><br>
<br>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' style='border-radius: 5px 5px 0 0; valign='top'><h3 style='padding-top: 19px;font-family:Arial, Helvetica, sans-serif;font-size: 38px;margin-bottom: 0px;padding-bottom: 20px;'>
<img src='http://nano.greetinfo.com/assets/images/logo.png'>
</h3></td>
</tr>
<tr>

<td align='center' valign='top'   font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#fff; padding:12px;'><table width='100%' border='0' cellspacing='0' cellpadding='10' style='margin-bottom:10px;'>
<tr>
<td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; >
<div style='font-size:18px; >".$msg."
</div> </td>
</tr>
</table>
<hr>
</td>
</tr>  
<tr>
<td align='left' valign='top'  style='border-radius: 0 0 5px 5px;'><table width='100%' border='0' cellspacing='0' cellpadding='15'>
<tr>
<td align='left' valign='top'  font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Company Address <br>
Contact Person <br>
Phone: (123) 456-789 <br>
Email: info@nano.com<br>
Website: http://www.nano.com/</td>
</tr>
</table></td>
</tr>
</table>
<br>
<br></td>
</tr>
</table>"; 

	
$mail = new PHPMailer(true); 
try {
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'em2.pwh-r1.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vegas@greetinfo.com';                 // SMTP username
$mail->Password = 'id=K,=Z=RHym';                           // SMTP password
$mail->SMTPSecure = 'tls';   
//$mail->SMTPDebug = 2;                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom("solar@greetinfo.com", 'Nano');
$mail->addAddress($email);     // Add a recipient
//$mail->addReplyTo('chera.navneet007@gmail.com', 'Information');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $dummy;
$mail->AltBody = $subject;
if($doc!="")
$mail->addAttachment($doc);  
$mail->addAttachment($atch);  


$mail->send();
	
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
function sendQuotePdfOnly($subject,$msg,$email,$atch)
{
$dummy = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' valign='top' ><br>
<br>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' style='border-radius: 5px 5px 0 0; valign='top'><h3 style='padding-top: 19px;font-family:Arial, Helvetica, sans-serif;font-size: 38px;margin-bottom: 0px;padding-bottom: 20px;'>
<img src='http://nano.greetinfo.com/assets/images/logo.png'>
</h3></td>
</tr>
<tr>

<td align='center' valign='top'   font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#fff; padding:12px;'><table width='100%' border='0' cellspacing='0' cellpadding='10' style='margin-bottom:10px;'>
<tr>
<td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; >
<div style='font-size:18px; >".$msg."
</div> </td>
</tr>
</table>
<hr>
</td>
</tr>  
<tr>
<td align='left' valign='top'  style='border-radius: 0 0 5px 5px;'><table width='100%' border='0' cellspacing='0' cellpadding='15'>
<tr>
<td align='left' valign='top'  font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Company Address <br>
Contact Person <br>
Phone: (123) 456-789 <br>
Email: info@nano.com<br>
Website: http://www.nano.com/</td>
</tr>
</table></td>
</tr>
</table>
<br>
<br></td>
</tr>
</table>"; 

	
$mail = new PHPMailer(true); 
try {
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'em2.pwh-r1.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vegas@greetinfo.com';                 // SMTP username
$mail->Password = 'id=K,=Z=RHym';                           // SMTP password
$mail->SMTPSecure = 'tls';   
//$mail->SMTPDebug = 2;                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom("solar@greetinfo.com", 'Nano');
$mail->addAddress($email);     // Add a recipient
//$mail->addReplyTo('chera.navneet007@gmail.com', 'Information');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $dummy;
$mail->AltBody = $subject;
$mail->addAttachment($atch);  
$mail->send();
	
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}


}
function sendContEmail($subject,$msg,$email)
{
$dummy = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' valign='top' ><br>
<br>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' style='border-radius: 5px 5px 0 0; valign='top'><h3 style='padding-top: 19px;font-family:Arial, Helvetica, sans-serif;font-size: 38px;margin-bottom: 0px;padding-bottom: 20px;'>
<img src='http://nano.greetinfo.com/assets/images/logo.png'>
</h3></td>
</tr>
<tr>

<td align='center' valign='top'   font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#fff; padding:12px;'><table width='100%' border='0' cellspacing='0' cellpadding='10' style='margin-bottom:10px;'>
<tr>
<td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; >
<div style='font-size:18px; >".$msg."
</div> </td>
</tr>
</table>
<hr>
</td>
</tr>  
<tr>
<td align='left' valign='top'  style='border-radius: 0 0 5px 5px;'><table width='100%' border='0' cellspacing='0' cellpadding='15'>
<tr>
<td align='left' valign='top'  font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Company Address <br>
Contact Person <br>
Phone: (123) 456-789 <br>
Email: info@nano.com<br>
Website: http://www.nano.com/</td>
</tr>
</table></td>
</tr>
</table>
<br>
<br></td>
</tr>
</table>"; 

	
$mail = new PHPMailer(true); 
try {
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'em2.pwh-r1.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vegas@greetinfo.com';                 // SMTP username
$mail->Password = 'id=K,=Z=RHym';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom("solar@greetinfo.com", 'Nano');
$mail->addAddress($email);     // Add a recipient
//$mail->addReplyTo('chera.navneet007@gmail.com', 'Information');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $dummy;
$mail->AltBody = $subject;
$mail->send();
	
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
function sendEmailNews($subject,$msg,$email)
{
$dummy = "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' valign='top' ><br>
<br>
<table width='600' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td align='center' style='border-radius: 5px 5px 0 0; valign='top'><h3 style='padding-top: 19px;font-family:Arial, Helvetica, sans-serif;font-size: 38px;margin-bottom: 0px;padding-bottom: 20px;'>
<img src='http://nano.greetinfo.com/assets/images/logo.png'>
</h3></td>
</tr>
<tr>

<td align='center' valign='top'   font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#fff; padding:12px;'><table width='100%' border='0' cellspacing='0' cellpadding='10' style='margin-bottom:10px;'>
<tr>
<td align='left' valign='top' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; >
<div style='font-size:18px; >".$msg."
</div> </td>
</tr>
</table>
<hr>
</td>
</tr>  
<tr>
<td align='left' valign='top'  style='border-radius: 0 0 5px 5px;'><table width='100%' border='0' cellspacing='0' cellpadding='15'>
<tr>
<td align='left' valign='top'  font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Company Address <br>
Contact Person <br>
Phone: (123) 456-789 <br>
Email: info@nano.com<br>
Website: http://www.nano.com/</td>
</tr>
</table></td>
</tr>
</table>
<br>
<br></td>
</tr>
</table>"; 

	
$mail = new PHPMailer(true); 
try {
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'em2.pwh-r1.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vegas@greetinfo.com';                 // SMTP username
$mail->Password = 'id=K,=Z=RHym';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom("solar@greetinfo.com", 'Nano');
$mail->clearAddresses();
if(!empty($email))
{
$mail->addAddress($email);
} else {
	return false;
}
     // Add a recipient
//$mail->addReplyTo('chera.navneet007@gmail.com', 'Information');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $dummy;
$mail->AltBody = $subject;
$mail->send();
	
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}

?>