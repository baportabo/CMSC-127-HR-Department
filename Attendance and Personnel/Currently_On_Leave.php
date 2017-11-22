<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Staff Who Are Currently On Leave</title>
     <link rel="icon" href="Picture1.jpg" type="image/jpg">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
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
                <a class="navbar-brand" href="../../">Luke Foundation Inc., Database</a>
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
                            <a href="Organizer.php">
                                <div>
                                    <i class="fa fa-group fa-fw"></i>   Organizer
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
									Only people who are on leave as of today's date will reflect on the first table.
								</p>
							</li>
							
							<li>
								<p class="card-text">
									However, the system permits leaves applied before today's date. This is for cases wherein the staff member opts to apply for leave after the actual leave period. Leave applications that fall under this category will reflect on the second table.
								</p>
							</li>
							
						</ul>
					  </div>
					</div>
            </div>
			
			
        </nav>
		
							<?php
	
								$con = mysqli_connect('127.0.0.1','root','');
	
								if (!$con){
									echo 'Not connected to server';
								}
								
								if (!mysqli_select_db($con,'lukedb')){
									echo 'Database not selected';
								}
								
								$query = "SELECT * FROM attendance_counter WHERE leave_start <> '0000-00-00'";
								$result = mysqli_query($con,$query);
								
								$result_2 = mysqli_query($con,$query);
								
								
								
							?>

        <div id="page-wrapper">
		
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Staff Who Are Currently On Leave as of <?php echo date("m-d-Y") ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Database
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Name</th>
                                        <th>Year</th>
                                        <th>Type of Leave</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								 <?php while ($row = mysqli_fetch_array($result)){
									$query2 = "SELECT last_name,middle_name,first_name FROM staff WHERE staff_id = '$row[staff_id]'";
									$result2 = mysqli_query($con,$query2);
									$row2=mysqli_fetch_row($result2);
									
									$today = date("Y/m/d");
									$check = strtotime($row['leave_end'])-strtotime($today);
									if ($check >= 0){
										echo "<tr class='odd gradeX'>";
										echo "<td>".$row2['0'].', '.$row2['1'].' '.$row2['2']."</td>";   
										echo "<td>". $row['year']."</td>";  
										echo "<td>".$row['leave_type']."</td>";  
										echo "<td>".$row['leave_start']."</td>";  
										echo "<td>".$row['leave_end']."</td>";  
										echo '<td>';
										echo '</tr>';
									}//end if
                                 }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
        </div>

    </div>
	
	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Latest Leave Applications</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Database
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Name</th>
                                        <th>Year</th>
                                        <th>Type of Leave</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								 <?php while ($row_2 = mysqli_fetch_array($result_2)){
									$query_2 = "SELECT last_name,middle_name,first_name FROM staff WHERE staff_id = '$row_2[staff_id]'";
									$result_3 = mysqli_query($con,$query_2);
									$row_3=mysqli_fetch_row($result_3);
									
								
									
									$today = date("Y/m/d");
									$check = strtotime($row_2['leave_end'])-strtotime($today);
									if ($check < 0){
										echo "<tr class='odd gradeX'>";
										echo "<td>".$row_3['0'].', '.$row_3['1'].' '.$row_3['2']."</td>";   
										echo "<td>". $row_2['year']."</td>";  
										echo "<td>".$row_2['leave_type']."</td>";  
										echo "<td>".$row_2['leave_start']."</td>";  
										echo "<td>".$row_2['leave_end']."</td>";  
										echo '<td>';
										echo '</tr>';
									}//end if
                                 }?>
								 
                                </tbody>
                            </table>
                        </div>
                    </div>
        </div>

    </div>
	
	</div>
	
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
<?php mysqli_close($con);?>
</body>

</html>
