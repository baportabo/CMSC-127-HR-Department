<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Attendance</title>
     <link rel="icon" href="Picture1.jpg" type="image/jpg">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="jquery-3.2.1.min.js"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Attendance Record</title>
     <link rel="icon" href="Picture1.jpg" type="image/jpg">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../">Luke's Foundation HR Department</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                    <a  href="index.php">
                        <i class="fa fa-home fa-fw"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-list fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="Organizer.php">
                                <div>
                                    <i class="fa fa-group fa-fw"></i>   Organizer
                                </div>
                                
                            </a>
                        </li>
                         <li class="divider"></li>
                        <li>
                            <a href="Activities.php">
                                <div>
                                    <i class="fa fa-calendar-o fa-fw"></i>   Activities
                                </div>
                                
                            </a>
                        </li>
                        <li class="divider"></li>
                     
                        <li class="divider"></li>
                        <li>
                            <a href="Personnel.php">
                                <div>
                                    <i class="fa fa-book fa-fw"></i>   Personnel
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li >
                            <div>
                                <h4>  Options:</h4>
                            </div>
                           
                        </li>
                        <li>
                            <a href="Attendance.php"><i class="fa fa-search fa-fw"></i> Search Records</a>
                        </li>
                        <li>
                            <a href="Edit Attendance.php"><i class="fa fa-edit fa-fw"></i> Edit Record</span></a>
                        </li>
                        <li>
                            <a href="Delete Attendance.php"><i class="fa fa-trash-o fa-fw"></i> Delete Record</a>
                        </li>
                        <li>
                            <a href="Add Attendance.php"><i class="fa fa-plus-circle fa-fw"></i> Add Attendance</a>
                        </li>
						
						<li>
                            <a href="Currently_On_Leave.php"><i class="fa fa-user"></i> List of Staff Currently On Leave</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
		
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Attendance</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Which Record Would You Like to Update?
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="Edit Attendance Next.php" method="POST">
                                        <?php
											$con = mysqli_connect('127.0.0.1','root','');
	
											if (!$con){
												echo 'Not connected to server';
											}
	
											if (!mysqli_select_db($con,'lukedb')){
												echo 'Database not selected';
											}
											
											$query = "SELECT * FROM staff";
											$result = mysqli_query($con,$query);
											$query = "SELECT staff_id FROM attendance_record";
											$result2 = mysqli_query($con,$query);
											
											$dropdown="";
											
											$arr = array();
											while ($row2 = mysqli_fetch_array($result2)){ //loop thru staff_ids in attendance record
												$bool = 1;
												foreach ($arr as $value) {
													if($row2['staff_id']==$value){
														$bool=0;
													}
												}
												if ($bool == 1){
													$arr[] = $row2['staff_id'];
												}
												
											}//end while
											
											$cnt=0;
											while ($row = mysqli_fetch_array($result)){
												foreach ($arr as $value) {
													if($row['staff_id']==$value){
														$dropdown=$dropdown.'<option value="'.$row["last_name"].'  ">'.$row["last_name"].', '.$row["first_name"].'</option>';
														$cnt=$cnt+1;
													}
												}
											}	
										?>
                                        <div class="form-group">
                                            <label>List of Employees</label>
                                            <div class="form-group">                                            
                                                <?php 
													if ($cnt!=0){
														echo '<select class="form-control" id="last_name" name="last_name">';
														echo $dropdown;
														echo ' </select>';
														echo '</div>';
														echo '<button type="submit" class="btn btn-default">Next</button>';
													}else{
														 echo "<p> No attendance record currently exists in the database. Consider adding entries. </p>";
													}
												?>
                                        </div>
                                    
                                    </form>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>
<?php mysqli_close($con);?>
</html>
