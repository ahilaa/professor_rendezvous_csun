<?php
session_start();
include("header.php");
include("conection.php");
include("modal.php");
	         if($_GET["lecid"]!=""){
             	$_SESSION["lecid"]=$_GET["lecid"];
             }
			 /*if($_GET["lemail"]!=""){
				$_SESSION["lec_email"]=$_GET["lemail"];
			  }*/
             //echo "----->".$_SESSION["lecid"];
             //echo "Student email".$_SESSION["stu_email"];
            //echo "Lecturer email".$_SESSION["lec_email"];echo "lec_email]". $_GET[lec_email];

?>

<meta charset='utf-8' />
<link href='fullcalendar/assets/css/fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='fullcalendar/assets/js/moment.min.js'></script>
<script src='fullcalendar/assets/js/jquery.min.js'></script>
<script src='fullcalendar/assets/js/jquery-ui.min.js'></script>
<script src='fullcalendar/assets/js/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {
		//$('.blink_me').fadeOut(200).fadeIn(200, blink);

                  //  alert(parag.className);

				//alert(document.getElementsByClassName("fc-month-button").classList.remove("fc-state-active"));
				$('.fc-month-button').removeClass('fc-state-active');
        		$('.fc-agendaWeek-button').addClass('fc-state-active');
		var zone = "05:30";  //Change this to your timezone

	$.ajax({
		url: 'fullcalendar/process.php',
        type: 'POST', // Send post data
        data: 'type=fetch',
        async: false,
        success: function(s){
        	json_events = s;
        }
	});


	var currentMousePos = {
	    x: -1,
	    y: -1
	};
		jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		$('#calendar').fullCalendar({
			events: JSON.parse(json_events),
			//events: [{"id":"14","title":"New Event","start":"2015-01-24T16:00:00+04:00","allDay":false}],
			utc: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			droppable: true,
			slotDuration: '00:30:00',
			eventReceive: function(event){
				var title = event.title;
				var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
				$.ajax({
		    		url: 'fullcalendar/process.php',
		    		data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
		    		type: 'POST',
		    		dataType: 'json',
		    		success: function(response){
		    			//event.id = response.eventid;
		    			$('#calendar').fullCalendar('updateEvent',event);
		    			location.reload();
		    		},
		    		error: function(e){
		    			console.log(e.responseText);

		    		}
		    	});
				$('#calendar').fullCalendar('updateEvent',event);
				console.log(event);

			},
			eventDrop: function(event, delta, revertFunc) {
		        var title = event.title;
		        var start = event.start.format();
		        var end = (event.end == null) ? start : event.end.format();
		        $.ajax({
					url: 'fullcalendar/process.php',
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')
						revertFunc();
					},
					error: function(e){
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
		    eventClick: function(event, jsEvent, view) {
		    	console.log(event.id);
		          var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
		          if (title){
		              event.title = title;
		              console.log('type=changetitle&title='+title+'&eventid='+event.id);
		              $.ajax({
				    		url: 'fullcalendar/process.php',
				    		data: 'type=changetitle&title='+title+'&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			if(response.status == 'success')
		              				$('#calendar').fullCalendar('updateEvent',event);
		              				location.reload();
				    		},
				    		error: function(e){
				    			alert('Error processing your request: '+e.responseText);
				    		}
				    	});
		          }
			},
			eventResize: function(event, delta, revertFunc) {
				console.log(event);
				var title = event.title;
				var end = event.end.format();
				var start = event.start.format();
		        $.ajax({
					url: 'fullcalendar/process.php',
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')
						revertFunc();
					},
					error: function(e){
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
			eventDragStop: function (event, jsEvent, ui, view) {
			    if (isElemOverDiv()) {
			    	var con = confirm('Are you sure to delete this event permanently?');
			    	if(con == true) {
						$.ajax({
				    		url: 'fullcalendar/process.php',
				    		data: 'type=remove&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			console.log(response);
				    			if(response.status == 'success'){
				    				$('#calendar').fullCalendar('removeEvents');
            						getFreshEvents();
            					}
				    		},
				    		error: function(e){
				    			alert('Error processing your request: '+e.responseText);
				    		}
			    		});
					}
				}
			}
		});

	function getFreshEvents(){
		$.ajax({
			url: 'fullcalendar/process.php',
	        type: 'POST', // Send post data
	        data: 'type=fetch',
	        async: false,
	        success: function(s){
	        	freshevents = s;
	        }
		});
		$('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
	}


	function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }

	});

</script>
<style>


	#trash{
		width:32px;
		height:32px;
		float:left;
		padding-bottom: 15px;
		position: relative;
	}


	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
	}

	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}

	#external-events .fc-event {
		margin: 10px 0;
		cursor: pointer;
	}

	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
	}

	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		float: left;
		width: 900px;
		padding-left:30px;
	}

</style>
</head>
<body>
<?
	if($_SESSION["type"]=="admin"){
	   $rescourse = mysqli_query($con,"SELECT *  FROM lectures");


	if(isset($_POST[submitresult]))
    {
      //echo $_POST[select];
     //$divert=$_POST[select];
     $_SESSION["lecid"]=$_POST[select];

      //header("Location: professorscheduler.php?lecid=$divert");
    }

?>
	  <form name="form2" method="post" action="schedulerview.php">

		<p>
		  <label for="select">Professor</label>
	   <?php
		  $rescourse = mysqli_query($con,"SELECT *  FROM lectures");

	  ?>
		  <select name="select" id="select">
	 <?php
		  while($row1 = mysqli_fetch_array($rescourse))
	  {

			echo "<option value='$row1[lecid]'>$row1[lecname]</option>";
	  }
	  ?>
			</select>
		  </p>
		<p>
		  <input type="submit" name="submitresult" id="submitresult" value="Submit">
		  <input type="hidden" id="lec_id" name="lec_id" value=<?php echo $_POST['select']; ?> >
		  </p>
	</form>

	<?

		}
	?>
	<div id='wrap'>

		<div id='external-events'>
			<h4>Draggable Events</h4>
			<div class='fc-event'>New Event</div>
			<?php
			if($_SESSION["type"]=="admin")
            	{
            ?>
					<p>
                       	<img src="/fullcalendar/assets/img/trashcan.png" id="trash" alt="">
                 	</p>
            <?php
                 }
            ?>
		</div>

		<div id='calendar'></div>

		<div style='clear:both'></div>

		<xspan class="tt">x</xspan>

	</div>
</body>
</html>

<?
include("footer.php"); ?>