
<!doctype html>

<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Student Information System</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="styles/print/main.css" rel="stylesheet" type="text/css" media="print">
<script src="js/jquery.js"></script>
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if IE 6]>
<script src="js/belatedPNG.js"></script>
<script>
	DD_belatedPNG.fix('*');
</script>
<![endif]-->

<script type="text/javascript">
$(document).ready(function()
{
  $("tr:even").css("background-color", "#77A3C3");
});

function Openeditcourse(a)
{
	var links = "courseinsert.php?slid=" + a + "&view=course";
  var ReturnedValue = showModalDialog(links,"Passed String","dialogWidth:450px; dialogHeight:400px; status:no; center:yes");
	//alert("Modal Dialog returned '" + ReturnValued + "'");
}

</script>
</head>

<body>
<div id="wrap">

<section id="top">
<nav id="mainnav">
<h1 id="sitename" class="logotext">
<!--<a href="index.php">Philo Milestone</a>-->
</h1>
<ul>

<?php
  	if($_SESSION["type"]=="admin")
  	{
?>
<!--<li class="active"><a href="index.php"><span>Home</span></a></li
<li><a href="viewresult.php"><span>STUDENTS</span></a></li>>-->
<li><a href="viewlecturer.php"><span>Calendar Feed</span></a></li>
<li><a href="admin.php"><span>Home</span></a></li>
<li><a href="contact.php"><span>CONTACT-US</span></a></li>

<?php
  	}
  	else if ($_SESSION["type"]=="student")
  	{
?>
<li><a href="admin.php"><span>Home</span></a></li>
<li><a href="contact.php"><span>CONTACT-US</span></a></li>
<?php
  	}
?>

</ul>
</nav>
</section>