<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Submit Leave</title>
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
	$type = $_POST['type'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$bool=1;
	
	if ($type == "maternity"){
		$query = "SELECT vac_leave_balance,sick_leave_balance,leave_end FROM attendance_counter where staff_id='$staff_id' && year = '$year'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$leave_end = $row['1'];
		
		
		$bool=check_date_validity(1,1,$start,$end,$leave_end);
		
		$sql = "UPDATE attendance_counter SET leave_type='$type', leave_start = '$start', leave_end = '$end' WHERE staff_id = '$staff_id' && year = '$year'";
	}else if ($type == "sick"){
		$query = "SELECT sick_leave_balance,leave_end FROM attendance_counter where staff_id='$staff_id' && year = '$year'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$sick_leave_balance = $row['sick_leave_balance'];
		$leave_end = $row['1'];
		
	
		
		$sick_leave_ctr = strtotime($end) - strtotime($start);
		$sick_leave_ctr = floor($sick_leave_ctr / (60 * 60 * 24));
		$sick_leave_balance = $sick_leave_balance - $sick_leave_ctr;
		
		$bool=check_date_validity($sick_leave_balance,1,$start,$end,$leave_end);
	
		
		$sql = "UPDATE attendance_counter SET leave_type='$type',sick_leave_balance='$sick_leave_balance', sick_leave_ctr='$sick_leave_ctr', leave_start = '$start', leave_end = '$end' WHERE staff_id = '$staff_id' && year = '$year'";
		
		
	}else if ($type == "vacation"){
		$query = "SELECT vac_leave_balance,leave_end FROM attendance_counter where staff_id='$staff_id' && year = '$year'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$vac_leave_balance = $row['vac_leave_balance'];
		$leave_end = $row['1'];
		
		$vac_leave_ctr = strtotime($end) - strtotime($start);
		$vac_leave_ctr = floor($vac_leave_ctr / (60 * 60 * 24));
		$vac_leave_balance = $vac_leave_balance - $vac_leave_ctr;
		
		$bool=check_date_validity(1,$vac_leave_balance,$start,$end,$leave_end);
		
		$sql = "UPDATE attendance_counter SET leave_type='$type',vac_leave_balance='$vac_leave_balance',vac_leave_ctr='$vac_leave_ctr', leave_start = '$start', leave_end = '$end' WHERE staff_id = '$staff_id' && year = '$year'";
	}//end if
	
	if ($bool==1){
		if (!mysqli_query($con,$sql)){
			echo 'Leave not submitted';
		}else{
			echo '<div class="alert alert-success">
				<strong>Success!</strong> Leave form successfully submitted.
				</div>';
		}//end if
	}
	
	header("refresh:5;url=Currently_On_Leave.php"); 
	
	function check_date_validity($sick_leave_bal,$vac_leave_bal,$startdate,$enddate,$leave_end2){
		
		$today = date("Y/m/d");
		
		if ($vac_leave_bal < 0){
			echo '<div class="alert alert-danger fade in">
				<strong>Whoops!</strong> It looks like this person has exceeded the maximum allowable vacation leave days or the dates you have entered deduct to a value that exceeds the maximum allowable vacation days.
				</div>';
			return 0;
		}else if ($sick_leave_bal <0){
			echo '<div class="alert alert-danger fade in">
				<strong>Whoops!</strong> It looks like this person has exceeded the maximum allowable sick leave days or the dates you have entered deduct to a value that exceeds the maximum allowable sick days.
				</div>';
			return 0;
		}else if ((strtotime($startdate)-strtotime($leave_end2) < 0) || (strtotime($enddate)-strtotime($startdate) < 0) || (strtotime($enddate)-strtotime($leave_end2) < 0) ){
			
			echo "startdate: ".$startdate."<br>";
			echo "enddate: ".$enddate."<br>";
			echo "leave_end2: ".$leave_end2."<br>";
			echo "startdate - leave_end2: ".strtotime($startdate)-strtotime($leave_end2)."<br>" ;
			echo "enddate - startdate: ".strtotime($enddate)-strtotime($startdate)."<br>" ;
			echo "enddate - leave_end2: ".strtotime($enddate)-strtotime($leave_end2)."<br>" ;
			
			echo '<div class="alert alert-danger fade in">
				<strong>Whoops!</strong> Invalid start/end date. Possible reasons may be: the end date precedes the start date or the start date and end date falls within the range of the last leave this person took.
				</div>';
			return 0;
		}
		return 1;
	}//end function
?>