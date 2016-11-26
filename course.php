<?php 
session_start();

include("header.php"); 
include("conection.php");
include("modal.php");
$abc = 100;
if($_GET["view"] == "delete")
{
mysqli_query($con,"DELETE FROM course WHERE courseid ='$_GET[slid]'");
}
if(isset($_SESSION["userid"]))
{
	if(isset($_GET[first])) 
	{
	}
	else
	{
		$_GET[first] =0;
	$_GET[last] = 10;
	}
//echo "course".$_SESSION[cid];
//echo "email".$_SESSION["email"];
echo $_SESSION["userid"];
	if($_SESSION["type"]==admin){
		$result = mysqli_query($con,"SELECT * FROM course,lectures where  course.courseid=lectures.courseid LIMIT $_GET[first] , $_GET[last]");
	}else{
		$result = mysqli_query($con,"SELECT * FROM course,lectures,students_course_details  where course.courseid=lectures.courseid and students_course_details.courseid=course.courseid and students_course_details.studid='$_SESSION[userid]' LIMIT $_GET[first] , $_GET[last]");
	}


?>
<script language="Javascript">
function val()
{
	
if(confirm('Format the hard disk?'))
{
alert('You are very brave!');
}
else 
{
alert('A wise decision!')
}
      if(document.emp.txt1.value=="")
	{
		alert("Please enter userid");
		document.emp.txt1.focus();
		document.emp.txt1.select();
		return false;
	}
	else
	{
		return true;
	}	

}
</SCRIPT>
<section id="page">
<header id="pageheader" class="normalheader">
<h2 class="sitedescription">
  </h2>
</header>

<section id="contents">

<article class="post">
  <header class="postheader">
  <h2>Course Details</h2>
  </header>
  <section class="entry">
  <font color="#330000">
    <table width="100%" border="1">
  <tr>
    <th width="113" scope="col">SL. No.</th>
    <th width="122" scope="col">Course</th>
     <th width="122" scope="col">Course Name</th>
     <th width="122" scope="col">Lecturer Name</th>
     <?php
      if($_SESSION["type"]=="admin")
	{
		?>
    <th width="171" scope="col">Action</th>
    <?php
    }
    ?>
  </tr>
  
  <?php
  $i =$_GET[first]+1;
  while($row = mysqli_fetch_array($result))
  {
  $_SESSION[lecid]=$row['lecid'];
  $_SESSION[lec_email]=$row['email'];echo "lec_email]". $_SESSION[lec_email];
  echo "<tr>";
  echo "<td align=center>&nbsp;" . $i . "</td>";
  echo "<td>&nbsp;" . $row['coursekey'] . "</td>";
  echo "<td>&nbsp;" . $row['coursename'] . "</td>";

  echo "<td>&nbsp;<a href=schedulerview.php?lecid=".$row['lecid'].">" . $row['lecname'] . "</a></td>";
      if($_SESSION["type"]=="admin")
	{
   echo "<td>&nbsp;<a href='viewrecords.php?slid=$row[courseid]&view=course'><img src='images/view.png' width='32' height='32' /></a>";
 echo "<img src='images/edit.png' width='32' height='32'  onclick='Openeditcourse(". $row[courseid].")'/>";
 ?>
<a href="course.php?slid=<?php echo $row[courseid]; ?>&view=delete" onclick="return confirm('Are you sure??')">
 <?php
 echo "<img src='images/delete.png' width='32' height='32' /></a></td>";
	}

echo "</tr>&nbsp;";
	$i++;
  }
  if($_SESSION["type"]=="admin")
	{
$first=$_GET[first]-10;
$last= $_GET[last]- 10;
  ?>
  <tr>
    <th scope="col"><?php 
	if($first <0)
	{ 
	} 
	else 
	{ ?><a href="course.php?first=<?php echo $first; ?>&last=<?php echo $last; ?>">
    
    <?php 
	}
	?><img src="images/previous.png" width="32" height="32" /></a></th>
    <th scope="col">
  <a href="#" onClick="opennewsletter(); return false"><img src="images/add.png" width="32" height="32" /></a> <span id="youremail" style="color: red"></span>
  </a></th>
  <?php 
$first=$_GET[first]+10;
$last = $_GET[last]+ 10;
?>
    <th scope="col"><?php 
	if($first > mysqli_num_rows($result))
	{ 
	} 
	else 
	{ ?><a href="course.php?first=<?php echo $first; ?>&last=<?php echo $last; ?>">
    <?php
	}
	?><img src="images/next.png" width="32" height="32" /></a></th>
  </tr>
  <?php
	}
	?>
  </table>
  </section>
</article>


</section>

<?php 
}
else
{

		header("Location: admin.php");
}
if($_SESSION["type"]=="admin")
	{
	include("adminmenu.php");
	}
	else
	{	
	include("lecturemenu.php");
	}

include("footer.php"); 

?>