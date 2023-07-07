<?php
include('database.php');
session_start();
error_reporting(0);
$email1 = $_SESSION['login'];
if(!isset($_SESSION['login']))
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Latest compiled CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <title>Scheduled Tasks</title>
    <link rel="icon" href="https://www.freeiconspng.com/uploads/schedule-icon-8.png" type="image/x-icon">
    <link href='login.css' rel='stylesheet' />
</head>

<body>

    <div style="margin-bottom: .5em;" class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="https://www.freeiconspng.com/uploads/schedule-icon-8.png" width="30" height="30" class="d-inline-block align-top" alt=""> <strong>Scheduled Events</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="password.php">Change Password</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a class="navbar-text nav-link" href="logout.php">Logout</a>
        </nav>
    </div>

    <div class="col-md-6 offset-md-3 mt-4">
        <span class="anchor" id="formChangePassword"></span>

        <!-- form card change password -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0">Change Password</h3>
            </div>
            <div class="card-body">
                <form class="form" role="form" autocomplete="off" method="POST">
                    <div class="form-group">
                        <label for="oldpassword">Current Password</label>
                        <input type="password" class="form-control" id="oldpassword" required="">
                    </div>
                    <div class="form-group">
                        <label for="newpassword">New Password</label>
                        <input type="password" class="form-control" id="newpassword" required="">
                        <span class="form-text small text-muted">
                                The password must be 8-20 characters, and must <em>not</em> contain spaces.
                            </span>
                    </div>
                    <div class="form-group">
                        <label for="newpasswordverify">Verify New Password</label>
                        <input type="password" class="form-control" id="newpasswordverify" required="">
                        <span class="form-text small text-muted">
                                To confirm, type the new password again.
                            </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right" id="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
		$(document).ready(function(){
			$('#save').on('click',function(){
				var old = $('#oldpassword').val();
				var newpassword = $('#newpassword').val();
				if(!$('#oldpassword').val())
				{
					alert('Enter your Current Password!');
				}
				else if(!$('#newpassword').val())
				{
					alert("Enter New Password");
				}
                else if($('#newpassword').val()!=$('#newpasswordverify').val())
				{
					alert("New Passwords Mismatch");
				}
				else
				{
					$.ajax({
						type: "POST",
						url: "ajax_calls.php",
						data:{
							'action':'update_password','old':old,'newpassword':newpassword
						},
						dataType: "json",
						success: function(response)
						{
							if(response=="success")
							{
								window.location.replace("logout.php");
							}
							else if(response=="failure")
							{
                                alert("Enter Correct Password");
								//window.location.replace("index.php");
							}
							else
							{
								alert(response);
							}
						}
					});
				}
			});
		});
	</script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</body>

</html>