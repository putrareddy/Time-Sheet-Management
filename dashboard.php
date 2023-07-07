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
                            <a class="nav-link active" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="password.php">Change Password</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a class="navbar-text nav-link" href="logout.php">Logout</a>
        </nav>
    </div>


    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">Student Details</div>
                    <div class="card-body">
                        <form>
                            <?php 
                                include 'database.php';
                                $query = "SELECT * FROM studata WHERE email='".$email1."'";
                                $result = mysqli_query($conn,$query);
                                while($details = mysqli_fetch_assoc($result))
                                {
                            ?>
                            <fieldset disabled="disabled">
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" type="text" value="<?php echo $details['names']; ?>">
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="regno">Registration Number</label>
                                        <input class="form-control" id="regno" type="text" value="<?php echo $details['regno']; ?>">
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="appno">Application Number</label>
                                        <input class="form-control" id="appno" type="text" value="<?php echo $details['appno']; ?>">
                                    </div>
                                </div>
                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="sem">Semester</label>
                                        <input class="form-control" id="sem" type="text" value="<?php echo $details['sem']; ?>">
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="cgpa">CGPA</label>
                                        <input class="form-control" id="cgpa" type="text" value="<?php echo $details['cgpa']; ?>">
                                    </div>
                                </div>
                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="rollno">Roll Number</label>
                                        <input class="form-control" id="rollno" type="text" value="<?php echo $details['rollno']; ?>">
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="sec">Section</label>
                                        <input class="form-control" id="sec" type="text" value="<?php echo $details['sec']; ?>">
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email address</label>
                                    <input class="form-control" id="email" type="email" value="<?php echo $details['email']; ?>">
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="tgnum">Teacher Guardian Mobile</label>
                                        <input class="form-control" id="tgnum" type="tel" value="<?php echo $details['tgnum']; ?>">
                                    </div>
                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="tgname">Teacher Guardian Name</label>
                                        <input class="form-control" id="tgname" type="text" value="<?php echo $details['tgname']; ?>">
                                    </div>
                                </div>
                            </fieldset>
                            <?php
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</body>

</html>