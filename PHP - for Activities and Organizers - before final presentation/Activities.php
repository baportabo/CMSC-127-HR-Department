<?php
$fnc = "defs/fnc.php";
$calendar_file = "defs/calendar.php";
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
	
	if(isset($_GET["ed_keyword"])){//searchbar delete fnc
		$keyword = filter_var($_GET["ed_keyword"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		$sql = "SELECT * FROM activity_list WHERE activity LIKE '%".$keyword."%' ";
		$query=mysqli_query($con,$sql);
		
		$act_name = "None";$act_date = "None";$act_location = "None";
		$act_org = "None";$act_staff = "None";
		$is_readonly=true;
		
		if(mysqli_num_rows($query)>0){//needs to be more than 0
			$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$act_id = $row["id"];
			$act_name = $row["activity"];
			$act_date = $row["date"];
			$act_location = $row["location"];
			$act_org = str_replace("","",$row["organizer_id"]);
			$act_staff = $row["staff_id"];
			$is_readonly=false;
		}else{
			$act_id = "";
			$act_name = "No record was found, try more keywords";
		}	
	
		$content = edit($con,$act_name,$act_date,$act_location,$act_org,$act_staff,null,null,$act_id,false,$is_readonly);
		
		echo $content;
		
	
	}
	elseif(isset($_POST["edit_act_id"])&&isset($_POST["edit_act_name"])&&isset($_POST["edit_act_date"])){
	
		//&&isset($_POST["edit_act_location"])&&isset($_POST["edit_act_org"])&&isset($_POST["edit_act_staff"])
		
		$act_id = filter_var($_POST["edit_act_id"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_name = filter_var($_POST["edit_act_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_date = filter_var($_POST["edit_act_date"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(isset($_POST["edit_act_location"])){$act_location = filter_var($_POST["edit_act_location"],FILTER_SANITIZE_SPECIAL_CHARS);}
		else{$act_location="None";}
		
		if(isset($_POST["edit_act_org"])){$post_org = $_POST["edit_act_org"];}
		else{$post_org=array("None");}
		
		if(isset($_POST["edit_act_staff"])){$post_staff = $_POST["edit_act_staff"];}
		else{$post_staff=array("None");}
		
		if(strlen($act_location)==0){$act_location="None";}
	
		/*Original //single values
		$act_org = filter_var($_POST["add_act_org"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_staff = filter_var($_POST["add_act_staff"],FILTER_SANITIZE_SPECIAL_CHARS);
		*/
		$act_org="";
		$act_staff="";
		
		//just to load multiples into single line
		foreach($post_org as $org){//for multiples
			$data = filter_var($org,FILTER_SANITIZE_SPECIAL_CHARS);
			$sql = "SELECT * FROM organizer WHERE org_name='".$data."'";
			$query = mysqli_query($con,$sql);
			
			if((sizeof($post_org)==1&&$org=="None")){$act_org = "None";}
			elseif(mysqli_num_rows($query)>0){
				if($org!="None"&&$act_org!=""){$act_org = $data.",\n\r".$act_org;}
				elseif($org!="None"&&$act_org==""){$act_org = $data;}
			}
		}
		 foreach($post_staff as $staff){//for multiples
			$data = filter_var($staff,FILTER_SANITIZE_SPECIAL_CHARS);
			$name = explode(" ", $data); //separate a string into pieces
			if(sizeof($name)==3){
				$sql = "SELECT * FROM staff WHERE first_name='".$name[0]."' AND middle_name='".$name[1]."' AND last_name='".$name[2]."'";
				$query = mysqli_query($con,$sql);
				
				if(sizeof($post_staff)==1&&$staff=="None"){$act_staff = "None";}
				elseif(mysqli_num_rows($query)>0){
					if($staff!="None"&&$act_staff!=""){$act_staff = $data.",\n\r".$act_staff;}
					elseif($staff!="None"&&$act_staff==""){$act_staff = $data;}
				}
			}
		}
		
		if(strlen($act_org)==0){$act_org="None";}
		if(strlen($act_staff)==0){$act_staff="None";}
		
		//NOTE TO EDIT : organizer_id and staff_id should be ids but for now settle for stuff
		
		//checking for existence phase
		$sql = "SELECT * FROM activity_list WHERE id='".$act_id."'";
		$query=mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)>0&&strlen($act_name)>0&&strlen($act_date)>0){//means one activity with this info exist and has a valid name and date
				//adding phase
					$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
					$old_act_name=$row["activity"];
				
					//"UPDATE organizer SET org_name='".$org_name."', rep_name='".$rep_name."', rep_position='".$rep_pos."', rep_contact='".$rep_contact."', rep_email='".$rep_email."', rep_address='".$rep_addr."' WHERE org_id='".$org_id."' ";
					$sql = "UPDATE activity_list SET activity='".$act_name."', date='".$act_date."', location='".$act_location."', organizer_id='".$act_org."', staff_id='".$act_staff."' 
					WHERE id='".$act_id."'";
					$query=mysqli_query($con,$sql);
					
					$sql = "SELECT * FROM activity_list WHERE id='".$act_id."' AND activity='".$act_name."' AND date='".$act_date."' AND location='".$act_location."' AND organizer_id='".$act_org."' AND staff_id='".$act_staff."'";
					$query=mysqli_query($con,$sql);
					
					if(mysqli_num_rows($query)>0){//check for success
						$msg = '	
							The activity named <strong>'.$old_act_name.'</strong> contains this new values now in the database : <br /><br />
							<strong>Activity Name :</strong> '.$act_name.'<br />
							<strong>Date :</strong> '.$act_date.' [format (24h) : yyyy-mm-dd T hh:mm]<br />
							<strong>Location :</strong> '.$act_location.'<br /><br />
							<strong>Organizers involved :</strong> <br />'.$act_org.'<br /><br />
							<strong>Staff involved :</strong> <br />'.$act_staff.'
						';
						//edit($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$act_id,$show_search_bar,$is_readonly)
						$is_error=false;
						$content=edit($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$act_id,true,true);
					}else{
						$msg = 'All inputs are valid but the activity was not added for some reason,this might be due to an invalid activity date or the record was changed before you do so please try again. If the problem still occurs, please contact the system administrator to fix this';
						$is_error=true;
						$content=edit($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$act_id,true,false);
					}
					
					
			}else{
				$msg = 'Invalid activity name or date, please enter a valid activity name and date and check if that activity name doesn&apos;t exist already in the database';
				$is_error=true;
				$content=edit($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$act_id,true,false);
			}
			
		$_POST["page"]="Activities"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "edit";
		$subhead=ucwords($action)." activities";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);
	}
	
	elseif(isset($_GET["s_act_name"])){
		$content="";
	
		$act_name=filter_var($_GET["s_act_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_date="None";
		$act_location="None";
		$act_org="None";
		$act_staff="None";
		
		$sql = "SELECT * FROM activity_list WHERE activity LIKE '%".$act_name."%'";
		$query = mysqli_query($con,$sql);
		
		if(mysqli_num_rows($query)>0){
			$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$act_name = $row["activity"];
			$act_date = $row["date"];
			$act_location = $row["location"];
			$act_org = str_replace("","",$row["organizer_id"]);
			$act_staff = $row["staff_id"];
			$content=search($act_name,$act_date,$act_location,$act_org,$act_staff,null,null,false);
		}else{
			$act_name="No record was found, try for more keywords";
			$content=search($act_name,$act_date,$act_location,$act_org,$act_staff,null,null,false);
		}
		
		//$msg
		//$is_error
		echo $content;
	}
	
	elseif(isset($_GET["m_y"])){//choosing calendar date
		//$split = strtok($string," ")			split $string by spaces
		
		if(!file_exists($calendar_file)){die("<h2>Cannot generate the calendar due to missing files please contact system administrator to fix this</h2>");}
		
		$date=filter_var($_GET["m_y"],FILTER_SANITIZE_SPECIAL_CHARS);
		require($calendar_file);
		$month="";$year="";
		$end_month=false;$val=true;
		
		$date_str = str_split($date);
		foreach($date_str as $letter){
			if(!$end_month){
				if($letter!=" "){$month.=$letter;}
				else{$end_month=true;}
			}else{
				if(is_numeric($letter)){$year.=$letter;}
				else{$val=false;break;}
			}
		}

		$x = DateTime::createFromFormat('M', $month);
		if(!$x){$val=false;}//die($month . ' is not a valid month');
		//echo $month, 'is month number ', $x->format('n'), PHP_EOL;
		
		if($val)//this first val is for manual input (text)
			{
				$calendar = '<h2 style="text-align:center;" >'.$month.' '.$year.'</h2>';
				$calendar = $calendar . draw_calendar($x->format('n'),$year,$con);
				
				echo $calendar;
				//echo $month."::".$year."::".$date."::".sizeof($date);
			}
		else{
			$month="";$year="";
			$end_yr=false;$val=true;
			
			for($i=0;$i<strlen($date);$i++){
				if(is_numeric($date[$i])){
					if(!$end_yr){$year.=$date[$i];}
					else{$month.=$date[$i];}
				}
				else{if($date[$i]=="-"){$end_yr=true;}else{$val=false;break;}}
			}
			
			if($month<1||$month>12){$val=false;}
			$dateObj   = DateTime::createFromFormat('!m', $month);
			$monthName = $dateObj->format('F'); // March
			
			//echo $month."::".$year."::".$date;
			
			if($val)//this is for the thingy with input=month support
				{
					$calendar = '<h2 style="text-align:center;" >'.$monthName.' '.$year.'</h2>';
					$calendar = $calendar . draw_calendar($month,$year,$con);
					
					echo $calendar;
				}
			else{
				die("<h2>Invalid input, please try again</h2>");
			}
		}
	
	}
	
	elseif(isset($_GET["delete"])){//searchbar delete fnc
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
			$act_org = str_replace("","",$row["organizer_id"]);
			$act_staff = $row["staff_id"];
		}else{
			$act_id = "";
			$act_name = "No record was found, try more keywords";
		}	
	
		$content = del($act_name,$act_date,$act_location,$act_org,$act_staff,null,null,$act_id,false);
		
		echo $content;
		
	
	}
	elseif(isset($_POST["del_act_id"])&&isset($_POST["del_act_name"])&&isset($_POST["del_act_date"])&&isset($_POST["del_act_location"])&&isset($_POST["del_act_org"])&&isset($_POST["del_act_staff"])){
		$act_id = filter_var($_POST["del_act_id"],FILTER_SANITIZE_NUMBER_INT);
		$act_name = filter_var($_POST["del_act_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_date = filter_var($_POST["del_act_date"],FILTER_SANITIZE_SPECIAL_CHARS);		
		$act_location = filter_var($_POST["del_act_location"], FILTER_SANITIZE_SPECIAL_CHARS);
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
				  //SELECT * FROM activity_list	WHERE id='7' AND activity='tatabellass' AND date='2017-10-26' AND location='qweqeq' AND organizer_id='None' AND staff_id='None'
			$sql = "SELECT * FROM activity_list	WHERE id='".$act_id."' AND activity='".$act_name."' AND date='".$act_date."' AND location='".$act_location."' AND organizer_id='".$act_org."' AND staff_id='".$act_staff."'";
			$query=mysqli_query($con,$sql);
		
			if(mysqli_num_rows($query)>0){
				$sql = "DELETE FROM activity_list WHERE id='".$act_id."' AND activity='".$act_name."' AND date='".$act_date."' AND location='".$act_location."' AND organizer_id='".$act_org."' AND staff_id='".$act_staff."'";
				$query=mysqli_query($con,$sql);
				
				$sql = "SELECT * FROM activity_list	WHERE id='".$act_id."' AND activity='".$act_name."' AND date='".$act_date."' AND location='".$act_location."' AND organizer_id='".$act_org."' AND staff_id='".$act_staff."'";
				$query=mysqli_query($con,$sql);
				
				if(mysqli_num_rows($query)==0){
					$msg='The record about the organizer with this information exists and was deleted';
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
	
	elseif(isset($_POST["add_act_name"])&&isset($_POST["add_act_date"])){
		$act_name = filter_var($_POST["add_act_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_date = filter_var($_POST["add_act_date"],FILTER_SANITIZE_SPECIAL_CHARS); //not effective
		
		if(isset($_POST["add_act_location"])){$act_location = filter_var($_POST["add_act_location"],FILTER_SANITIZE_SPECIAL_CHARS);}
		else{$act_location="None";}
		
		if(isset($_POST["add_act_org"])){$post_org = $_POST["add_act_org"];}
		else{$post_org=array("None");}
		
		if(isset($_POST["add_act_staff"])){$post_staff = $_POST["add_act_staff"];}
		else{$post_staff=array("None");}
	
		if(strlen($act_location)==0){$act_location="None";}

		/*Original //single values
		$act_org = filter_var($_POST["add_act_org"],FILTER_SANITIZE_SPECIAL_CHARS);
		$act_staff = filter_var($_POST["add_act_staff"],FILTER_SANITIZE_SPECIAL_CHARS);
		*/
		$act_org="";
		$act_staff="";
		
		//just to load multiples into single line
		foreach($post_org as $org){//for multiples
			$data = filter_var($org,FILTER_SANITIZE_SPECIAL_CHARS);
			$sql = "SELECT * FROM organizer WHERE org_name='".$data."'";
			$query = mysqli_query($con,$sql);
			
			if((sizeof($post_org)==1&&$org=="None")){$act_org = "None";}
			elseif(mysqli_num_rows($query)>0){
				if($org!="None"&&$act_org!=""){$act_org = $data.",\n\r".$act_org;}
				elseif($org!="None"&&$act_org==""){$act_org = $data;}
			}
		}
		 foreach($post_staff as $staff){//for multiples
			$data = filter_var($staff,FILTER_SANITIZE_SPECIAL_CHARS);
			$name = explode(" ", $data); //separate a string into pieces
			if(sizeof($name)==3){
				$sql = "SELECT * FROM staff WHERE first_name='".$name[0]."' AND middle_name='".$name[1]."' AND last_name='".$name[2]."'";
				$query = mysqli_query($con,$sql);
				
				if(sizeof($post_staff)==1&&$staff=="None"){$act_staff = "None";}
				elseif(mysqli_num_rows($query)>0){
					if($staff!="None"&&$act_staff!=""){$act_staff = $data.",\n\r".$act_staff;}
					elseif($staff!="None"&&$act_staff==""){$act_staff = $data;}
				}
			}
		}
		
		if(strlen($act_org)==0){$act_org="None";}
		if(strlen($act_staff)==0){$act_staff="None";}
		
		//NOTE TO EDIT : organizer_id and staff_id should be ids but for now settle for stuff
		
		//checking for existence phase
		$sql = "SELECT * FROM activity_list WHERE activity='".$act_name."'";
		$query=mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)==0&&strlen($act_name)>0&&strlen($act_date)>0){//means no activity name with this info is here
				//adding phase
					$sql = "INSERT INTO activity_list (id, activity, date, location, organizer_id, staff_id) 
					VALUES (NULL, '".$act_name."', '".$act_date."', '".$act_location."', '".$act_org."', '".$act_staff."')";
					$query=mysqli_query($con,$sql);
					
					$sql = "SELECT * FROM activity_list WHERE activity='".$act_name."' AND date='".$act_date."' 
					AND location='".$act_location."' AND organizer_id='".$act_org."' AND staff_id='".$act_staff."' " ;
					$query=mysqli_query($con,$sql);
					
					if(mysqli_num_rows($query)>0){//check for success
						$msg = '	
							The activity record with this information is added to the database : <br /><br />
							<strong>Activity Name :</strong> '.$act_name.'<br />
							<strong>Date :</strong> '.$act_date.' [format (24h) : yyyy-mm-dd T hh:mm]<br />
							<strong>Location :</strong> '.$act_location.'<br /><br />
							<strong>Organizers involved :</strong> <br />'.$act_org.'<br /><br />
							<strong>Staff involved :</strong> <br />'.$act_staff.'
						';
						$content=add($con,null,null,null,null,null,$msg,false);
					}else{
						$msg = 'All inputs are valid but the activity was not added for some reason,this might be due to an invalid activity date so please try again. If the problem still occurs, please contact the system administrator to fix this';
						$content=add($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,true);
					}
					
					
			}else{
				$msg = 'Invalid activity name or date, please enter a valid activity name and date then check if that activity name doesn&apos;t exist already in the database';
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
					if($action==="calendar"){$content = calendar($con,getdate());$valid_act=true;}
					elseif($action==="search"){
						if(isset($_GET["act_name"])){
							$act_name=filter_var($_GET["act_name"],FILTER_SANITIZE_SPECIAL_CHARS);
								$sql = "SELECT * FROM activity_list WHERE activity LIKE '%".$act_name."%'";
								$query = mysqli_query($con,$sql);
							if(mysqli_num_rows($query)>0){
								$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
								$act_name = $row["activity"];
								$act_date = $row["date"];
								$act_location = $row["location"];
								$act_org = str_replace("","",$row["organizer_id"]);
								$act_staff = $row["staff_id"];
								$content=search($act_name,$act_date,$act_location,$act_org,$act_staff,null,null,true);
							}else{
								$act_name="No record was found, try for more keywords";
								$content=search($act_name,$act_date,$act_location,$act_org,$act_staff,null,null,true);
							}
						}else{
							$content = search(null,null,null,null,null,null,null,true);
						}
						$valid_act=true;
					}
					elseif($action==="edit"){$content = edit($con,null,null,null,null,null,null,null,null,true,true);$valid_act=true;}
					elseif($action==="delete"){$content = del(null,null,null,null,null,null,null,null,true);$valid_act=true;}
					elseif($action==="add"){$content = add($con,null,null,null,null,null,null,null);$valid_act=true;}
					else{header("location:index.php?missing_page=true");}
				}
				else{
					$content = calendar($con,getdate());$valid_act=true;
				}
			//special case heads
			if($action=="calendar"){$action="Calendar of";}
			
			if($act_true&&$valid_act){$subhead=ucwords($action)." Activities";}
			//ucwords() uppercases the first letter of a word
			echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
			echo "</div>"; //this is to end the div wrapper in nav.php
			
			require($foot);
	}
	
	mysqli_close($con);
	
}
else{die("Error : The website is missing a ciritcal file, contact system administrator");}

function calendar($con,$date){
$calendar = '<h2 style="padding-left:20px;" >The calendar cannot be found, please contact system administrator to fix this</h2>';

$calendar_file = "defs/calendar.php";
if(file_exists($calendar_file)){
	require($calendar_file);
	$calendar = '<h2 style="text-align:center;" >'.$date["month"].' '.$date["year"].'</h2>';
	$calendar = $calendar . draw_calendar($date["mon"],$date["year"],$con);
}

$content_h = '	<div class="row" style="padding:10px;" >

					<div class="col-sm-4">
						<div class="dataTables_length" id="dataTables-example_length">
							<label>Choose/Enter month and year to show : </label><br />
							<input id="m_y" class="form-control" style="display:inline;width:70%;" type="month" name="c_year" onchange="calendar(this.value)" onclick="calendar(this.value)" placeholder="e.g. January 2013" />
							<input onclick="calendar(document.getElementById('."'m_y'".').value)" style="display:inline;width:20%" type="button" class="btn btn-default" value="Go" />
						</div>
					</div>
				</div>
				
				<div id="calendar_html" >
';

$content_l = '	<div>';
			
			
	$content = $content_h . $calendar . $content_l;
	return $content;

}

function search($act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$show_search_bar){
	$sms = "";
	$er_msg="The information about the activity was loaded";
	
	if($act_name==null){$act_name="None";}
	if($act_date==null){$act_date="None";}
	if($act_location==null){$act_location="None";}
	if($act_org==null){$act_org="None";}
	if($act_staff==null){$act_staff="None";}
	
	
	if($msg!=null){
		$id = "success_msg";
		if($is_error){$id='error_msg';$er_msg="Error with trying to search for an activity";}
		$sms = '
				<div >
					<h4 id="'.$id.'" >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}
	
	$s_bar='
						<form role="form" >
							<label style="display:block" >Search:</label>
							<input class="form-control" onkeyup="activity_search(this.value)" style="width:100%;" class="form-control input-sm" placeholder="Type the name of the activity you want to search" aria-controls="dataTables-example" type="search" />
						</form><br /><br />
	';
	
	if(!$show_search_bar){$s_bar="";}
	
	//date("g:i a",strtotime($act_date))
	if($act_date!="None"){
		$act_date = date("M d Y g:i a",strtotime($act_date));
	}
	
	$content = '<div class="row">
					<div id="add_org_cont" class="col-lg-6">
						
						'.$s_bar.'
					
						<div id="act_search_html" >
							
							'.$sms.'
														
							<div class="form-group">
								<label>Activity Name</label>
								<input value="'.$act_name.'" readonly class="form-control" placeholder="None">
							</div>

							<div class="form-group">
								<label>Date</label>
								<input value="'.$act_date.'" readonly class="form-control" type="text" placeholder="None">
							</div>
							
							<div class="form-group" >
								<label>Location</label>
								<textarea readonly class="form-control" rows="3" placeholder="None" >'.$act_location.'</textarea>
							</div>                                        

							<div class="form-group">
								<label>Organizers Involved</label>
								<div class="form-group">        
									<!-- <select name="add_act_org" multiple class="form-control"> -->
									<textarea id="a_textarea" readonly class="form-control" placeholder="None" >'.$act_org.'</textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label>Personnels Involved</label>
								<div class="form-group">                           
									<!-- <select name="add_act_staff" multiple class="form-control"> -->
									<textarea id="a_textarea" readonly class="form-control" placeholder="None" >'.$act_staff.'</textarea>
								</div>
							</div>

						</div>
					</div>
				   
				</div>';

	return $content;
}

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
								<input name="add_act_name" value="'.$act_name.'" class="form-control" placeholder="Enter the activity&apos;s name (Required)" required />
							</div>

							<div class="form-group">
								<label>Date</label>
								<input name="add_act_date" value="'.$act_date.'" class="form-control" type="datetime-local" placeholder="Enter the date of the activity (yyyy-mm-dd hh:mm:ss)(24 hour format)(Required)" required />
							</div>
							
							<div class="form-group">
								<label>Location</label>
								<textarea name="add_act_location" value="'.$act_location.'" class="form-control" rows="3" placeholder="i.e. Cabinet Hill, Baguio City (Optional)"></textarea>
							</div>                                        

							<div class="form-group">
								<label>Organizers Involved (Can select multiple, selecting the &quot;None&quot; option on multiple select discards &quot;None&quot; together with invalid inputs)</label>
								<div class="form-group">        
									<!-- <select name="add_act_org" multiple class="form-control"> -->
									<select id="a_textarea" name="add_act_org[]" multiple class="form-control">';

$content_l1=				'</select>
								</div>
							</div>
							
							<div class="form-group">
								<label>Personnels Involved (Can select multiple, selecting the &quot;None&quot; option on multiple select discards &quot;None&quot; together with invalid inputs)</label>
								<div class="form-group">                           
									<!-- <select name="add_act_staff" multiple class="form-control"> -->
									<select id="a_textarea" name="add_act_staff[]" multiple class="form-control">';
								  
$content_l2 = '					  </select>
								</div>
							</div>
							
							<input type="submit" class="btn btn-default" value="Add Activity" />
							<input type="reset" class="btn btn-default" value="Reset Values" />
						</form>
					</div>
				   
				</div>';
$orgs="<option selected value='None'>None</option>";
	
$staff="<option selected value='None'>None</option>";
			
			/////////////////STAFF////////////
			
			$sql = "SELECT * FROM staff ORDER BY first_name";
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

function del($act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$act_id,$show_search_bar){
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

	$s_bar='
						<form role="form" >
							<label style="display:block" >Search:</label>
							<input class="form-control" onkeyup="del_act(this.value)" style="width:100%;" class="form-control input-sm" placeholder="Type the activity name here to select the record to delete" aria-controls="dataTables-example" type="search" />
						</form><br /><br />
	';
	
	if(!$show_search_bar){$s_bar="";}
	
	$content = '<div class="row">
					<div id="add_org_cont" class="col-lg-6">
						
						'.$s_bar.'
					
						<form method="POST" id="delete_html" action="Activities.php" role="form">
							
							'.$sms.'
							
							<div style="display:none;" >
								<label>Activity ID</label>
								<input readonly name="del_act_id" class="form-control" value="'.$act_id.'" />
							</div>
							
							<div class="form-group">
								<label>Activity Name</label>
								<input name="del_act_name" value="'.$act_name.'" readonly class="form-control" placeholder="None" />
							</div>

							<div class="form-group">
								<label>Date</label>
								<input name="del_act_date" value="'.$act_date.'" readonly class="form-control" type="text" placeholder="None" />
							</div>
							
							<div class="form-group" >
								<label>Location</label>
								<textarea name="del_act_location" readonly class="form-control" rows="3" placeholder="None" >'.$act_location.'</textarea>
							</div>                                        

							<div class="form-group">
								<label>Organizers Involved</label>
								<div class="form-group">        
									<!-- <select name="add_act_org" multiple class="form-control"> -->
									<textarea name="del_act_org" readonly class="form-control" placeholder="None" >'.$act_org.'</textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label>Personnels Involved</label>
								<div class="form-group">                           
									<!-- <select name="add_act_staff" multiple class="form-control"> -->
									<textarea name="del_act_staff" readonly class="form-control" placeholder="None" >'.$act_staff.'</textarea>
								</div>
							</div>
							
							<input type="submit" class="btn btn-default" id="del" value="Delete Activity" />
						</form>
					</div>
				   
				</div>';

	return $content;
}

function edit($con,$act_name,$act_date,$act_location,$act_org,$act_staff,$msg,$is_error,$act_id,$show_search_bar,$is_readonly){

$sms = "";
	$er_msg="The activity was successfully changed";
	
	if($act_name==null){$act_name="None";}
	if($act_date==null){$act_date="None";}
	if($act_location==null){$act_location="None";}
	if($act_org==null){$act_org="None";}
	if($act_staff==null){$act_staff="None";}
	
	
	if($msg!=null){
		$id = "success_msg";
		if($is_error){$id='error_msg';$er_msg="Error with trying to edit an activity";}
		$sms = '
				<div >
					<h4 id="'.$id.'" >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}

	$s_bar='
						<form role="form" >
							<label style="display:block" >Search:</label>
							<input class="form-control" onkeyup="edit_act(this.value)" style="width:100%;" class="form-control input-sm" placeholder="Type the activity name here to select the record to edit" aria-controls="dataTables-example" type="search" />
						</form><br /><br />
	';
	
	$readonly="readonly";
	
	if(!$show_search_bar){$s_bar="";}
	if(!$is_readonly){$readonly="";}
	
	//$act_date = "2017-11-11 T 14:56:00";
	
	$content_h = '<div class="row">
					<div id="add_org_cont" class="col-lg-6">
						
						'.$s_bar.'
					
						<form method="POST" id="edit_html" action="Activities.php" role="form">
							
							'.$sms.'
							
							<div style="display:none;" >
								<label>Activity ID</label>
								<input readonly name="edit_act_id" class="form-control" value="'.$act_id.'" />
							</div>
							
							<div class="form-group">
								<label>Activity Name</label>
								<input name="edit_act_name" value="'.$act_name.'" '.$readonly.' class="form-control" placeholder="None" required />
							</div>

							<div class="form-group">
								<label style="margin-right:10px;" >Date</label>[format (24h) : yyyy-mm-dd hh:mm:ss]
								<input name="edit_act_date" value="'.$act_date.'" '.$readonly.' class="form-control" type="text" placeholder="None" required />
							</div>
							
							<div class="form-group" >
								<label>Location</label>
								<textarea name="edit_act_location" '.$readonly.' class="form-control" rows="3" placeholder="None" >'.$act_location.'</textarea>
							</div>                                        

							<div class="form-group">
								<label>Organizers Involved (Can select multiple, selecting the &quot;None&quot; option on multiple select discards &quot;None&quot; together with invalid inputs)</label>
								<div class="form-group">        
									<select id="a_textarea" '.$readonly.' name="edit_act_org[]" multiple class="form-control">';

$content_l1=				'</select>
								</div>
							</div>
							
							<div class="form-group">
								<label>Personnels Involved (Can select multiple, selecting the &quot;None&quot; option on multiple select discards &quot;None&quot; together with invalid inputs)</label>
								<div class="form-group">                           
									<select id="a_textarea" '.$readonly.' name="edit_act_staff[]" multiple class="form-control">';
								  
$content_l2 = '					  </select>
								</div>
							</div>
							
							<input type="submit" class="btn btn-default" value="Save Changes" />
						</form>
					</div>
				   
				</div>';
				
				
		$orgs="";
		$staff="";
			
			/////////////////STAFF////////////
			$org_list="";
			$staff_list="";
			
			$sql = "SELECT * FROM activity_list WHERE id='".$act_id."'";
			$query = mysqli_query($con,$sql);
			if(mysqli_num_rows($query)>0){
				$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
				$org_list=$row["organizer_id"];
				$staff_list=$row["staff_id"];
			}
			
			$sql = "SELECT * FROM staff ORDER BY first_name";
			$query = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)>0){
				//strchr(string,search)
				if(strlen(strchr($staff_list,"None"))>0){$staff.="<option selected value='None'>None</option>";}
				else{$staff.="<option value='None'>None</option>";}
				
				while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
					$selected = "";
					$fullname=$row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
					if(strlen(strchr($staff_list,$fullname))>0){$selected="selected";}
					$staff = $staff."<option ".$selected." value='".$fullname."' >".$fullname."</option>";
				}
			}else{
				$staff = '<option value="None" > organizers available</option>';
			}
			
			//if($act_staff!=null){$staff="<option value='".$act_staff."' >".$act_staff."</option>";}
			
			/////////////////ORGS/////////////
			
			$sql = "SELECT * FROM organizer ORDER BY org_name";
			$query = mysqli_query($con,$sql);
			
			if(mysqli_num_rows($query)>0){
				if(strlen(strchr($org_list,"None"))>0){$orgs.="<option selected value='None'>None</option>";}
				else{$orgs.="<option value='None'>None</option>";}
			
				while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
					$selected = "";
					if(strlen(strchr($org_list,$row["org_name"]))>0){$selected="selected";}
					$orgs = $orgs."<option ".$selected." value='".$row["org_name"]."' >".$row["org_name"]."</option>";
				}
			}else{
				$orgs = '<option value="None" > organizers available</option>';
			}
			
			//if($act_org!=null){$org="<option value='".$act_org."' >".$act_org."</option>";}
			
			
			
	$content = $content_h . $orgs . $content_l1 . $staff . $content_l2;
	return $content;
}








?>