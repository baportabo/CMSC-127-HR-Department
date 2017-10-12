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
		echo 'Successfully Inserted';
	}
	
	header("refresh:2;url=attendance.php");



?>