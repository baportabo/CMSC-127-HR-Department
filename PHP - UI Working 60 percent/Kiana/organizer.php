<!doctype html>

<html lang=''>
<head>
<style>
.login-block button {
    width: 20%;
    height: 40px;
    margin-left:80px;
    background: #47c9af;   /* submit */
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #66B6A1;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}
.login-block button:hover {
    background: #72EFCE;
}
.login-block {
    width: 1020px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 10px solid #47c9af; /* BORDER TOP */
    margin-left:14.5%;
    margin-top:5%;
}
.login-block input {
    height: 32px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #47c9af; /* username and password border */
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}


</style>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>Organizer</title>
</head>
<body>

<?php
	
	$con = mysqli_connect('127.0.0.1','root','');
	
	if (!$con){
		echo 'Not connected to server';
	}
	
	if (!mysqli_select_db($con,'lukedb')){
		echo 'Database not selected';
	}
	
	$query = "SELECT * FROM organizer";
	$result = mysqli_query($con,$query);
	
?>

<div id='cssmenu'>
<ul>
  <li><a href='home.html'>Home</a></li>
   <li class='active' ><a href='organizer.php'>Organizer</a></li>
   <li><a href='activities.html'>Activities</a></li>
   <li><a href='personnel.html'>Personnel</a></li>
   <li ><a href='attendance.php'>Attendance</a></li>
    <li><a href="index.html" target="_blank">About</a></li>
</ul>
</div>

<div class="login-block">
      <div id='cssmenu_2'>
<ul>
   <li class='active'><a href='#'>Organizer List</a></li>
   <li><a href='organizer_add.html'>Add Organizer</a></li>

</ul>

</div>
    
	<br>
		<table>
			<tr>
				<th>Organization ID</th>
				<th>Organization Name</th>
				<th>Representative Contact Number</th>
				<th>Representative Name</th>
				<th>Representative Email</th>
				<th>Representative Address</th>
				<th>Action</th>
			</tr>
		
		
		
		
		
		<?php while ($row = mysqli_fetch_array($result)){	 
			  echo "<tr>";
			  echo "<td>".$row['org_id']."</td>"; 
			  echo "<td>".$row['org_name']."</td>";  
			  echo "<td>".$row['rep_contact']."</td>";  
			  echo "<td>".$row['rep_name']."</td>";  
			  echo "<td>".$row['rep_email']."</td>";  
			  echo "<td>".$row['rep_address']."</td>"; 
			  echo "<td><a class='button' href = delete_organizer.php?org_id=".$row['org_id'].">Delete</a></td>";
			  echo "</tr>";
		 } ?>
			
	
		</table>
		
			
		
		
	
	
	
	
	
</div>
<?php mysqli_close($con);?>
</body>
<html>
