
<?php
$course=$_REQUEST['course'];
$link = mysqli_connect('localhost', 'root', 'root'); //changet the configuration in required
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysqli_select_db('studentinfo');
$query="select subid,subname from subject where courseid=$course";
$result=mysqli_query($con,$query);

?>
<select name="subject">
<option>Select Subject</option>
<? while($row=mysqli_fetch_array($result)) { ?>
<option value='<?=$row['subid']?>'><?php echo $row['subname']?></option>
<? } ?>
</select>
