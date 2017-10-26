<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Personnel</title>
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
	
	$query = "SELECT * FROM staff";
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
                                    <i class="fa fa-user fa-fw"></i>   Activities
                                </div>
                               
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="Attendance.php">
                                <div>
                                    <i class="fa fa-book fa-fw"></i>   Attendance
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
                            <a href="Personnel.php"><i class="fa fa-search fa-fw"></i>Search Records</a>
                        </li>
                        <li>
                            <a href="Edit Personnel.php"><i class="fa fa-edit fa-fw"></i> Edit Record</a>
                        </li>
                        <li>
                            <a href="Delete Personnel.php"><i class="fa fa-trash-o fa-fw"></i> Delete Record</span></a>
                        </li>
                        <li>
                            <a href="Add Personnel.php"><i class="fa fa-plus-circle fa-fw"></i> Add Personnel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Personnel</h1>
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
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Contact Number</th>
                                        <th>Staff Type</th>
                                        <th>Email</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($result)){
										echo "<tr class='odd gradeX'>";
									
										echo "<td>".$row['last_name']."</td>";  
										echo "<td>".$row['first_name']."</td>";  
										echo "<td>".$row['middle_name']."</td>"; 
										echo "<td>". $row['contact_number']."</td>";  
										echo "<td>".$row['staff_type']."</td>";  
										echo "<td>".$row['email_address']."</td>";  
										echo '<td>
										<form method="POST" action="Delete Personnel Next.php" >
											<input class="hide" name="staff_id" type="text" value="'.$row["staff_id"].'" />
											<input class="hide" name="last_name" type="text" value="'.$row["last_name"].'" />
											<input class="hide" name="first_name" type="text" value="'.$row["first_name"].'" />
											<input class="hide" name="middle_name" type="text" value="'.$row["middle_name"].'" />
											<input class="hide" name="address" type="text" value="'.$row["address"].'" />
											<input class="hide" name="contact_number" type="text" value="'.$row["contact_number"].'" />
											<input class="hide" name="email_address" type="text" value="'.$row["email_address"].'" />
											<input class="hide" name="staff_type" type="text" value="'.$row["staff_type"].'" />
											<input id="org_btn" class="btn btn-default" type="submit" value="Delete" />
										</form>
										
										<form method="POST" action="Edit Personnel Next.php" >
											<input class="hide" name="staff_id" type="text" value="'.$row["staff_id"].'" />
											<input class="hide" name="last_name" type="text" value="'.$row["last_name"].'" />
											<input class="hide" name="first_name" type="text" value="'.$row["first_name"].'" />
											<input class="hide" name="middle_name" type="text" value="'.$row["middle_name"].'" />
											<input class="hide" name="address" type="text" value="'.$row["address"].'" />
											<input class="hide" name="contact_number" type="text" value="'.$row["contact_number"].'" />
											<input class="hide" name="email_address" type="text" value="'.$row["email_address"].'" />
											<input class="hide" name="staff_type" type="text" value="'.$row["staff_type"].'" />
											<input id="org_btn" class="btn btn-default" type="submit" value="Update" />
										</form>
										
										
										</td>';
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

</body>
<?php mysqli_close($con);?>
</html>
