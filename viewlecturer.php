<?php
session_start();
//Override default zone
date_default_timezone_set('Etc/UTC');
include("header.php");
include("conection.php"); ?>
<section id="page">

<section id="contents">


<article class="post">
  <header class="postheader">
    <h2>Pull Calendar Feed by Professor</h2>
  </header>
  <form name="form2" method="post" action="">

    <p>
      <label for="select">Professor</label>
   <?php
      $rescourse = mysqli_query($con,"SELECT *  FROM lectures");

  ?>
      <select name="select" id="select" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
        <option value="">Select Lecturer</option>
      <?php
      while($row1 = mysqli_fetch_array($rescourse))
  {
echo "<option value='$row1[cal_feed_url]'>$row1[lecid]</option>";
  }
  ?>
        </select>
      </p>
    <p>
      <input type="hidden" name="selected_text" id="selected_text" value="" />
      <input type="submit" name="submitresult" id="submitresult" value="Submit">
      </p>
</form>
<?php
if(isset($_POST[submitresult]))
{

        $calendar_feed=$_POST[select];

        $current_time = date("Y-m-d\TH:i:sP", time());

        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_PROXY, '10.40.32.20');
        //curl_setopt($ch, CURLOPT_PROXYPORT, '80');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_URL,$calendar_feed);

        $feedContent = curl_exec($ch);
        curl_close($ch);
        $jsonOutput = json_decode($feedContent,true);

         $feedOuput = $jsonOutput['items'];
         //echo "<br>";
         //echo "<br>";
         //echo "Count Items:". count($feedOuput);
         //echo "<br>";
         $i=0;
         echo deleteLecSchedule($_POST[selected_text],$con);
         foreach($feedOuput as $items)
         {
                 $date_only=false;
                 $eventID = $items['id'];
                 $eventTitle = $items['summary'];
                 $startTime = $items['start']['dateTime'];

                 //echo "currtime".$current_time;
                 //echo  "starttime".$startTime;

                $startdateTime = strtotime($startTime);
                $currentDateTime = strtotime($current_time);

                if($startdateTime >= $currentDateTime){

                     if(!isset($startTime)){
                             $startTime = $items['start']['date'];
                     }
                     $endTime = $items['end']['dateTime'];
                     if(!isset($endTime)){
                             $date_only=true;
                             $endTime = $items['end']['date'];
                     }

                     $eventContent = $items['description'];
                     //$where = $items['location'];
                     $eventPublished = $items['created'];
                     $eventUpdated = $items['updated'];
                     $event_status = trim($items['status']);

                     if($date_only){
                             //$startTime = date("Y-m-d 00:00:00",$startTime);
                             //$endTime = date("Y-m-d 00:00:00",$endTime-1);
                     }
                     $startTime = googleDateFormat($startTime);
                     $endTime = googleDateFormat($endTime);
                     $createdEvent = strtotime(googleDateFormat($eventPublished));
                     $updatedEvent = strtotime(googleDateFormat($eventUpdated));
                     //echo $eventID."<br>";
                     echo $eventTitle."<br>";
                     echo $startTime."<br>";
                     echo $endTime."<br>";
                     echo $eventContent."<br>";
                     echo insertLecSchedule ($eventTitle, $startTime, $endTime, "",$con);
                     $i++;
                  }

                }
                if($i<=0){?>

                     <h2>No Records Available</h2>
              <? }
?>
  </table>
  <?php
}

    function googleDateFormat($strDate)
        {
        // $stDate = date('Y-m-d\TH:i:sP', strtotime($strDate));
        $date = new DateTime($strDate);
        return $date->format('Y-m-d\TH:i:sP');
            //return $stDate;
        }

     function insertLecSchedule($title, $startdate, $enddate, $lecid,$con){
     	$insert = mysqli_query($con,"INSERT INTO calendar(`title`, `startdate`, `enddate`,`lecid`, `allDay`, `status`, `lec_entry`) VALUES('$title','$startdate','$enddate','$_POST[selected_text]','false','master','true')");
     	echo "insert".$insert;
     	$lastid = mysqli_insert_id($con);

     	echo json_encode(array('status'=>'success','eventid'=>$lastid,'lecid'=>$_POST[selected_text]));
     }

     function deleteLecSchedule($lecid,$con){

	    $delete = mysqli_query($con,"DELETE FROM calendar where lecid='$lecid' and lec_entry='true' ");
        echo json_encode(array('status'=>'success'));
     }
?>
  </form>
  <p>&nbsp;</p>
</form>
</article>

</section>
<section id="sidebar">
</section>
<section id="sidebar">
  <h2>&nbsp;</h2>
<ul>
	<li></li>

</ul>
<h2>&nbsp;</h2>
<ul>
	<li></li>

</ul>
</section>
<div class="clear"></div>

<div class="clear"></div>
</section>
</div>
<?php include("footer.php"); ?>
