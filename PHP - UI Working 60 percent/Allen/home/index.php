<?php
if(!file_exists("core/function.php")){die("<h1>System is down for a moment due to a loss of function</h1>");}
else{require("core/function.php");}

$dir="includes/autologin.txt";

$login = '
		<h1>Login</h1>
		<input type="text" value="" placeholder="Username" id="username" />
		<input type="password" value="" placeholder="Password" id="password" />
		<input id="login" type="submit" value="Login" />
		
';
			
$nav1 = '
		<nav class="menu">
		  <ul>
			<li><a href="#">Organizer</a></li>
			<li><a href="#">Activities</a></li>
			<li><a href="#">Personnel</a></li>
			<li><a href="#">Attendance</a></li>
		  </ul>
		</nav>
';

$nav2 = '
		<h1 style="font-size:30px;cursor:pointer;text-shadow:1px 1px black;" >Welcome : '.$_SESSION["uname"].'</h1>
		<img src="images/lukes_logo.png" style="width:100%;height:250px;" />
		<nav class="menu">
		  <ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="index.php?loc=org">Organizer</a></li>
			<li><a href="index.php?loc=act">Activities</a></li>
			<li><a href="index.php?loc=staff">Personnel</a></li>
			<li><a href="index.php?loc=attendance">Attendance</a></li>
		  </ul>
		</nav>
';
if(!file_exists($dir)){//not autologin
	if(!isset($_SESSION["uname"])&&!isset($_SESSION["pword"])){

		$dir = "includes/home_top.html";
		$dir2 = "includes/home_bottom.html";
		if(file_exists($dir)&&file_exists($dir2)){
			include($dir);
			echo $login;
			echo $nav1;
			include($dir2);
		}
		else{die("<h1>System is down for a moment due to a loss of login page</h1>");}
	}else{
		//THIS IS THE AREA WHERE THINGS SHOULD DISPLAY WHEN TRYING TO LOGIN
	}
}else{//autologin
	//loadup credentials
	$_SESSION["uname"]='admin';
	$_SESSION["pword"]='admin';
	
	$dir = "includes/home_top.html";
	$dir2 = "includes/home_bottom.html";
	if(file_exists($dir)&&file_exists($dir2)){
	
		if(!isset($_GET["loc"])||$_GET["loc"]==="home"){
			include($dir);
			echo $nav2;
			include($dir2);
		}else{
			$loc = $_GET["loc"];
			$dir = "includes/";
			if(file_exists($dir."norm_top.php")&&file_exists($dir."organization.php")&&file_exists($dir."activity.php")&&file_exists($dir."norm_top.php")&&file_exists($dir."attendance.php")){
				include($dir."norm_top.php");
				
				if($loc==="org"){include($dir."organization.php");}
				elseif($loc==="act"){include($dir."activity.php");}
				elseif($loc==="staff"){include($dir."personell.php");}
				elseif($loc==="staff_records"){
				//ln mn fn addr cn em st
					if(isset($_POST["fn"])&&isset($_POST["mn"])&&isset($_POST["ln"])&&isset($_POST["st"])){
						$fn=filter_var($_POST["fn"],FILTER_SANITIZE_SPECIAL_CHARS);
						$mn=filter_var($_POST["mn"],FILTER_SANITIZE_SPECIAL_CHARS);
						$ln=filter_var($_POST["ln"],FILTER_SANITIZE_SPECIAL_CHARS);
						$st=filter_var($_POST["st"],FILTER_SANITIZE_SPECIAL_CHARS);
						$addr="N/A";if(isset($_POST["addr"])){filter_var($_POST["addr"],FILTER_SANITIZE_SPECIAL_CHARS);}
						$cn="N/A";if(isset($_POST["cn"])){filter_var($_POST["cn"],FILTER_SANITIZE_SPECIAL_CHARS);}
						$em="N/A";if(isset($_POST["em"])){filter_var($_POST["em"],FILTER_SANITIZE_EMAIL);}

						//INSERT INTO `staff` (`staff_id`, `last_name`, `first_name`, `middle_name`, `address`, `contact_number`, `email_address`, `staff_type`) VALUES (NULL, 'H', 'H', 'H', 'H', 'H', 'H', 'H');
						$sql = "INSERT INTO staff(staff_id,last_name,first_name,middle_name,address,contact_number,email_address,staff_type) VALUES(null,'".$ln."','".$fn."','".$mn."','".$addr."','".$cn."','".$em."','".$st."')";
						
						mysqli_query($con,$sql);
						echo '<h2 style="text-align:center;background:white;margin-top:10px;margin-bottom:10px;" >Personell successfully added</h2>';
					}
				
					include($dir."personell_records.php");
					}
				elseif($loc==="attendance"){include($dir."attendance.php");}
				else{die("<h1>System is down for a moment due to confusion</h1>");}
				
			}
			else{die("<h1>System is down for a moment due to a loss of webpage/s</h1>");}
		}
	}
	else{die("<h1>System is down for a moment due to a loss of homepage</h1>");}


}


?>