<?php
	
	$con = mysqli_connect('127.0.0.1','root','');
	
	if (!$con){
		echo 'Not connected to server';
	}
	
	if (!mysqli_select_db($con,'lukedb')){
		echo 'Database not selected';
	}
	
	
	$sql = "DELETE FROM organizer WHERE org_id ='$_GET[org_id]'";
	
	if (!mysqli_query($con,$sql)){
		echo 'Deletion Failed';
	}else{
		echo 'Successfully Deleted';
	}
	
	header("refresh:2;url=organizer.php");



?>