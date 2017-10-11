<?php
//FUNCTIONS PHP my CORE
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "lukedb";

$con = mysqli_connect($servername, $username, $password,$database);
if(!$con){die("<h1>System is down because it cannot connect to the database</h1>");}

//mysqli_query($con,"SELECT * FROM user_accounts");

// $db = mysql_select_db($database,$con);
// if(!$db){die("<h1>System is down because it cannot connect to the database</h1>");}

//global vars here
$dir = ""; 
$dir2 = ""; 
$autologin=false;
//end of global vars

?>