<?php

include 'database.php';
session_start();
error_reporting(0);

if($_POST['action'] == 'login_form')
{
	$email1 = $_POST['email'];
	$password1 = $_POST['password'];
	$_SESSION["login"] = $email1;
	$encrypt = md5($password1);
	if(!empty($email1) && !empty($encrypt))
	{
		$query1 = "SELECT * FROM credentials WHERE email='".$email1."' AND password='".$encrypt."'";
		$result1 = mysqli_query($conn,$query1);
		$count = mysqli_fetch_assoc($result1);
		if(mysqli_num_rows($result1)>0)
		{
			if($count['email']=='admin')
			{
				$msg1 = "admin";
			}
			else
			{
				$msg1 = "student";
			}
		}
		else
		{
			$msg1 = "Check Your Details";
		}
	}
	echo json_encode($msg1);
}

if($_POST['action'] == 'update_password')
{
	$old = $_POST['old'];
	$newpassword = $_POST['newpassword'];
	$encryptold = md5($old);
	$encryptnew = md5($newpassword);
	if(!empty($encryptold) && !empty($encryptnew))
	{
		$result = mysqli_query($conn, "SELECT * from studata WHERE email='" . $_SESSION["login"] . "'");
    	$row = mysqli_fetch_array($result);
    	if ($encryptold == $row["password"]) {
        	mysqli_query($conn, "UPDATE studata set password='" . $encryptnew . "' WHERE email='" . $_SESSION["login"] . "'");
			mysqli_query($conn, "UPDATE credentials set password='" . $encryptnew . "' WHERE email='" . $_SESSION["login"] . "'");
        	$message = "success";
    	}
		else {
        	$message = "failure";
		}
	}
	echo json_encode($message);
}

if($_POST['action'] == 'add_form')
{
	$name = $_POST['name'];
	$regno = $_POST['regno'];
    $appno = $_POST['appno'];
	$sem = $_POST['sem'];
    $cgpa = $_POST['cgpa'];
	$rollno = $_POST['rollno'];
    $sec = $_POST['sec'];
	$email = $_POST['email'];
    $tgnum = $_POST['tgnum'];
	$tgname = $_POST['tgname'];
	$encryptpass = md5($regno);
	if ($encryptpass) {
    	mysqli_query($conn, "INSERT INTO studata (names,regno,appno,sem,cgpa,rollno,sec,email,tgnum,tgname,password) VALUES ('$name','$regno','$appno','$sem','$cgpa','$rollno','$sec','$email','$tgnum','$tgname','$encryptpass')");
		mysqli_query($conn, "INSERT INTO credentials (email,password) VALUES ('$email','$encryptpass')");
       	$message = "success";
    }
	else {
       	$message = "failure";
	}
	echo json_encode($message);
}

if($_POST['action'] == 'details')
{
	$regno = $_POST['regno'];
	if(!empty($regno)){
		$row = mysqli_query($conn, "SELECT * from studata WHERE regno='" . $regno . "'");
    	$result = mysqli_fetch_array($row);
		$a = [];
		$a[] = $result['id'];
		$a[] = $result['names'];
		$a[] = $result['regno'];
    	$a[] = $result['appno'];
		$a[] = $result['sem'];
    	$a[] = $result['cgpa'];
		$a[] = $result['rollno'];
    	$a[] = $result['sec'];
		$a[] = $result['email'];
    	$a[] = $result['tgnum'];
		$a[] = $result['tgname'];
		echo json_encode($a);
	}
}

if($_POST['action'] == 'updatedetails')
{
	$id = $_POST['id'];
	$name = $_POST['name'];
	$regno = $_POST['regno'];
    $appno = $_POST['appno'];
	$sem = $_POST['sem'];
    $cgpa = $_POST['cgpa'];
	$rollno = $_POST['rollno'];
    $sec = $_POST['sec'];
	$email = $_POST['email'];
    $tgnum = $_POST['tgnum'];
	$tgname = $_POST['tgname'];
	$encryptpass = md5($regno);
	if ($encryptpass) {
    	mysqli_query($conn, "UPDATE studata SET names='" . $name . "',regno='" . $regno . "',appno='" . $appno . "',sem='" . $sem . "',cgpa='" . $cgpa . "',rollno='" . $rollno . "',sec='" . $sec . "',email='" . $email . "',tgnum='" . $tgnum . "',tgname='" . $tgname . "',password='" . $encryptpass . "' WHERE id='" . $id . "'");
		mysqli_query($conn, "UPDATE credentials SET email='" . $email . "',password='" . $encryptpass . "' WHERE id='" . $id . "'");
       	$message = "success";
    }
	else {
       	$message = "failure";
	}
	echo json_encode($message);
}

if($_GET['action']=='student_event')
{
	$sql = "SELECT subjects.sub as title,events.start,events.end FROM events join subjects on events.sub_id=subjects.sub_id where resourceId=(select sections.id from sections where sections.title=(select sec from studata where email='".$_SESSION["login"]."'))";
	$result = mysqli_query($conn,$sql); 
	$myArray = array();
	if ($result->num_rows > 0) {
	// output data of each row
    	while($row = $result->fetch_assoc()) {
        	$myArray[] = $row;
    	}
	} 
	else 
	{
    	echo "0 results";
	}
	echo json_encode($myArray);
}

if($_GET['action']=='admin_resource')
{
	$sql = "SELECT sections.id,sections.title FROM sections";
	$result = mysqli_query($conn,$sql); 
	$myArray = array();
	if ($result->num_rows > 0) {
	// output data of each row
    	while($row = $result->fetch_assoc()) {
        	$myArray[] = $row;
    	}
	} 
	else 
	{
    	echo "0 results";
	}
	echo json_encode($myArray);
}

if($_GET['action']=='admin_events')
{
	$sql = "SELECT events.id,events.resourceId,events.start,events.end,sections.title as sec,subjects.sub as title FROM events join sections on events.resourceId=sections.id join subjects on events.sub_id= subjects.sub_id;";
	$result = mysqli_query($conn,$sql); 
	$myArray = array();
	if ($result->num_rows > 0) {
	// output data of each row
    	while($row = $result->fetch_assoc()) {
        	$myArray[] = $row;
    	}
	} 
	else 
	{
    	echo "0 results";
	}
	echo json_encode($myArray);
}

if($_POST['action'] == 'add_event')
{
	$starttime = $_POST['starttime'];
	$resourceid = $_POST['resourceid'];
    $eventid = $_POST['eventid'];
	$endtime = $_POST['endtime'];
	if ($endtime) {
    	mysqli_query($conn, "INSERT INTO events (resourceId,start,end,sub_id) VALUES ('$resourceid','$starttime','$endtime','$eventid');");
       	$message = "success";
    }
	else {
       	$message = "failure";
	}
	echo json_encode($message);
}
?>