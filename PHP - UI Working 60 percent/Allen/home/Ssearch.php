<?php
if(!file_exists("core/function.php")){die("");}
else{require("core/function.php");}

if(isset($_SESSION["uname"])&&isset($_SESSION["pword"])){
	//filter_var($url,FILTER_SANITIZE_SPECIAL_CHARS)
	
	$uname = filter_var($_SESSION["uname"],FILTER_SANITIZE_SPECIAL_CHARS);
	$pword = filter_var($_SESSION["pword"],FILTER_SANITIZE_SPECIAL_CHARS);
	
	$sql = "SELECT * FROM user_accounts WHERE uname='".$uname."' AND pword='".$pword."'";
	
	$query = mysqli_query($con,$sql);
	if(mysqli_num_rows($query)>0){//valid user
		//start loading up the queue
		if(isset($_GET["q"])){
			$q = filter_var($_GET["q"],FILTER_SANITIZE_SPECIAL_CHARS);
			
			//SELECT * FROM staff WHERE first_name+" "+middle_name+" "+last_name LIKE "%Al%"
			$sql = "SELECT * FROM staff WHERE first_name LIKE '".$q."%' OR last_name LIKE '".$q."%' OR middle_name LIKE '".$q."%'";
			$query = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)>0){
					$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
					
					$res='
					
					<!-- Microformats! -->
				
					<h1 class="fn">'.$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"].'</h1>
					<p> 

						Last Name: <span class="name">'.$row["last_name"].'</span><br />
						First Name: <span class="name">'.$row["first_name"].'</span><br />
						Middle Name: <span class="name">'.$row["middle_name"].'</span><br />
						Contact: <span class="tel">'.$row["contact_number"].'</span><br />
						Staff Type: <span class="tel">'.$row["staff_type"].'</span><br />
						Email: <a class="email" href="mailto:'.$row["email_address"].'">'.$row["email_address"].'</a>

					</p>
						
					';
			}else{
				$res="<h1>Nothing found</h1>";
			
			}
			
			
			
			
			echo $res;
		}
	}

}
?>