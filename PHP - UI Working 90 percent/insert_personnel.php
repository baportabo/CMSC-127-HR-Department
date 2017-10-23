<?php
	
	$con = mysqli_connect('127.0.0.1','root','');
	
	if (!$con){
		echo 'Not connected to server';
	}
	
	if (!mysqli_select_db($con,'lukedb')){
		echo 'Database not selected';
	}
	
	
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$address = $_POST['address'];
	$contact_number = $_POST['contact_number'];
	$email_address = $_POST['email_address'];
	
	
	$sql = "INSERT INTO staff (last_name,first_name,middle_name,address,contact_number,email_address) VALUES ('$last_name','$first_name','$middle_name','$address','$contact_number','$email_address')";
	
	if (!mysqli_query($con,$sql)){
		echo 'not inserted';
	}else{
		echo 'Successfully Inserted';
	}
	
	header("refresh:2;url=personnel.php");



?>