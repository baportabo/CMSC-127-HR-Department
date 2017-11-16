<?php 
//put fncs here?
$title = "HR Department";
if(isset($_POST["page"])){$title=$title." - ".$_POST["page"];}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>
    <link rel="icon" href="Picture1.jpg" type="image/jpg" />
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet" />
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet" />
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet" />
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

	<!--ADDED BY ALLEN-->
	<link rel="stylesheet" type="text/css" href="defs/allen.css" />   	
	<script type="text/javascript" src="defs/search_bar.js"></script>

</head>

<body>
