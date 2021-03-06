<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add Personnel</title>
     <link rel="icon" href="Picture1.jpg" type="image/jpg">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

<?php
	
	$con = mysqli_connect('127.0.0.1','root','');
	
	if (!$con){
		echo 'Not connected to server';
	}
	
	if (!mysqli_select_db($con,'lukedb')){
		echo 'Database not selected';
	}
	
	$staff_id = $_POST['staff_id'];
	$year = $_POST['year'];
	$remarks = htmlspecialchars($_POST['remarks']);
	$approved_by = $_POST['approved_by'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	
	$sql = "INSERT INTO attendance_record (staff_id,year,remarks,approved_by,start,end) VALUES ('$staff_id','$year','$remarks','$approved_by','$start','$end')";
	
	if (!mysqli_query($con,$sql)){
		echo 'not inserted';
	}else{
		echo '<div class="alert alert-success">
			<strong>Success!</strong> New entry successfully inserted into Attendance Record.
			</div>';
	}
	
	header("refresh:2;url=attendance.php");



?>