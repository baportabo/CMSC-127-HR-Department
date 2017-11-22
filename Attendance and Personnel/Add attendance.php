<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Attendance</title>
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
                        <li>
                            <a href="Personnel.php">
                                <div>
                                    <i class="fa fa-user fa-fw"></i>   Personnel
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
                            <a href="Attendance.php"><i class="fa fa-search fa-fw"></i> Search Records</a>
                        </li>
                        <li>
                            <a href="Edit Attendance.php"><i class="fa fa-edit fa-fw"></i> Edit Record</a>
                        </li>
                        <li>
                            <a href="Delete Attendance.php"><i class="fa fa-trash-o fa-fw"></i> Delete Record</span></a>
                        </li>
                        <li>
                            <a href="Add Attendance.php"><i class="fa fa-plus-circle fa-fw"></i> Add Attendance</a>
                        </li>
						
						<li>
                            <a href="Currently_On_Leave.php"><i class="fa fa-user"></i> List of Staff Currently On Leave</a>
                        </li>
                    </ul>
                </div>
				<br>
				<div class="card" style="width: 20rem;">
					
					  <div class="card-block">
						<h4 class="card-title">Reminders:</h4>
						<ul>
							<li>
								<p class="card-text">
									Ensure that the start date precedes the end date.
								</p>
							</li>
							
							<li>
								<p class="card-text">
									Ensure that an attendance record with the same year doesn't exist for the employee in question.
								</p>
							</li>
						</ul>
					  </div>
					</div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Attendance</h1>
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
                                    <form role="form" action = "insert_attendance_record.php" method="post" onsubmit="return confirm('Are you sure you want to add this record?');">
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
											$dropdown="";
														
											while ($row = mysqli_fetch_array($result)){
												$dropdown=$dropdown.'<option value="'.$row["staff_id"].'  ">'.$row["last_name"].', '.$row["first_name"].'</option>';
											}	
										?>
                                        <div class="form-group">
                                            <label>Name</label>
											<select class="form-control" id="staff_id" name="staff_id">
                                            <?php
												echo $dropdown;
											?>
											</select>
                                        </div>
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input class="form-control" type="year" placeholder="YYYY" name="year" maxlength="4" required pattern="^\d{4}">
                                        </div>
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control" rows="3" name="remarks" pattern = "[a-zA-Z0-9\s]+"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Approved by</label>
                                            <input class="form-control" placeholder="Enter Name of Approver" name="approved_by" required>
                                        </div>
										 
                                        <div class="form-group">
                                            <label>Start</label>
                                            
											<input type="date"  name = "start" id = "start" max="2037-12-30" required>
                                        </div>
                                        <div class="form-group">
                                            <label>End</label>
											<input type="date"  name = "end" id = "end" max="2037-12-30" required>
                                        </div>
										
										
										
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
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
