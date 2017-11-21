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
	
	$sql1 = "INSERT INTO attendance_record (staff_id,year,remarks,approved_by,start,end) VALUES ('$staff_id','$year','$remarks','$approved_by','$start','$end')";
	$bool=1;
	
	//initialize values into attendance counter 
	$sql2 = "INSERT INTO attendance_counter (staff_id,year,sick_leave_balance,vac_leave_balance,vac_leave_ctr,sick_leave_ctr,undertime,offset,leave_start,leave_end) VALUES ('$staff_id','$year',15,15,0,0,0,0,'0000-00-00','0000-00-00')";
	
	$query = "SELECT year from attendance_record where staff_id = '$staff_id'";
	$result = mysqli_query($con,$query);
	
	while ($row = mysqli_fetch_array($result)){ //make sure duplicate year does not exist for this staff member
		if ($row['year']==$_POST['year']){
			$bool=0;
		}
	}
	
	if (strtotime($end)-strtotime($start)<0){
		$bool=0;
	}else if ($bool==1){
		
		if (!mysqli_query($con,$sql1)){
			$bool=0;
		}
		if (!mysqli_query($con,$sql2)){
			$bool=0;
		}
	}
	
	
	
	if ($bool==1){
		echo '<div class="alert alert-success">
			<strong>Success!</strong> New entry successfully inserted into Attendance Record.
			</div>';
	}else{
		
		echo '<div class="alert alert-danger fade in">
				<strong>Whoops!</strong> Something went wrong. Check the start/end date and ensure that a record for the same employee with the input year doesnt already exist.;
				</div>';
	}
	
	header("refresh:2;url=Attendance.php");
	
?>