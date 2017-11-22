<?php
	//$main="";
	
	
	$head = "defs/head.php";
	$foot = "defs/foot.php";
	$nav = "defs/nav.php";
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "lukedb";

	$con = mysqli_connect($servername, $username, $password,$database);
	if(!$con){die("<h1>System is down because it cannot connect to the database</h1>");}
	
	/*
		$sql = "SELECT * FROM user_accounts WHERE uname='".$uname."' AND pword='".$pword."'";
		$query=mysqli_query($con,$sql);
		
		if(mysqli_num_rows($query)>0){
			$_SESSION["uname"]=$uname;
			$_SESSION["pword"]=$pword;
			login_sucess($con);
		}
		
		INSERT INTO 'organizer' ('org_id', 'org_name', 'rep_contact', 'rep_name', 'rep_email', 'rep_address') 
		VALUES (NULL, 'Sagip mata Org', '09099730701', 'SMO', 'smo@gmail.com', 'Cab Hill, BC')
		
		INSERT INTO `organizer` (`org_id`, `org_name`, `rep_contact`, `rep_name`, `rep_email`, `rep_address`) 
		VALUES (NULL, 'Sagip ilong ORG', '09099730701', 'SIO', 'sio@gmail.com', 'Baguio City'), 
		(NULL, 'Sagip Ngipin Org', '09099730701', 'SNO', 'sno@gmail.com', 'Baguio City');
		
		INSERT INTO `organizer` (`org_id`, `org_name`, `rep_contact`, `rep_name`, `rep_email`, `rep_address`) 
		VALUES (NULL, 'Sagip g ORG', '09099730701', 'SIO', 'adda@gmial.com', 'Baguio City'), 
		(NULL, 'Sagip gg Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip gga Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip ggbb Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip ggc Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip ggd Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip gge Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip ggf Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip ggg Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City'),
		(NULL, 'Sagip ggghhe Org', '09099730701', 'SNO', 'qweqw@qwemail.com', 'Baguio City');
	
	*/
	
	if(!file_exists($head)||!file_exists($foot)||!file_exists($nav)){
		die("Error : the website is missing a essential parts/files, contact system administrator");
	}
?>