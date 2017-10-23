<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Attendance</title>
     <link rel="icon" href="Picture1.jpg" type="image/jpg">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<?php
	
	$con = mysqli_connect('127.0.0.1','root','');
	
	if (!$con){
		echo 'Not connected to server';
	}
	
	if (!mysqli_select_db($con,'lukedb')){
		echo 'Database not selected';
	}
	
	$query = "SELECT * FROM attendance_record";
	$result = mysqli_query($con,$query);
	
?>

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
                <a class="navbar-brand" href="index.html">Luke's Foundation HR Department</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                 
                 <li class="dropdown">
                    <a  href="index.html">
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
                            <a href="Attendance.php">
                                <div>
                                    <i class="fa fa-group fa-fw"></i>   Organizer
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="Edit Attendance.html"><i class="fa fa-edit fa-fw"></i> Edit Record</a>
                        </li>
                        <li>
                            <a href="Delete Attendance.html"><i class="fa fa-trash-o fa-fw"></i> Delete Record</span></a>
                        </li>
                        <li>
                            <a href="Add Attendance.html"><i class="fa fa-plus-circle fa-fw"></i> Add Attendance</a>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Attendance</h1>
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
                                        <th>ID</th>
                                        <th>Staff ID</th>
                                        <th>Year</th>
                                        <th>Remarks</th>
                                        <th>Approved by</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								 <?php while ($row = mysqli_fetch_array($result)){
                                    echo "<tr class='odd gradeX'>";
									echo "<td>".$row['id']."</td>";  
									echo "<td>".$row['staff_id']."</td>";  
									echo "<td>". $row['year']."</td>";  
									echo "<td>".$row['remarks']."</td>";  
									echo "<td>".$row['approved_by']."</td>";  
									echo "<td>".$row['start']."</td>"; 
									echo "<td>".$row['end']."</td>";  			   
                                    echo "</tr>";
                                    }?>
                                    
                                </tbody>
                            </table>
                           
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
