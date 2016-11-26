<?php
session_start();
include("validation.php");
include("conection.php");
include("modal.php");


if(isset($_POST["uid"]))
{
$new_password= randomPassword();

$result = mysqli_query($con,"SELECT * FROM studentdetails WHERE studid='$_POST[uid]' OR email='$_POST[uid]' ");
	while($row = mysqli_fetch_array($result))
 	 {
        //$pwdm= $row["password"];
        $stu_email= $row["email"];
  	}
  	//echo $new_password;
    $pass_enc = md5($new_password);
    //echo $pass_enc;
	$update = mysqli_query($con,"UPDATE studentdetails SET password='$pass_enc' WHERE studid='$_POST[uid]' OR email='$_POST[uid]' ");

	// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: admin@adminmaster.com' . "\r\n" .
     'Reply-To:' .$stu_email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

	$message= "Hi ".$_POST[uid].", </br>";
	$message .= " Your new password is ".$new_password."</br>";

	 mail($stu_email, "Password Reset", $message,$headers);

if(isset($stu_email))
	{
	    $_SESSION["userid"] = $_POST["uid"];
	    $log =  "Password sent to  associated email, Please check.";
	}
else
	{
		$log =  "No UserName associated";
	}
}

function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
}
?>
       <form action="forgotpassword.php" method="post" class="form">
       </br></br>
        <center><p class="textfield">
          <label for="author">
                 <small>Login ID /Email</small>
          </label>
            <input name="uid" id="uid" value="" size="50" tabindex="1" type="text"></br></br>
           <input name="submit" id="submit" tabindex="5" type="image" src="images/submit.png"></center>
           <h4><?php echo $log;?></h4>
        </p>
        </form>


