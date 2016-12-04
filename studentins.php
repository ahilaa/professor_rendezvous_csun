<?php
include("validation.php");
include("conection.php");
$showformflag=true;

 $wordChunks = explode("-", $_POST[dob]);
for($i = 0; $i < count($wordChunks); $i++)
{
$name[$i] = $wordChunks[$i] ;
}
if(strlen($name[1]) == 1)
{
$name[1] = "0". $name[1];
}
//echo "sdsds".$_POST[md5];

$dbda = $name[2] . "-" . $name[0]. "-". $name[1];
if(isset($_POST[button]))
{
$pass_enc = md5($_POST[studpass]);
$courses = implode(',',$_POST['course']);

$tmp_course = explode(",",$courses);

$sql="INSERT INTO studentdetails (studid, studfname, studlname, password,email, dob, fathername, gender, address, contactno,courseid,semester)
VALUES
('$_POST[studid]','$_POST[studfname]','$_POST[studlname]','$pass_enc','$_POST[studemail]','$dbda','$_POST[fname]','$_POST[gender]','$_POST[address]','$_POST[contact]','','$_POST[semester]')";

if (mysqli_query($con,$sql))
 {
  for($i = 0; $i < count($tmp_course); $i++)
  {
    $sql1="INSERT INTO students_course_details (studid, courseid)
    VALUES
    ('$_POST[studid]', '$tmp_course[$i]')";


  if (!mysqli_query($con,$sql1) )
    {
    die('Error: ' . mysqli_error($con));
    }
    else
    {
        echo "Record inserted Successfully...";
        $showformflag = false;
    }
    }
   }
}


if(isset($_POST["button2"]))
{
$pass_enc = md5($_POST[studpass]);
mysqli_query($con,"UPDATE studentdetails SET studfname='$_POST[studfname]', studlname='$_POST[studlname]',password='$pass_enc' ,email='$_POST[studemail]', dob='$dbda', fathername='$_POST[fathername]', address='$_POST[address]', contactno='$_POST[contactno]', courseid='$_POST[courseid]', semester='$_POST[semester]' WHERE studid = '$_POST[studid]'");
echo "Record updated successfully...";
}


if($_GET["view"] == "studentdetails")
{
$result = mysqli_query($con,"SELECT * FROM studentdetails where studid='$_GET[slid]'");
 while($row1 = mysqli_fetch_array($result))
  {
	$totid = $row1["studid"];
	$studfname = $row1["studfname"];
	$studlname = $row1["studlname"];
	//$studpass = $row1["password"];
	$studemail = $row1["email"];
	$dob = $row1["dob"];
	$fathername = $row1["fathername"];
	$address = $row1["address"];
	$contactno = $row1["contactno"];
	$courseid  = $row1["courseid"];
	$semester  = $row1["semester"];
	$gender= $row1["gender"];
	}
}


$result1 = mysqli_query($con,"SELECT * FROM course");



?> 
<form name="form1" method="post" action="" id="formID">
<?php
if($showformflag){
?>

    <p>
      <label for="textfield">User Name</label>
      <input type="text" name="studid" id="textid" class="validate[required] text-input" value="<?php echo $totid; ?>">
    </p>
    <p>
      <label for="textfield2">First Name</label>
      <input type="text" name="studfname" id="textfname" class="validate[required,custom[onlyLetterSp]] text-input" value="<?php echo $studfname; ?>">
    </p>
    <p>
      <label for="textfield3">Last Name</label>
      <input type="text" name="studlname" id="textlname" class="validate[required,custom[onlyLetterSp]] text-input" value="<?php echo $studlname; ?>">
    </p>
    <p>
      <label for="textfield3">Password</label>
      <input type="password" name="studpass" id="textpass" class="validate[required] text-input" value="<?php echo $studpass; ?>">
    </p>
  <p>
    <label for="cpassword">Confirm Password</label>
    <input type="password" name="cpassword" id="cpassword" class="validate[required,equals[textpass]] text-input">
</p>
    <p>
      <label for="textfield3">Email</label>
      <input type="text" name="studemail" id="textemail" size="50" class="validate[required] text-input" value="<?php echo $studemail; ?>">
    </p>
    <p>
      <label for="textfield4">Date of Birth</label>
          <script src="datetimepicker_css.js"></script>
                <input type="Text" name="dob" id="textdob" maxlength="25" size="25" class="validate[required,[date]]  value="<?php echo $dob; ?>"/>
          <img src="images2/cal.gif" onclick="javascript:NewCssCal('textdob')" style="cursor:pointer"/>
    </p>
    <p>
      <label for="textfield5">Father's Name</label>
      <input type="text" name="fname" id="textfield5" class="validate[required,custom[onlyLetterSp]] text-input" value="<?php echo $fathername; ?>" >
    </p>
    <p>Gender

      <input type="radio" name="gender" id="radio" value="Male" <?php
    if($gender == "Male")
    {
        echo "checked";
    }
    ?> class="validate[required] radio" >
      <label for="radio">Male</label>
      <input type="radio" name="gender" id="radio2" value="Female"  <?php if($gender == "Female")
    {
        echo "checked";
    }?> class="validate[required] radio" >
      <label for="radio2">Female</label>
    </p>
    <p>
      <label for="textarea">Address</label>
      <textarea name="address" id="textarea" class="validate[required]"  cols="45" rows="5"><?php echo $address; ?></textarea>
    </p>
    <p>
      <label for="textfield6">Contact No. </label>
      <input type="text" name="contact" id="textfield6" class="validate[required,custom[phone]] value="<?php echo $contactno; ?>">
    </p>
    <p>
      <label for="textfield7">Course </label>
      <select multiple="multiple" name="course[]" value="<?php echo $courseid; ?>">
        <?php
        while($row1 = mysqli_fetch_array($result1))
    {
        if($courseid  == $row1[courseid])
        {
            $selvar = "selected";
        }
    echo "<option value='$row1[courseid]' ". $selvar . ">$row1[coursename]</option>";
    $selvar ="";
    }
    ?>
      </select>
    </p>
    <p>
      <label for="textfield8">Semester</label>
      <label for="select"></label>
      <select  name="semester" id="select" value="<?php echo $semester; ?>">
        <option value="1">First Semester</option>
        <option value="2">Second Semester</option>
        <option value="3">Third Semester</option>
        <option value="4">Fourth Semester</option>
        <option value="5">Fifth Semester</option>
        <option value="6">Sixth Semester</option>
      </select>
    </p>
    <p>
       <input type="submit" name="button" id="button" value="Submit">
       <!--<input type="submit" name="button2" id="button2" value="Update" />-->
       <!--<input type="submit" name="button2" id="button2" value="Update" />-->
      <input type="submit" name="button2" id="button2" value="Reset">
<?php
  }
?>
    <form id="myform">
    <input type="button" value="Close" name="B1" onClick="parent.emailwindow.hide()" /></p>
    </form>
  </p>
</form>
<p>&nbsp;</p>
<!--<a href='student.php'><< Back </a>-->