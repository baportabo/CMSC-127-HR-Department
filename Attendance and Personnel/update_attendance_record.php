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
	$staff_id=$_POST['staff_id'];
	$year = $_POST['year'];
	$remarks = htmlspecialchars($_POST['remarks']);
	$approved_by = $_POST['approved_by'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	
	$sick_leave_bal = $_POST['sick_leave_balance'];
	$undertime = $_POST['undertime'];
	$offset=$_POST['offset'];
	$vac_leave_bal = $_POST['vac_leave_balance']+$offset-$undertime;
	
	
	$bool=1;
	
	//error checking for start and end date
	if (strtotime($end)-strtotime($start)<=0){
		$bool=0;
	}else{
		
		$sql = "UPDATE attendance_record SET remarks='$remarks', approved_by='$approved_by', start='$start', end='$end' WHERE staff_id='$staff_id' && year='$year'";
	
		if (!mysqli_query($con,$sql)){
			echo 'not updated 1';
		}
	
		$sql = "UPDATE attendance_counter SET sick_leave_balance='$sick_leave_bal', vac_leave_balance='$vac_leave_bal', undertime='$undertime', offset='$offset' WHERE staff_id='$staff_id' && year='$year'";
	
		if (!mysqli_query($con,$sql)){
			echo 'not updated 2';
		}
	}
	
	if ($bool==1){
		echo '<div class="alert alert-success">
			<strong>Success!</strong> New entry successfully inserted into Attendance Record/Counter.
			</div>';
	}else{
		echo '<div class="alert alert-danger fade in">
				<strong>Whoops!</strong> Something went wrong. Check the start/end date.
				</div>';
	}
	
	
	
	header("refresh:2;url=attendance.php");
?>