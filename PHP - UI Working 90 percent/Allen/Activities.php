<?php
$fnc = "defs/fnc.php";
$main_h1 ='
	        <div id="page-wrapper">
			
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Activities</h1>
                </div>
            </div>
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ';
$main_h2 ='
                        </div>

                        <div class="panel-body">
							<!-- REMEMBER THIS THIS MIGHT BE THE THINGY
							<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							-->
						<!--CHANGE STARTS HERE-->
        ';
						
$main_l ='
							<!--
							</div>
							-->
							
                        </div>
                    </div>
                </div>
            </div>
         </div>
';
if(file_exists($fnc)){
	require($fnc);
	
	if(isset($_GET["delete"])){
		$keyword = filter_var($_GET["delete"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		$sql = "SELECT * FROM activity_list WHERE activity LIKE '%".$keyword."%' ";
		$query=mysqli_query($con,$sql);
		
		$act_name = "None";$act_date = "None";$act_location = "None";
		$act_org = "None";$act_staff = "None";
		
		
		if(mysqli_num_rows($query)>0){//needs to be more than 0
			$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$act_id = $row["id"];
			$act_name = $row["activity"];
			$act_date = $row["date"];
			$act_location = $row["location"];
			$act_org = $row["organizer_id"];
			$act_staff = $row["staff_id"];
		}else{
			$act_id = "";
			$act_name = "No record was found, try more keywords";
		}	
	
	
		echo '
			<div style="display:none;" >
				<label>Activity ID</label>
				<input readonly="true" name="del_act_id" class="form-control" value="'.$act_id.'" >
			</div>
		
			<div class="form-group">
				<label>Activity Name</label>
				<input name="del_act_name" value="'.$act_name.'" readonly="true" class="form-control" placeholder="None">
			</div>

			<div class="form-group">
				<label>Date</label>
				<input name="del_act_date" value="'.$act_date.'" readonly="true" class="form-control" type="text" placeholder="None">
			</div>
			
			<div class="form-group" >
				<label>Location</label>
				<textarea name="del_act_location" readonly="true" class="form-control" rows="3" placeholder="None" >'.$act_location.'
				</textarea>
			</div>                                        

			<div class="form-group">
				<label>Organizers Involved</label>
				<div class="form-group">        
					<!-- <select name="del_act_org" multiple class="form-control"> -->
					<textarea name="del_act_org" readonly="true" class="form-control" placeholder="None" >'.$act_org.'
					</textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label>Personnels Involved</label>
				<div class="form-group">                           
					<!-- <select name="del_act_staff" multiple class="form-control"> -->
					<textarea name="del_act_staff" readonly="true" class="form-control" placeholder="None" >'.$act_staff.'
					</textarea>
				</div>
			</div>
			
			<input type="submit" class="btn btn-default" id="del" value="Delete Activity" />
		
		
		
		';
	
	}
	elseif(isset($_POST["del_act_id"])&&isset($_POST["del_act_name"])&&isset($_POST["del_act_date"])&&isset($_POST["del_act_location"])&&isset($_POST["del_act_org"])&&isset($_POST["del_act_staff"])){
		$act_id = filter_var($_POST["del_act_id"],FILTER_SANITIZE_NUMBER_INT);
		$act_name = filter_var($_POST["del_act_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_date = filter_var($_POST["del_act_date"],FILTER_SANITIZE_SPECIAL_CHARS);		
		$act_location = filter_var($_POST["del_act_location"], FILTER_SANITIZE_NUMBER_INT);
		$act_org = filter_var($_POST["del_act_org"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_staff = filter_var($_POST["del_act_staff"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(strlen($act_name)==0){$act_name="None";}
		if(strlen($act_date)==0){$act_date="None";}
		if(strlen($act_location)==0){$act_location="None";}
		if(strlen($act_org)==0){$act_org="None";}
		if(strlen($act_staff)==0){$act_staff="None";}
		
		$val = true;
		$act_id_array = str_split($act_id);
			foreach($act_id_array as $digit){
				if(!is_numeric($digit)){
					$val = false;
					break;
				}
			}
			
		//note: you will only delete
		if($val){//means valid id, email, and contact
			
			$sql = "SELECT * FROM activity_list	WHERE id='".$act_id."' ";
			$query=mysqli_query($con,$sql);
		
			if(mysqli_num_rows($query)>0){
				$sql = "DELETE FROM activity_list WHERE id='".$act_id."' ";
				$query=mysqli_query($con,$sql);
				
				$sql = "SELECT * FROM activity_list	WHERE id='".$act_id."' ";
				$query=mysqli_query($con,$sql);
				
				if(mysqli_num_rows($query)==0){
					$msg='The record about that organizer with this information exists and was deleted';
					$content = del($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,false,$act_id);
				}
				else{
					$msg='The record about that organizer exists but cannot be deleted for some reason, please contact the system administrator to fix this';
					$content = del($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,true,$act_id);
				}
			}
			else{
				$msg='The record about that organizer doesn&apos;t exist in the first place so there is nothing to delete';
				$content = del($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,true,$act_id);
			}		
		}else{
			$msg = '	
					The activity record you entered is invalid<br />
					Please check your input by trying to search again the record before deleting then try again
				';
				
			$content = del($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,true,$act_id);
		}
	
	
		$_POST["page"]="Activities"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "delete";
		$subhead=ucwords($action)." activities";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);
	}
	
	elseif(isset($_POST["add_act_name"])&&isset($_POST["add_act_date"])&&isset($_POST["add_act_location"])&&isset($_POST["add_act_org"])&&isset($_POST["add_act_staff"])){
		$act_name = filter_var($_POST["add_act_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_date = filter_var($_POST["add_act_date"],FILTER_SANITIZE_SPECIAL_CHARS); //not effective
		$act_location = filter_var($_POST["add_act_location"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_org = filter_var($_POST["add_act_org"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_staff = filter_var($_POST["add_act_staff"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		//NOTE TO EDIT : organizer_id and staff_id should be ids but for now settle for stuff
		
		//checking for existence phase
			$sql = "SELECT * FROM activity_list WHERE activity='".$act_name."'";
			$query=mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)==0&&strlen($act_name)>0){//means no activity name with this info is here
				//adding phase
					$sql = "INSERT INTO activity_list (id, activity, date, location, organizer_id, staff_id) 
					VALUES (NULL, '".$act_name."', '".$act_date."', '".$act_location."', '".$act_org."', '".$act_staff."')";
					$query=mysqli_query($con,$sql);
					
					$sql = "SELECT * FROM activity_list WHERE activity='".$act_name."' AND date='".$act_date."' 
					AND location='".$act_location."' AND organizer_id='".$act_org."' AND staff_id='".$act_staff."' " ;
					$query=mysqli_query($con,$sql);
					
					if(mysqli_num_rows($query)>0){//check for success
						$msg = '	
							The activity record with this information is added to the database : <br />
							Activity Name : '.$act_name.'<br />
							Date : '.$act_date.'<br />
							Location : '.$act_location.'<br />
							Organizers involved : '.$act_org.'<br />
							Staff involved :'.$act_staff.'
						';
						$content=add($con,null,null,null,null,null,$msg,false);
					}else{
						$msg = 'All inputs are valid but the activity was not added for some reason, please contact the system administrator to fix this';
						$content=add($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,true);
					}
					
					
			}else{
				$msg = 'Invalid activity name, please enter a valid activity name and check that it doesn&apos;t exist already in the database';
				$content=add($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,true);
			}
			
		$_POST["page"]="Activities"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "add";
		$subhead=ucwords($action)." activities";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);
	}
	else{//default choices
		$_POST["page"]="Activities"; //set page title and other functionalities using this
			require($head);
			require($nav);
			
			//note just edit main since this contains the main part
			$action = "search activities";
			$act_true = isset($_GET["action"]);
			
			$content = "";
			$subhead = "Activities";
			$valid_act = false;
			
				if($act_true){
					$action=filter_var($_GET["action"],FILTER_SANITIZE_SPECIAL_CHARS);
					if($action==="search"){$content = "";$valid_act=true;}
					elseif($action==="edit"){$content = "";$valid_act=true;}
					elseif($action==="delete"){$content = del($con,null,null,null,null,null,null,null,null);$valid_act=true;}
					elseif($action==="add"){$content = add($con,null,null,null,null,null,null,null);$valid_act=true;}
					else{header("location:index.php?missing_page=true");}
				}
				else{
					$content = "";
				}
			if($act_true&&$valid_act){$subhead=ucwords($action)." activities";}
			//ucwords() uppercases the first letter of a word
			echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
			echo "</div>"; //this is to end the div wrapper in nav.php
			
			require($foot);
	}
	
	mysqli_close($con);
	
}
else{die("Error : The website is missing a ciritcal file, contact system administrator");}

function add($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error){
	$sms = "";
	$er_msg="The activity was successfully added";
	if($msg!=null){
		$id = "success_msg";
		if($is_error){$id='error_msg';$er_msg="Error with trying to add an activity";}
		$sms = '
				<div >
					<h4 id="'.$id.'" >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}

	$content_h = '<div class="row">
					<div id="add_org_cont" class="col-lg-6">
						<form method="POST" action="Activities.php" role="form">
							
							'.$sms.'
							
							<div class="form-group">
								<label>Activity Name</label>
								<input name="add_act_name" value="'.$act_name.'" class="form-control" placeholder="Enter the activity&apos;s name (Required)">
							</div>

							<div class="form-group">
								<label>Date</label>
								<input name="add_act_date" value="'.$act_date.'" class="form-control" type="date" placeholder="Enter the date of the activity">
							</div>
							
							<div class="form-group">
								<label>Location</label>
								<textarea name="add_act_location" value="'.$act_location.'" class="form-control" rows="3" placeholder="i.e. Cabinet Hill, Baguio City (Optional)"></textarea>
							</div>                                        

							<div class="form-group">
								<label>Organizers Involved (cannot select more than one for now)</label>
								<div class="form-group">        
									<!-- <select name="add_act_org" multiple class="form-control"> -->
									<select name="add_act_org" class="form-control">';

$content_l1=				'</select>
								</div>
							</div>;
							
							<div class="form-group">
								<label>Personnels Involved (cannot select more than one for now)</label>
								<div class="form-group">                           
									<!-- <select name="add_act_staff" multiple class="form-control"> -->
									<select name="add_act_staff" class="form-control">';
								  
$content_l2 = '					  </select>
								</div>
							</div>
							
							<input type="submit" class="btn btn-default" value="Add Activity" />
						</form>
					</div>
				   
				</div>';
$orgs="<option value='None'>None</option>";
	
$staff="<option value='None'>None</option>";
			
			/////////////////STAFF////////////
			
			$sql = "SELECT * FROM staff ORDER BY last_name";
			$query = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)>0){
				while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
					$staff = $staff."<option value='".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."' >".$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]."</option>";
				}
			}else{
				$staff = "<option>No staff available</option>";
			}
			
			//if($act_staff!=null){$staff="<option value='".$act_staff."' >".$act_staff."</option>";}
			
			/////////////////ORGS/////////////
			
			$sql = "SELECT * FROM organizer ORDER BY org_name";
			$query = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)>0){
				while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
					$orgs = $orgs."<option value='".$row["org_name"]."' >".$row["org_name"]."</option>";
				}
			}else{
				$orgs = "<option>No organizers available</option>";
			}
			
			//if($act_org!=null){$org="<option value='".$act_org."' >".$act_org."</option>";}
			
			
			
	$content = $content_h . $orgs . $content_l1 . $staff . $content_l2;
	return $content;
}

function del($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$act_id){
	$sms = "";
	$er_msg="The activity was successfully deleted";
	
	if($act_name==null){$act_name="None";}
	if($act_date==null){$act_date="None";}
	if($act_location==null){$act_location="None";}
	if($act_org==null){$act_org="None";}
	if($act_staff==null){$act_staff="None";}
	
	
	if($msg!=null){
		$id = "success_msg";
		if($is_error){$id='error_msg';$er_msg="Error with trying to delete an activity";}
		$sms = '
				<div >
					<h4 id="'.$id.'" >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}

	$content = '<div class="row">
					<div id="add_org_cont" class="col-lg-6">
						
						<form role="form" >
							<label style="display:block" >Search:</label>
							<input class="form-control" onkeyup="del_act(this.value)" style="width:100%;" class="form-control input-sm" placeholder="Type the organizer name or representative name here to select the record to delete" aria-controls="dataTables-example" type="search" />
						</form><br /><br />
					
						<form method="POST" id="delete_html" action="Activities.php" role="form">
							
							'.$sms.'
							
							<div style="display:none;" >
								<label>Activity ID</label>
								<input readonly="true" name="del_act_id" class="form-control" value="'.$act_id.'" >
							</div>
							
							<div class="form-group">
								<label>Activity Name</label>
								<input name="del_act_name" value="'.$act_name.'" readonly="true" class="form-control" placeholder="None">
							</div>

							<div class="form-group">
								<label>Date</label>
								<input name="del_act_date" value="'.$act_date.'" readonly="true" class="form-control" type="text" placeholder="None">
							</div>
							
							<div class="form-group" >
								<label>Location</label>
								<textarea name="del_act_location" readonly="true" class="form-control" rows="3" placeholder="None" >'.$act_location.'
								</textarea>
							</div>                                        

							<div class="form-group">
								<label>Organizers Involved</label>
								<div class="form-group">        
									<!-- <select name="add_act_org" multiple class="form-control"> -->
									<textarea name="del_act_org" readonly="true" class="form-control" placeholder="None" >'.$act_org.'
									</textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label>Personnels Involved</label>
								<div class="form-group">                           
									<!-- <select name="add_act_staff" multiple class="form-control"> -->
									<textarea name="del_act_staff" readonly="true" class="form-control" placeholder="None" >'.$act_staff.'
									</textarea>
								</div>
							</div>
							
							<input type="submit" class="btn btn-default" id="del" value="Delete Activity" />
						</form>
					</div>
				   
				</div>';

	return $content;
}










?>