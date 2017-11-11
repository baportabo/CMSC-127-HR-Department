<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Submit Leave</title>
     <link rel="icon" href="Picture1.jpg" type="image/jpg">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	
</head>

<body>

    <div id="wrapper">
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
                        <li>
                            <a href="Personnel.php">
                                <div>
                                    <i class="fa fa-user fa-fw"></i>   Personnel
                                </div>
                               
                            </a>
                        </li>
						
						<li class="divider"></li>
                        <li>
                            <a href="Attendance.php">
                                <div>
                                    <i class="fa fa-user fa-fw"></i>   Attendance
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
                                <h4>Options:</h4>
                            </div>
                           
                        </li>
						<li>
                            <a href="Attendance.php"><i class="fa fa-search fa-fw"></i> Return to Attendance</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Submit Leave</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Fill Up the Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								<form role="form" action = "submit_leave.php" method="post" onsubmit="return confirm('Are you sure you want to submit this leave form?');">
                                    <?php
											$con = mysqli_connect('127.0.0.1','root','');
	
											if (!$con){
												echo 'Not connected to server';
											}
	
											if (!mysqli_select_db($con,'lukedb')){
												echo 'Database not selected';
											}
											
											$query = "SELECT * FROM staff WHERE staff_id = '$_POST[staff_id]'";
											$result = mysqli_query($con,$query);
											$row=mysqli_fetch_row($result);
											
											$content="";
											$content=$content.'
															
															<input class="hide" placeholder="'.$row['0'].'" value="'.$row['0'].'" name="staff_id" readonly>
															
															<div class="form-group">
															<label>Year</label>
															<input class="form-control" placeholder="'.$_POST['year'].'" value="'.$_POST['year'].'" name="year" readonly>
															</div>
															
															<div class="form-group">
															<label>Last Name</label>
															<input class="form-control" placeholder="'.$row['1'].'" value="'.$row['1'].'" name="last_name" readonly>
															</div>
															<div class="form-group">
															<label>First Name</label>
																<input class="form-control" placeholder="'.$row['2'].'" value="'.$row['2'].'" name="first_name" readonly>
															</div>
															<div class="form-group">
																<label>Middle Name</label>
																<input class="form-control" placeholder="'.$row['3'].'" value="'.$row['3'].'" name="middle_name" readonly>
															</div>
			
														';
											
										?>
                                        <div class="form-group">
                                            
                                            <div class="form-group">                                            
                                               <?php
												echo $content;
											   ?>
											<div class="form-group"> 
												<label>Nature of Leave</label>
											   <select class="form-control" id="type" name="type">
													<option value="sick">Sick Leave </option>
													<option value = "vacation">Vacation Leave </option>
													<option value="maternity">Maternity Leave </option>
												</select>
											</div>	
											<div class="form-group">
												<label>Start of Leave Period</label>
												
												<input type="date"  name = "start" id = "start" required> 
											</div>
											
											<div class="form-group">
												<label>End of Leave Period</label>
												
												<input type="date"  name = "end" id = "end" required> 
											</div>
                                                
                                        </div>
										
										<button type="button" onclick="history.back()" class="btn btn-default">Back</button>
                                        <button type="submit" class="btn btn-default">Submit </button>
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

</html>
