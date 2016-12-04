<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '/PHPMailer/PHPMailerAutoload.php';



function sendMail($fromemail, $toemail, $subject, $message)
{
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		
		//Set the hostname of the mail server
		//$mail->Host = 'smtp.gmail.com';
		// use
		 $mail->Host = gethostbyname('smtp.gmail.com');
		
		 $mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);
		// if your network does not support SMTP over IPv6
		
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "csungroupprojectsem1@gmail.com";
		
		//Password to use for SMTP authentication
		$mail->Password = "family17";
		
		//Set who the message is to be sent from
		$mail->setFrom($fromemail, 'Admin');
		
		//Set an alternative reply-to address
		$mail->addReplyTo($fromemail, 'Admin');
		
		//Set who the message is to be sent to
		$mail->addAddress($toemail, '');
		
		//Set the subject line
		$mail->Subject =  $subject;
		
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($message);
		
		//Replace the plain text body with one created manually
		//$mail->AltBody = 'This is a plain-text message body';
		
		//Attach an image file
		//$mail->addAttachment('examples/images/phpmailer_mini.png');
		
		//send the message, check for errors
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    echo "Message sent!";
		}
}
