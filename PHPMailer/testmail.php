<?php

include("PHPMailerAutoload.php");
require_once('PHPMailerAutoload.php');

//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->IsSMTP();
print_r($mail);
//Set who the message is to be sent from
$mail->setFrom('ganesh.euraka@gmail.com', 'Ganesh  G');
//Set an alternative reply-to address
$mail->addReplyTo('csungroupprojectsem1@gmail.com', 'csungroupprojectsem1');
//Set who the message is to be sent to
$mail->addAddress('csungroupprojectsem1@gmail.com', 'csungroupprojectsem1');
//Set the subject line
$mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';


//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}


?>