<!DOCTYPE html>
<html lang="en">

<head>
<style> 
input[type=text] {
    width: 150px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
    width: 50%;
}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Attendance Summary</title>
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
                            <a href="attendance_summary.php"><i class="fa fa-file-excel-o"></i> Attendance Summary</a>
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
                    <h1 class="page-header">Summary of Attendance</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
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
								$years="";			
								$sd="";
								
								if (isset($_POST['staff_id'])){ //populate table values here
									
									$staff_id = $_POST['staff_id'];
									
									$query2 = "SELECT * FROM STAFF where staff_id = '$staff_id'";
									$result2 = mysqli_query($con,$query2);
									$row2=mysqli_fetch_row($result2);
									$default = $row2['1'].', '.$row2['2'];
									
									$query4 = "SELECT year FROM attendance_record where staff_id = '$staff_id'";
									$result4 = mysqli_query($con,$query4);
									
									if (isset($_POST['year'])){
										$year = $_POST['year'];
										$years = $years.'<option value="'.$_POST["year"].'  ">'.$_POST["year"];
										while ($row4 = mysqli_fetch_array($result4)){
											if ($row4['year']!=$_POST['year']){
												$years=$years.'<option value="'.$row4["year"].'  ">'.$row4["year"];
											}
											
										}
									}else{
										while ($row4 = mysqli_fetch_array($result4)){
											$years=$years.'<option value="'.$row4["year"].'  ">'.$row4["year"];
											$year = $row4['year'];
										}
										//set default value for year
									}
									
									
									$sd = '<input class="hide" name="staff_id" type="text" value="'.$staff_id.'" />';
									
									$query3 = "SELECT * FROM attendance_record WHERE staff_id = '$staff_id'";
									$result3 = mysqli_query($con,$query);
									
								}else{
									$default='';
									//set default value for staff id
									
								}
								
								if ($default != ''){
									$dropdown=$dropdown.'<option value="'.$row2["0"].'  ">'.$row2["1"].', '.$row2["2"].'</option>';
									while ($row = mysqli_fetch_array($result)){
										if ($row["staff_id"]!=$row2["0"]){
											$dropdown=$dropdown.'<option value="'.$row["staff_id"].'  ">'.$row["last_name"].', '.$row["first_name"].'</option>';
										}
									}
								}else{
									while ($row = mysqli_fetch_array($result)){
										$dropdown=$dropdown.'<option value="'.$row["staff_id"].'  ">'.$row["last_name"].', '.$row["first_name"].'</option>';
										$staff_id = $row["staff_id"];
									}	
								}			
																
							?>
						<form role="form" action = "attendance_summary.php" method="post" onchange = "this.submit()">
							
							<select class="form-control" id="staff_id" name="staff_id" style = "font-size:19px" >  >
							<div class="form-group">
								<?php echo $dropdown; ?>
							</div>	
							</select>
						
                        </form>     
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="attendance_summary_table" name="attendance_summary_table" >
                             
                               <tr> 
                                <thead>
                                    <th>
										<form role="form" action = "attendance_summary.php" method="post" onchange = "this.submit()">
											
											<div style="margin-left:180px"> Year :
												<?php echo $sd; ?>
												<select name='year' id='year'>
													<?php echo $years;?>
												</select>
											</div>
										</form>
									</th>
								<form role="form" action = "attendance_summary.php" method="post" onsubmit="return confirm('You are about to make changes to the attendance summary. Proceed?');">
                                    <th style="text-align:center;font-size:15px" scope="col">Sick Leave</th>
                                    <th style="text-align:center;font-size:15px" scope="col">Vacation Leave</th>
                                    <th style="text-align:center;font-size:15px" scope="col">Undertime (hours)</th>
                                    <th style="text-align:center;font-size:15px" scope="col">Offset (hours)</th>
                                     </thead>
                                </tr>
                               
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">January</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">February</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">March</th>
                                     <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">April</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">May</th>
                                     <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">June</th>
                                     <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">July</th>
                                     <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">August</th>
                                      <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">September</th>
                                      <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">October</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">November</th>
                                   <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;font-size:15px" scope="row">December</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
								<?php
									$query = "SELECT * FROM ATTENDANCE_COUNTER where staff_id = '$staff_id' && year = '$year'";
									$result = mysqli_query($con,$query);
									$row=mysqli_fetch_row($result);
								?>
								
								<tr style="background-color:#e6e6e6">
                                    <th style="text-align:center;font-size:15px" scope="row">Total</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
								
								<tr style="background-color:#e6e6e6">
                                    <th style="text-align:center;font-size:15px" scope="row">Remaining Balance</th>
                                    <td><?php echo $row['3'] ?></td>
                                    <td><?php echo $row['4'] ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
							<?php 
								$staff_id = $_POST['staff_id'];
								if (isset($_POST['year'])){
									$year = $_POST['year'];
									
								}
								
								echo '<input class="hide" name="staff_id" type="text" value="'.$staff_id.'" />';
							?>
                            </table>
                           <button type="submit" class="btn btn-default">Edit Fields</button>
						   
						   </form>
                        </div>
                    </div>
                </div>
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

</html>
