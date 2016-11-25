<?php
session_start();
include('config.php');

$type = $_POST['type'];

if(strlen($type)<=0){
	$type= $_GET['type'];
}


$lecid=$_POST[lecid];

if(strlen($lecid)<=0){
	$lecid= $_SESSION[lecid];
}
//Override default zone
$_POST['zone']= "07:00";

if($type == 'new')
{
	$startdate = $_POST['startdate'].'-'.$_POST['zone'];
	$title = $_POST['title'];
	$insert = mysqli_query($con,"INSERT INTO calendar(`title`, `startdate`, `enddate`,`lecid`, `allDay`) VALUES('$title','$startdate','$startdate','$_SESSION[lecid]','false')");
	$lastid = mysqli_insert_id($con);
	//sendmail ($_SESSION["stu_email"], $_SESSION["lec_email"], "APPONTMENT REQUEST", "Blah blah" );

	//$headers = "From: ".$fromemail . "\r\n" . 	"CC: ganesh.euraka@gmail.com";
	// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    //$headers .= 'From: '.$_SESSION["stu_email"] . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";

    $headers = 'From: '.$_SESSION["stu_email"] . "\r\n" .
        'Reply-To:' .$_SESSION["lec_email"] . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
	echo "sdsds".$headers;

	$url="http://localhost/kashipara.com_student-managment-system-zip/student%20managment%20system/StudentInformationProject/fullcalendar/process.php?type=accept&eventid=".$lastid;
	$message= "Hi ".$lecid."</br>";
	$message .= $_SESSION['stu_email']." has requested for appointment between ".$startdate." to ".$startdate."</br>";
	$message .= "To confirm please <a href=".$url.">click here</a>";

	 echo mail($_SESSION["lec_email"], "APPONTMENT REQUEST", $message,$headers);

	echo json_encode(array('status'=>'success','eventid'=>$lastid,'lecid'=>$lecid));
}

if($type == 'accept')
{
	$eventid = $_GET['eventid'];

	$update = mysqli_query($con,"UPDATE calendar SET status='accepted' where id='$eventid'");
	if($update){
		echo json_encode(array('status'=>'success'));
		echo "Accepted";
	}else{
		echo json_encode(array('status'=>'failed'));
		echo "Declined";
	}
}

if($type == 'changetitle')
{
	$eventid = $_POST['eventid'];
	$title = $_POST['title'];
	$update = mysqli_query($con,"UPDATE calendar SET title='$title' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'resetdate')
{
	$title = $_POST['title'];
	$startdate = $_POST['start'];
	$enddate = $_POST['end'];
	$eventid = $_POST['eventid'];
	$update = mysqli_query($con,"UPDATE calendar SET title='$title', startdate = '$startdate', enddate = '$enddate' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'remove')
{
	$eventid = $_POST['eventid'];
	$delete = mysqli_query($con,"DELETE FROM calendar where id='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'fetch')
{   //echo $_SESSION['lecid'];
	$events = array();

	if($_SESSION["type"]=="admin")
	{
		$query = mysqli_query($con, "SELECT * FROM calendar ");
	}
	else if ($_SESSION["type"]=="student")
	{
		$query = mysqli_query($con, "SELECT * FROM calendar where lecid= '$_SESSION[lecid]' ");
	}
	/*if (!$query) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}*/
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$e = array();
    $e['id'] = $fetch['id'];
    $e['title'] = $fetch['title'];
    $e['start'] = $fetch['startdate'];
    $e['end'] = $fetch['enddate'];
    $e['status'] = $fetch['status'];
    $e['lecid'] = $_SESSION['lecid'];

    $allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;

    array_push($events, $e);
	}
	echo json_encode($events);
}

/*function sendmail ($fromemail, $toemail, $subject, $message ){

	$headers = "From: ".$fromemail . "\r\n" . 	"CC: ganesh.euraka@gmail.com";
	 mail($toemail,$subject,$message,$headers); }*/


?>