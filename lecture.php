<?php
include("validation.php");

include("conection.php");

$totcourse = mysqli_query($con,"SELECT * FROM lectures");
$result1 = mysqli_query($con,"SELECT * FROM course");
$totid = mysqli_num_rows($totcourse)+1;

if(isset($_POST[button]))
{
	$pwde = md5($_POST[password]);
$sql="INSERT INTO lectures (lecid, password, courseid, cal_feed_url, email, lecname, gender, address ,contactno)
VALUES
('$_POST[lecid]','$pwde', '$_POST[course]', '$_POST[feedurl]',  '$_POST[email]', '$_POST[lecname]', '$_POST[gender]','$_POST[address]','$_POST[contactno]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  else
  {
	  echo "Record inserted Successfully...";
  }
}

if(isset($_POST["button2"]))
{
	$pwde = md5($_POST[password]);
mysqli_query($con,"UPDATE lectures SET lecname='$_POST[lecname]',     gender='$_POST[gender]', cal_feed_url='$_POST[feedurl]' ,  address='$_POST[address]', courseid='$_POST[coursekey]',	contactno='$_POST[contactno]', email='$_POST[email]' WHERE lecid = '$_POST[lecid]'");
echo "Record updated successfully...";
}


if($_GET["view"] == "lectures")
{
$result = mysqli_query($con,"SELECT * FROM lectures where lecid='$_GET[slid]'");
 while($row1 = mysqli_fetch_array($result))
  {
	$lec_id = $row1["lecid"];
	$lecname = $row1["lecname"];
	$password = $row1["password"];
	$courseid = $row1["courseid"];
	$feedurl = $row1["cal_feed_url"];
	$gender = $row1["gender"];
	$address = $row1["address"];
	$contactno = $row1["contactno"];
	$lecemail = $row1["email"];
	}
}
else
{
$result = mysqli_query($con,"SELECT * FROM lectures");
}

?> 
<form name="form1" method="post" action="" id="formID">
  <p>&nbsp;</p>
  <p>
    <label for="lecid">Lecturer User ID&nbsp;&nbsp;&nbsp;</label>
    <input type="text" name="lecid" id="lecid" class="validate[required] text-input"  value="<?php echo $lec_id; ?>">
  </p>
  <p>
  <label for="lecname">Lecturer Name</label>
    <input type="text" name="lecname" id="lecname" class="validate[required,custom[onlyLetterSp]] text-input" value="<?php echo $lecname; ?>">
  <!--</p>
  <p>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="validate[required] text-input">
  </p>
  <p>
    <label for="textfield4">Confirm Password</label>
    <input type="password" name="textfield4" id="textfield4" class="validate[required,equals[password]] text-input">
  </p>-->
    <p>
      <label for="textfield3">Email</label>
      <input type="text" name="email" id="textemail" size="50" class="validate[required] text-input" value="<?php echo $lecemail; ?>">
    </p>
  <p>
    <label for="textfield2">Course </label>
    <select name="course" value="<?php echo $courseid; ?>">
      <option value="">Course Details</option>
      <?php
	  while($row1 = mysqli_fetch_array($result1))
  {
	  if($courseid  == $row1[courseid])
	  {
		  $selvar = "selected";
	  }
  echo "<option value='$row1[courseid]' ". $selvar . ">$row1[coursekey]</option>";
  $selvar ="";
  }
  ?>
    </select>
  </p>
    <p>
      <label for="address">Calendar Feed Url</label>
       <input type="text" name="feedurl" id="feedurl" class="validate[required] text-input"  value="<?php echo $feedurl; ?>">
    </p>
  <p>Gender
    <input type="radio" name="gender" id="radio" value="Male" <?php
  if($gender == "Male")
  {
	  echo "checked";
  }
  ?> class="validate[required] radio" />
    <label for="radio">Male</label>
    <input type="radio" name="gender" id="radio2" value="Female"  <?php if($gender == "Female")
  {
	  echo "checked";
  }?> class="validate[required] radio" />
    <label for="radio2">Female</label>
  </p>
  <p>
    <label for="address">Address</label>
    <textarea name="address" id="address" class="validate[required]" cols="25" rows="5"><?php echo $address; ?></textarea>
  </p>
  <p>
    <label for="contactno">Contact No</label>
    <input type="text" name="contactno" id="contactno" class="validate[required,custom[phone]] text-input"  value="<?php echo $contactno; ?>">
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit"> 
      <input type="submit" name="button2" id="button2" value="Update" />
    <input type="submit" name="button2" id="button2" value="Reset">
<form id="myform">
  <input type="button" value="Close" name="B1" onClick="parent.emailwindow.hide()" /></p>
</form>
  </p>
  <p>&nbsp;</p>
</form>
<a href='lectureview.php'><< Back </a>