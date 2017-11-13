<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Delete Attendance</title>
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
    <title>Delete Attendance</title>
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
                <a class="navbar-brand" href="index.php">Luke's Foundation HR Department</a>
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
                    <h1 class="page-header">Delete Attendance</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Please review the following information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="delete_attendance_record.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');" >
                                        <?php
											$con = mysqli_connect('127.0.0.1','root','');
	
											if (!$con){
												echo 'Not connected to server';
											}
	
											if (!mysqli_select_db($con,'lukedb')){
												echo 'Database not selected';
											}
											
											$query = "SELECT * FROM attendance_record WHERE year = '$_POST[year]' && staff_id='$_POST[staff_id]'";
											$result = mysqli_query($con,$query);
											$row=mysqli_fetch_row($result);
											$year = $_POST['year'];
											
											$query="SELECT sick_leave_balance,vac_leave_balance,undertime,offset FROM attendance_counter WHERE year = '$_POST[year]' && staff_id='$_POST[staff_id]'";
											$result2 = mysqli_query($con,$query);
											$row2=mysqli_fetch_row($result2);
											
											$row1[0]=$_POST['staff_id'];
											
											$content="";
											$content=$content.'
															<input class="hide" name="staff_id" type="text" value="'.$row["1"].'" />
															
															<div class="form-group">
															<label>Remarks</label>
															<input class="form-control" placeholder="'.$row['3'].'" value="'.$row['3'].'" name="remarks" readonly>
															</div>
															<div class="form-group">
															<label>Approved By</label>
																<input class="form-control" placeholder="'.$row['4'].'" value="'.$row['4'].'" name="approved_by" readonly>
															</div>
															<div class="form-group">
																<label>Start Date</label>
																<input class="form-control" placeholder="'.$row['5'].'" value="'.$row['5'].'" name="start" readonly>
															</div>
                                          
															<div class="form-group">
																<label>End Date</label>
																<input class="form-control" placeholder="'.$row['6'].'" value="'.$row['6'].'" name="end" readonly>
															</div>
															
															<div class="form-group">
																<label>Sick Leave Balance</label>
																<input class="form-control" placeholder="'.$row2['0'].'" value="'.$row2['0'].'" name="sick_leave_balance" readonly>
															</div>
															
															<div class="form-group">
																<label>Vacation Leave Balance</label>
																<input class="form-control" placeholder="'.$row2['1'].'" value="'.$row2['1'].'" name="vac_leave_balance" readonly>
															</div>
															
															<div class="form-group">
																<label>Undertime</label>
																<input class="form-control" placeholder="'.$row2['2'].'" value="'.$row2['2'].'" name="undertime" readonly>
															</div>
															
															<div class="form-group">
																<label>Offset</label>
																<input class="form-control" placeholder="'.$row2['3'].'" value="'.$row2['3'].'" name="offset" readonly>
															</div>
			
														';
												
											
										?>
                                        <div class="form-group">
                                            
                                            <div class="form-group">                                            
                                               <?php
												echo $content;
												echo '<input class="hide" name="staff_id" value="'.$row1["0"].'" />';
												echo '<input class="hide" name="year" value="'.$_POST["year"].'" />';
											   ?>
                                                
                                        </div>
										<button type="button" onclick="history.back()" class="btn btn-default">Back</button>
                                        <button type="submit" class="btn btn-default">Confirm</button>
										
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