<?php
include("conection.php");
$result1 = mysqli_query($con,"SELECT * FROM subject");
$result = mysqli_query($con,"SELECT * FROM course");
?>
<form id="form1" name="form1" method="post" action="examinsert.php">
  <p>
    <label for="course">Course</label>
    <label for="select"></label>
    <select name="course" >
      <option value="">Course Details</option>
      <?php
 while($row1 = mysqli_fetch_array($result))
  {
  echo "<option value='$row1[courseid]'>$row1[coursekey]</option>";
  }
  ?>
    </select>
  </p>
  <p>
    <label for="semester">Semester</label>
    <select name="semester" id="semester">
      <option value="1">First Semester</option>
      <option value="2">Second Semester</option>
      <option value="3">Third Semester</option>
      <option value="4">Fourth Semester</option>
      <option value="5">Fifth Semester</option>
      <option value="6">Sixth Semester</option>
    </select>
  </p>
  <p>
    <label for="textfield2">Internal type</label>
    <select name="internal" id="internal">
      <option value="1">First Internal</option>
      <option value="2">Second Internal</option>
    </select>
  </p>
  <p>Max marks
    <label for="textfield3"></label>
    <input type="text" name="marks" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="submit" name="button2" id="button2" value="Reset" />
  </p>
</form>
