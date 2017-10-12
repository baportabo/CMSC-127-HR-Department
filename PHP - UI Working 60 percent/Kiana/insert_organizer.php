<?php
	
	$con = mysqli_connect('127.0.0.1','root','');
	
	if (!$con){
		echo 'Not connected to server';
	}
	
	if (!mysqli_select_db($con,'lukedb')){
		echo 'Database not selected';
	}
	
	
	$org_name = $_POST['org_name'];

	$rep_contact = $_POST['rep_contact'];
	$rep_name = $_POST['rep_name'];
	$rep_email = $_POST['rep_email'];
	$rep_address = $_POST['rep_address'];
	
	$sql = "INSERT INTO organizer (org_name,rep_contact,rep_name,rep_email,rep_address) VALUES ('$org_name','$rep_contact','$rep_name','$rep_email','$rep_address')";
	
	if (!mysqli_query($con,$sql)){
		echo 'not inserted';
	}else{
		echo 'Successfully Inserted';
	}
	
	header("refresh:2;url=organizer.php");



?>