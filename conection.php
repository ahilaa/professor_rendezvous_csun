<?php
/*$con = mysql_connect("localhost","root","technology");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("studentinfo", $con);*/

$user = 'root';
$password = 'root';
$db = 'studentinfo';
$host = 'localhost';
$port = 3306;

$con = mysqli_init();

if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

$success = mysqli_real_connect(
   $con,
   $host,
   $user,
   $password,
   $db,
   $port
);
?>
