<?php 
session_start();
include("modal.php");
include("header.php");
include("conection.php");

//echo $_SESSION["uid"];
if(isset($_SESSION["userid"]))
{
	if($_SESSION["type"]=="admin")
	{
	header("Location: dashboard.php");
	}
	else if ($_SESSION["type"]=="lecturer")
	{	
	header("Location: lectureaccount.php");
	}
	else if($_SESSION["type"]=="student")
	{
     header("Location: professorscheduler.php");
	}
}




if(isset($_POST["uid"]) && isset($_POST["pwd"]) )
{
$result = mysqli_query($con,"SELECT * FROM administrator WHERE adminid='$_POST[uid]'");

    while($row = mysqli_fetch_array($result))
    {
        $pwdmd5 = $row["password"];
    }

  	//echo "post pass".md5($_POST["pwd"])."<br>";
	//echo "DB pass".	$pwdmd5;
    if(md5($_POST["pwd"])==$pwdmd5)
    {
        $_SESSION["userid"] = $_POST["uid"];
        $_SESSION["type"]="admin";
        header("Location: dashboard.php");
    }
    else
    {
        $result = mysqli_query($con,"SELECT * FROM studentdetails WHERE studid='$_POST[uid]'");
        	while($row = mysqli_fetch_array($result))
         	 {
                $pwdm= $row["password"];
        	    $_SESSION["cid"] = $row["courseid"];
        	    $_SESSION["stu_email"]=$row["email"];
          	}
          	//echo "post pass".md5($_POST["pwd"])."<br>";
        	//echo "DB pass".	$pwdm;

        if(md5($_POST["pwd"])==$pwdm)
        	{
        	    $_SESSION["userid"] = $_POST["uid"];
        	    $_SESSION["type"] ="student";
            	header("Location: schedulerview.php");
        	}
        else
        	{
        		$log =  "Login failed.. Please try again..";
        	}
    }
}

if(isset($_POST["luid"]) && isset($_POST["lpwd"]))
{

$result = mysqli_query($con,"SELECT * FROM lectures WHERE lecid='$_POST[luid]'");
	while($row = mysqli_fetch_array($result))
 	 {
$pwdm= $row["password"];
$_SESSION["lecname"] = $row["lecname"];
$_SESSION["coid"] = $row["courseid"];
  	}
//echo"pwd". md5($_POST["lpwd"]);

if(md5($_POST["lpwd"])==$pwdm)
	{
		//echo $_POST["lpwd"];
	$_SESSION["userid"] = $_POST["luid"];
	$_SESSION["type"] ="lecturer";
	header("Location: lectureaccount.php");
	}
else
	{
		$log =  "Login failed.. Please try again..";
	}
}


if(isset($_POST["uid"]) && isset($_POST["pwd"]) && $_POST["select"]=="student" )
{


}

?>
<section id="page">
<header id="pageheader" class="normalheader">
<h2 class="sitedescription">
</h2>
</header>

<section id="contents">

<article class="post">
<header class="postheader">

<h2><?php echo $log;?></h2>
</header>
<section class="entry">
<?php
  	if($_SESSION["type"]=="admin")
  	{
?>
          <label for="author">
                 <h2>Welcome: <? echo $_SESSION["userid"];  ?></h2>
          </label>
<?php
  	}
  	else if ($_SESSION["type"]=="student")
  	{
?>
          <label for="author">
                 <h2>Welcome: <? echo $_SESSION["userid"]; ?></h2>
              </label>
<?php
  	}else{
?>
        <h2><u>Login</u></h2>
        <form action="admin.php" method="post" class="form">
        <p class="textfield">
          <label for="author">
                 <small>Login ID (required)</small>
              </label>
               <input name="uid" id="uid" value="" size="22" tabindex="1" type="text">
        </p>
        <p class="textfield">
        <label for="email">
                  <small>Password (required)</small>
              </label>
           <input name="pwd" id="pwd" value="" size="22" tabindex="2" type="password">
        </p>

        <!--<p class="textfield">
            <label for="select"><small>Type(required)</small>
            </label>
            <select name="select" id="select"  type="text">
                <option value='admin'>admin</option>
                <option value='student'>student</option>
            </select>
          </p>-->
        <p>

         <input name="submit" id="submit" tabindex="5" type="image" src="images/submit.png">
         <input name="comment_post_ID" value="1" type="hidden">
        <p class="textfield">
            <a href="#"  onClick="openstudent(); return false">Signup</a> &nbsp;|&nbsp; <a href="#" onClick="openforgotpassword(); return false"/>Forgot Password? </a>
        </p>
        </p>
        <div class="clear"></div>
        </form>
<?php
     }
?>

  <!--<form action="admin.php" method="post" class="form">
<div class="clear">
<hr />
  <header class="postheader">
    <h2><u>Lectures Login</u></h2>
    <h2><?php echo $log;?></h2>
  </header>
  <section class="entry">

      <p class="textfield">
        <label for="author2"> <small><br />
          Lecture Login ID (required)</small> </label>
        <input name="luid" id="luid" value="" size="22" tabindex="3" type="text" />
      </p>
      <p class="textfield">
        <label for="email2"> <small>Password (required)</small> </label>
        <input name="lpwd" id="lpwd" size="22" tabindex="4" type="password" />
      </p>
      <p>
        <input name="submit2" id="submit2" tabindex="5" type="image" src="images/submit.png" />
        <input name="comment_post_ID2" value="1" type="hidden" />
      </p>
      <div class="clear"></div>
    </form>-->

  <form action="admin.php" method="post" class="form">
<!--<div class="clear">
<hr />
  <header class="postheader">
    <h2><u>Students Login</u></h2>
    <h2><?php echo $log;?></h2>
  </header>
  <section class="entry">

      <p class="textfield">
        <label for="author2"> <small><br />
          Students Login ID (required)</small> </label>
        <input name="suid" id="suid" value="" size="22" tabindex="3" type="text" />
      </p>
      <p class="textfield">
        <label for="email2"> <small>Password (required)</small> </label>
        <input name="spwd" id="spwd" size="22" tabindex="4" type="password" />
      </p>
      <p>
        <input name="submit3" id="submit3" tabindex="5" type="image" src="images/submit.png" />
        <input name="comment_post_ID2" value="1" type="hidden" />
      </p>
      <div class="clear"></div>
    </form>


    <div class="clear"></div>
  </section>
</div>-->
</section>
</article>
</section>

<?php 
include("adminmenu.php");
include("footer.php"); ?>