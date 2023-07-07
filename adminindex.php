<?php
include('database.php');
session_start();
error_reporting(0);
$email1 = $_SESSION['login'];
if($email1!='admin')
{
	header("location:login.php");
	exit;
}
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled CSS -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.css">
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
        <title>Scheduled Tasks</title>
        <link rel="icon" href="https://www.freeiconspng.com/uploads/schedule-icon-8.png" type="image/x-icon">
        <link href='login.css' rel='stylesheet' />
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var Draggable = FullCalendar.Draggable;

                var containerEl = document.getElementById('external-events');
                var checkbox = document.getElementById('drop-remove');

                new Draggable(containerEl, {
                    itemSelector: '.fc-event',
                    eventData: function(eventEl) {

                    console.log(eventEl.id);
                        return {
                            title: eventEl.innerText,
                            duration: '01:30',
                            id:eventEl.id
                        };
                    }
                });

                function unixTime(unixtime) {
                    var u = new Date(unixtime);
                    var m = u.getMonth()+1;
                    return u.getUTCFullYear() +
                        '-' + ('0' + m).slice(-2) +
                        '-' + ('0' + u.getDate()).slice(-2) + 
                        ' ' + ('0' + u.getHours()).slice(-2) +
                        ':' + ('0' + u.getMinutes()).slice(-2) +
                        ':' + ('0' + u.getSeconds()).slice(-2)
                    };

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    themeSystem: 'bootstrap5',
                    initialView: 'resourceTimelineDay',
                    aspectRatio: 1.5,
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
                    },
                    editable: true,
                    resourceAreaHeaderContent: 'Rooms',
                    droppable: true, // this allows things to be dropped onto the calendar
                    resources: 'ajax_calls.php?action=admin_resource',
                    events: 'ajax_calls.php?action=admin_events',
                    
                    drop: function(info) {
                       // console.log(events);
                        console.log(info.date);
                        console.log(unixTime(info.date.getTime()));
                        console.log(info.resource.id);
                        console.log(info.draggedEl.id);
                        var start_time=unixTime(info.date.getTime());
                        var end_time=unixTime(info.date.getTime() +  1.5 * 60 * 60 * 1000);
                        console.log(end_time);
                        $.ajax({
						type: "POST",
						url: "ajax_calls.php",
						data:{
							'action':'add_event','starttime':start_time,'endtime':end_time,'resourceid':info.resource.id,'eventid':info.draggedEl.id
						},
						dataType: "json",
						success: function(response)
						{
							if(response=="success")
							{
                                alert('Event added successfully!!');
								//window.location.replace("adminindex.php");
							}
							else if(response=="failure")
							{
                                alert('Event addition failed!!');
								window.location.replace("adminindex.php");
							}
							else
							{
								alert(response);
							}
						}
					});
                    }
                });

                calendar.render();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
			$('#add').on('click',function(){
				var name = $('#name').val();
				var regno = $('#regno').val();
                var appno = $('#appno').val();
				var sem = $('#sem').val();
                var cgpa = $('#cgpa').val();
				var rollno = $('#rollno').val();
                var sec = $('#sec').val();
				var email = $('#email').val();
                var tgnum = $('#tgnum').val();
				var tgname = $('#tgname').val();
					$.ajax({
						type: "POST",
						url: "ajax_calls.php",
						data:{
							'action':'add_form','email':email,'name':name,'regno':regno,'appno':appno,'sem':sem,'cgpa':cgpa,'rollno':rollno,'sec':sec,'tgnum':tgnum,'tgname':tgname
						},
						dataType: "json",
						success: function(response)
						{
							if(response=="success")
							{
                                alert('Student added successfully!!');
								window.location.replace("adminindex.php");
							}
							else if(response=="failure")
							{
                                alert('Student addition failed!!');
								window.location.replace("adminindex.php");
							}
							else
							{
								alert(response);
							}
						}
					});
			});
		});
        </script>
        <script type="text/javascript">
            var id;
            $(document).ready(function(){
			    $('#details').on('click',function(){
                    var regno1 = $('#regno1').val();
                    $.ajax({
						type: "POST",
						url: "ajax_calls.php",
						data:{
							'action':'details','regno':regno1
						},
						dataType: "json",
						success: function(response)
						{
							if(response[0]!=null)
							{
                                document.getElementById('form3').style.display = 'block';
                                id = response[0];
                                $('#name2').val(response[1]);
				                $('#regno2').val(response[2]);
                                $('#appno2').val(response[3]);
				                $('#sem2').val(response[4]);
                                $('#cgpa2').val(response[5]);
				                $('#rollno2').val(response[6]);
                                $('#sec2').val(response[7]);
				                $('#email2').val(response[8]);
                                $('#tgnum2').val(response[9]);
				                $('#tgname2').val(response[10]);
							}
							else
							{
								alert('Enter correct details');
							}
						}
					});
                });
            });
        
            $(document).ready(function(){
			$('#updatedetails').on('click',function(){
				var name = $('#name2').val();
				var regno = $('#regno2').val();
                var appno = $('#appno2').val();
				var sem = $('#sem2').val();
                var cgpa = $('#cgpa2').val();
				var rollno = $('#rollno2').val();
                var sec = $('#sec2').val();
				var email = $('#email2').val();
                var tgnum = $('#tgnum2').val();
				var tgname = $('#tgname2').val();
					$.ajax({
						type: "POST",
						url: "ajax_calls.php",
						data:{
							'action':'updatedetails','id':id,'email':email,'name':name,'regno':regno,'appno':appno,'sem':sem,'cgpa':cgpa,'rollno':rollno,'sec':sec,'tgnum':tgnum,'tgname':tgname
						},
						dataType: "json",
						success: function(response)
						{
							if(response=="success")
							{
                                alert('Updated successfully!!');
								window.location.replace("adminindex.php");
							}
							else
							{
                                alert('Update failed!!');
								window.location.replace("adminindex.php");
							}
						}
					});
			});
		});
        </script>

    </head>

    <body>
        <div style="margin-bottom: .5em;" class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="https://www.freeiconspng.com/uploads/schedule-icon-8.png" width="30" height="30" class="d-inline-block align-top"> <strong>Scheduled Events</strong>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="adminindex.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="addstudent" type="button" onclick="document.getElementById('form1').style.display = 'block'; document.getElementById('form2').style.display = 'none'; document.getElementById('form3').style.display = 'none'; document.getElementById('main').style.display = 'none'">Add Student</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="update" type="button" onclick="document.getElementById('form2').style.display = 'block'; document.getElementById('form1').style.display = 'none'; document.getElementById('form3').style.display = 'none'; document.getElementById('main').style.display = 'none'">Update Student Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a class="navbar-text nav-link" href="logout.php">Logout</a>
            </nav>
        </div>

        <div class="container" style="margin-top: 1.5em;" id="main">
            <div class="row">
                <div class="col-4">
                    <div id='external-events'>
                        <p>
                            <strong>Subjects</strong>
                        </p>
                        <?php
                            $sql = "SELECT * FROM subjects";
                            $result = mysqli_query($conn,$sql); 
                            while($row = $result->fetch_assoc()) 
                            {
                        ?>
                        <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event' id="<?php echo ($row['sub_id'])?>">
                            <div class='fc-event-main'><?php echo ($row['sub'])?></div>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="col-8">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>


        <div class="container">
            <form id="form1" style="display: none;" method="POST">
                <div class="container-xl px-4 mt-4">
                    <div class="row">
                        <div class="container">
                            <div class="card mb-4">
                                <div class="card-header">Student Details</div>
                                <div class="card-body">
                                    <form>
                                        <fieldset>
                                            <!-- Form Group (username)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="name">Name</label>
                                                <input class="form-control" id="name" type="text" value="" required="">
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (first name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="regno">Registration Number</label>
                                                    <input class="form-control" id="regno" type="text" value="" required="">
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="appno">Application Number</label>
                                                    <input class="form-control" id="appno" type="text" value="" required="">
                                                </div>
                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (organization name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="sem">Semester</label>
                                                    <input class="form-control" id="sem" type="text" value="" required="">
                                                </div>
                                                <!-- Form Group (location)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="cgpa">CGPA</label>
                                                    <input class="form-control" id="cgpa" type="text" value="" required="">
                                                </div>
                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (organization name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="rollno">Roll Number</label>
                                                    <input class="form-control" id="rollno" type="text" value="" required="">
                                                </div>
                                                <!-- Form Group (location)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="sec">Section</label>
                                                    <input class="form-control" id="sec" type="text" value="" required="">
                                                </div>
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="email">Email address</label>
                                                <input class="form-control" id="email" type="email" value="" required="">
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (phone number)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="tgnum">Teacher Guardian Mobile</label>
                                                    <input class="form-control" id="tgnum" type="tel" value="" required="">
                                                </div>
                                                <!-- Form Group (birthday)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="tgname">Teacher Guardian Name</label>
                                                    <input class="form-control" id="tgname" type="text" value="" required="">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" id="add">Add Student</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="container">
            <form id="form2" style="display: none;">
                <div class="container-xl px-4 mt-4">
                    <div class="row">
                        <div class="container">
                            <div class="card mb-4 col-md-6 mx-auto">
                                <div class="card-header">Enter Student Registration Number</div>
                                <div class="card-body">
                                    <form method="">
                                        <fieldset>
                                            <!-- Form Row-->
                                            <div class="row gx-3">
                                                <!-- Form Group (first name)-->
                                                <div>
                                                    <label class="small mb-1" for="regno">Registration Number</label>
                                                    <input class="form-control" id="regno1" name="regno" type="text" value="" required="">
                                                </div>
                                            </div>
                                            <button id="details" name="details" style="margin-top: 1.5em;" class="btn btn-primary" type="button" onclick="document.getElementById('form1').style.display = 'none'; document.getElementById('form2').style.display = 'block'; document.getElementById('main').style.display = 'none'">Get Details</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <div class="container">
            <form id="form3" style="display: none;">
                <div class="container-xl px-4 mt-4">
                    <div class="row">
                        <div class="container">
                            <div class="card mb-4">
                                <div class="card-header">Student Details</div>
                                <div class="card-body">
                                    <form>
                                        <fieldset>
                                            <!-- Form Group (username)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="name2">Name</label>
                                                <input class="form-control" id="name2" type="text" value="">
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (first name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="regno2">Registration Number</label>
                                                    <input class="form-control" id="regno2" type="text" value="">
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="appno2">Application Number</label>
                                                    <input class="form-control" id="appno2" type="text" value="">
                                                </div>
                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (organization name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="sem2">Semester</label>
                                                    <input class="form-control" id="sem2" type="text" value="">
                                                </div>
                                                <!-- Form Group (location)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="cgpa2">CGPA</label>
                                                    <input class="form-control" id="cgpa2" type="text" value="">
                                                </div>
                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (organization name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="rollno2">Roll Number</label>
                                                    <input class="form-control" id="rollno2" type="text" value="">
                                                </div>
                                                <!-- Form Group (location)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="sec2">Section</label>
                                                    <input class="form-control" id="sec2" type="text" value="">
                                                </div>
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="email2">Email address</label>
                                                <input class="form-control" id="email2" type="email" value="">
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (phone number)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="tgnum2">Teacher Guardian Mobile</label>
                                                    <input class="form-control" id="tgnum2" type="tel" value="">
                                                </div>
                                                <!-- Form Group (birthday)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="tgname2">Teacher Guardian Name</label>
                                                    <input class="form-control" id="tgname2" type="text" value="">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <button style="margin-bottom: 1.5em;" class="btn btn-primary" type="button" id="updatedetails">Update Student</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/locales-all.min.js"></script>
        
    </body>

    </html>