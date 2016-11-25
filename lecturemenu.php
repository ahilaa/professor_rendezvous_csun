<?php 
session_start();
?>
<section id="sidebar">
<?php
//echo "userid".$_SESSION["userid"];
if(isset($_SESSION["userid"]))
{
?>
<h2>Profile</h2>
<ul>
	<li>Students ID : <?php echo $_SESSION["userid"] ; ?></li>

</ul>
<h2>Menu</h2>
<ul>
	<li><a href="course.php">Course</a></li>
    <!--<li><a href="subject.php">Subject</a></li>
    <li><a href="lecturevieww.php">Lecture Profile</a></li>
    <li><a href="student.php">Student</a></li>
    <li><a href="attendanceview.php">Attendance</a></li>
    <li><a href="examview.php">Examination</a></li>-->
    <li><a href="schedulerview.php">Scheduler</a></li>

</ul>
<!--<h2>Reports</h2>
<ul>
	<li><a href="#nogo">Student Report</a></li>
    <li><a href="#nogo">Attendance Report</a></li>
    <li><a href="#nogo">Examination Report</a></li>

</ul>-->

<h2><a href="logout.php">Logout</a></h2>
<?php
}
?>
</section>
<div class="clear"></div>

<div class="clear"></div>
</section>
</div>