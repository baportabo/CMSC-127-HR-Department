<?php
$fnc = "defs/fnc.php";
$main_h1 ='
	        <div id="page-wrapper">
			
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Organizers</h1>
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
	
	if(isset($_GET["delete"])){//searchbar
		$keyword = filter_var($_GET["delete"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		$sql = "SELECT * FROM organizer WHERE org_name LIKE '%".$keyword."%' OR rep_name LIKE '%".$keyword."%' ORDER BY org_name";
		$query=mysqli_query($con,$sql);
		
		$org_name = "";$rep_name = "";$rep_contact = "";
		$rep_email = "";$rep_addr = "";$org_id = "";
		
		
		if(mysqli_num_rows($query)>0){//needs to be >0
			$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$org_id = $row["org_id"];
			$org_name = $row["org_name"];
			$rep_name = $row["rep_name"];
			$rep_contact = $row["rep_contact"];
			$rep_email = $row["rep_email"];
			$rep_addr = $row["rep_address"];
		}else{
			$org_id = "";
			$org_name = "No record was found, try more keywords";
		}	
		
		
		echo '
					<div style="display:none;" >
						<label>Organization ID</label>
						<input readonly="true" name="delete_id" class="form-control" value="'.$org_id.'" >
					</div>
						
					<label>Organizer Name</label>
					<input name="delete_org_name" readonly="true" class="form-control" placeholder="Organizer Name" value="'.$org_name.'" >

					<br />
					<label>Representative Details:</label>
					
					<br />
					Name :<br />
					<input name="delete_rep_name" readonly="true" class="form-control" placeholder="Representative Name" value="'.$rep_name.'" >

					<br />
					Contact Number :<br />
					<input name="delete_rep_contact" readonly="true" class="form-control" placeholder="Contact Number" value="'.$rep_contact.'" >
					
					<br />
					Email :<br />
					<input name="delete_rep_email" readonly="true" class="form-control" type="email" placeholder="Email Address" value="'.$rep_email.'" >
					
					<br />
					Address:<br />
					<textarea name="delete_rep_addr" readonly="true" class="form-control" rows="3" placeholder="Address" >'.$rep_addr.'</textarea>
					
					<br />
					<input type="submit" class="btn btn-default" id="del" value="Delete this record" />
		';
		
	}
	elseif(isset($_POST["del_org_name"])&&isset($_POST["del_rep_name"])&&isset($_POST["del_rep_contact"])&&isset($_POST["del_rep_email"])&&isset($_POST["del_rep_addr"])){//FOR EDITING THE VALUES RECEIVNG FROM SEARCH
				//just sanitize them before passing for security reasons
		//note : org_id is not in the post due to security reasons
		$org_name = filter_var($_POST["del_org_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$rep_name = filter_var($_POST["del_rep_name"],FILTER_SANITIZE_SPECIAL_CHARS);		
		$rep_addr = filter_var($_POST["del_rep_addr"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(checker($_POST["del_rep_contact"],$_POST["del_rep_email"])){
		$rep_contact = $_POST["del_rep_contact"];
		$rep_email = $_POST["del_rep_email"];
		}
		else{
		$rep_contact = filter_var($_POST["del_rep_contact"], FILTER_SANITIZE_NUMBER_INT);
		$rep_email = filter_var($_POST["del_rep_email"],FILTER_SANITIZE_SPECIAL_CHARS);
		}
		
		
		$sql = "SELECT org_id FROM organizer WHERE org_name='".$org_name."' AND rep_name='".$rep_name."' AND rep_contact='".$rep_contact."' AND rep_email='".$rep_email."' AND rep_address='".$rep_addr."'";
		$query = mysqli_query($con,$sql);
		
		$org_id=-1;
		if(mysqli_num_rows($query)>0){
			$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$org_id=$row["org_id"];
			//$msg='<h4>The organizer&apos;s information was successfully loaded</h4>';
			$msg=null;
			$content = delete($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,null,$org_id);
		}
		else{
			$org_id=-1;
			$msg = '
				The record about the organizer that you are looking for cannot be found in the database, please try again
			';
			//$msg  =$org_name.":".$rep_name.":".$rep_contact.":".$rep_email .":".$rep_addr;
			$content = delete($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id);
		}
		
		//to load stuff
		$_POST["page"]="Organizer"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "delete";
		$subhead=ucwords($action)." organizers";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);
	
	
	
	}
	elseif(isset($_POST["delete_id"])&&isset($_POST["delete_org_name"])&&isset($_POST["delete_rep_name"])&&isset($_POST["delete_rep_contact"])&&isset($_POST["delete_rep_email"])&&isset($_POST["delete_rep_addr"])){//FOR EDITING THE VALUES
		$org_id = filter_var($_POST["delete_id"],FILTER_SANITIZE_NUMBER_INT);
		$org_name = filter_var($_POST["delete_org_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$rep_name = filter_var($_POST["delete_rep_name"],FILTER_SANITIZE_SPECIAL_CHARS);		
		$rep_contact = filter_var($_POST["delete_rep_contact"], FILTER_SANITIZE_NUMBER_INT);
		$rep_email = filter_var($_POST["delete_rep_email"],FILTER_SANITIZE_SPECIAL_CHARS);
		$rep_addr = filter_var($_POST["delete_rep_addr"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(strlen($org_name)==0){$org_name="None";}
		if(strlen($rep_name)==0){$rep_name="None";}
		if(strlen($rep_contact)==0){$rep_contact="None";}
		if(strlen($rep_email)==0){$rep_email="None";}
		if(strlen($rep_addr)==0){$rep_addr="None";}

		$val = true;
		$org_id_array = str_split($org_id);
			foreach($org_id_array as $digit){
				if(!is_numeric($digit)){
					$val = false;
					break;
				}
			}
		//note: you will only delete
		if($val){//means valid id, email, and contact
			
			$sql = "SELECT * FROM organizer	WHERE org_id='".$org_id."' ";
			$query=mysqli_query($con,$sql);
		
			if(mysqli_num_rows($query)>0){
				$sql = "DELETE FROM organizer WHERE org_id='".$org_id."' ";
				$query=mysqli_query($con,$sql);
				
				$sql = "SELECT * FROM organizer	WHERE org_id='".$org_id."' ";
				$query=mysqli_query($con,$sql);
				
				if(mysqli_num_rows($query)==0){
					$msg='The record about that organizer with this information exists and was deleted';
					$content = delete($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,false,$org_id);
				}
				else{
					$msg='The record about that organizer exists but cannot be deleted for some reason, please contact the system administrator to fix this';
					$content = delete($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id);
				}
			}
			else{
				$msg='The record about that organizer doesn&apos;t exist in the first place so there is nothing to delete';
				$content = delete($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id);
			}		
		}else{
			$msg = '	
					The organizer&apos;s record you entered is invalid<br />
					Please check your input by trying to search again the record before deleting then try again
				';
				
			$content = delete($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id);
		
		}
		$_POST["page"]="Organizer"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "delete";
		$subhead=ucwords($action)." organizers";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);
	
	
	}
	
	elseif(isset($_GET["edit"])){
		$keyword = filter_var($_GET["edit"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		$sql = "SELECT * FROM organizer WHERE org_name LIKE '%".$keyword."%' OR rep_name LIKE '%".$keyword."%' ORDER BY org_name";
		$query=mysqli_query($con,$sql);
		
		$org_name = "";$rep_name = "";$rep_contact = "";
		$rep_email = "";$rep_addr = "";$org_id = "";
		
		$readonly = 'readonly="true"';
		
		if(mysqli_num_rows($query)>0){//needs to be >0
			$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$org_id = $row["org_id"];
			$org_name = $row["org_name"];
			$rep_name = $row["rep_name"];
			$rep_contact = $row["rep_contact"];
			$rep_email = $row["rep_email"];
			$rep_addr = $row["rep_address"];
			$readonly = '';
		}else{
			$readonly = 'readonly="true"';
			$org_id = "";
			$org_name = "No record was found, try more keywords";
		}	
		
		
		echo '
			<div style="display:none;" >
						<label>Organization ID</label>
						<input readonly="true" name="edit_id" class="form-control" value="'.$org_id.'" >
					</div>
						
					<label>Organizer Name</label>
					<input name="edit_org_name" '.$readonly.' class="form-control" placeholder="Organizer Name" value="'.$org_name.'" >

					<br />
					<label>Representative Details:</label>
					
					<br />
					Name :<br />
					<input name="edit_rep_name" '.$readonly.' class="form-control" placeholder="Representative Name" value="'.$rep_name.'" >

					<br />
					Contact Number :<br />
					<input name="edit_rep_contact" '.$readonly.' class="form-control" placeholder="Contact Number" value="'.$rep_contact.'" >
					
					<br />
					Email :<br />
					<input name="edit_rep_email" '.$readonly.' class="form-control" type="email" placeholder="Email Address" value="'.$rep_email.'" >
					
					<br />
					Address:<br />
					<textarea name="edit_rep_addr" '.$readonly.' class="form-control" rows="3" placeholder="Address" >'.$rep_addr.'</textarea>
					
					<br />
					<input type="submit" class="btn btn-default" value="Save Changes" />		
		';
		
	}
	elseif(isset($_POST["ed_org_name"])&&isset($_POST["ed_rep_name"])&&isset($_POST["ed_rep_contact"])&&isset($_POST["ed_rep_email"])&&isset($_POST["ed_rep_addr"])){//FOR EDITING THE VALUES RECEIVNG FROM SEARCH
		//just sanitize them before passing for security reasons
		//note : org_id is not in the post due to security reasons
		$org_name = filter_var($_POST["ed_org_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$rep_name = filter_var($_POST["ed_rep_name"],FILTER_SANITIZE_SPECIAL_CHARS);		
		$rep_addr = filter_var($_POST["ed_rep_addr"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(checker($_POST["ed_rep_contact"],$_POST["ed_rep_email"])){
		$rep_contact = $_POST["ed_rep_contact"];
		$rep_email = $_POST["ed_rep_email"];
		}
		else{
		$rep_contact = filter_var($_POST["ed_rep_contact"], FILTER_SANITIZE_NUMBER_INT);
		$rep_email = filter_var($_POST["ed_rep_email"],FILTER_SANITIZE_SPECIAL_CHARS);
		}
		
		
		$sql = "SELECT org_id FROM organizer WHERE org_name='".$org_name."' AND rep_name='".$rep_name."' AND rep_contact='".$rep_contact."' AND rep_email='".$rep_email."' AND rep_address='".$rep_addr."'";
		$query = mysqli_query($con,$sql);
		
		$org_id=-1;
		if(mysqli_num_rows($query)>0){
			$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
			$org_id=$row["org_id"];
			//$msg='<h4>The organizer&apos;s information was successfully loaded</h4>';
			$msg=null;
			$content = edit($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,null,$org_id,false);
		}
		else{
			$org_id=-1;
			$msg = '
				The record about the organizer that you are looking for cannot be found in the database, please try again
			';
			//$msg  =$org_name.":".$rep_name.":".$rep_contact.":".$rep_email .":".$rep_addr;
			$content = edit($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id,true);
		}
		
		//to load stuff
		$_POST["page"]="Organizer"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "edit";
		$subhead=ucwords($action)." organizers";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);

	}
	elseif(isset($_POST["edit_id"])&&isset($_POST["edit_org_name"])&&isset($_POST["edit_rep_name"])&&isset($_POST["edit_rep_contact"])&&isset($_POST["edit_rep_email"])&&isset($_POST["edit_rep_addr"])){//FOR EDITING THE VALUES
		$org_id = filter_var($_POST["edit_id"],FILTER_SANITIZE_NUMBER_INT);
		$org_name = filter_var($_POST["edit_org_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		$rep_name = filter_var($_POST["edit_rep_name"],FILTER_SANITIZE_SPECIAL_CHARS);		
		$rep_contact = filter_var($_POST["edit_rep_contact"], FILTER_SANITIZE_NUMBER_INT);
		$rep_email = filter_var($_POST["edit_rep_email"],FILTER_SANITIZE_SPECIAL_CHARS);
		$rep_addr = filter_var($_POST["edit_rep_addr"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(strlen($org_name)==0){$org_name="None";}
		if(strlen($rep_name)==0){$rep_name="None";}
		if(strlen($rep_contact)==0){$rep_contact="None";}
		if(strlen($rep_email)==0){$rep_email="None";}
		if(strlen($rep_addr)==0){$rep_addr="None";}

		$val = true;
		$org_id_array = str_split($org_id);
			foreach($org_id_array as $digit){
				if(!is_numeric($digit)){
					$val = false;
					break;
				}
			}
		
		if(checker($rep_contact,$rep_email)&&$val){//means valid id, email, and contact
		$sql = "SELECT * FROM organizer WHERE org_id='".$org_id."'";
		$query = mysqli_query($con,$sql);
		
			if(mysqli_num_rows($query)>0){//record exist and can be edit
			
				$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
				$old_org_name = $row["org_name"];
			
				$sql = "UPDATE organizer SET org_name='".$org_name."', rep_name='".$rep_name."', rep_contact='".$rep_contact."', rep_email='".$rep_email."', rep_address='".$rep_addr."' WHERE org_id='".$org_id."' ";
				
				$query = mysqli_query($con,$sql);
				
				$sql = "SELECT * FROM organizer WHERE org_id='".$org_id."' AND org_name='".$org_name."'	AND rep_name='".$rep_name."' AND rep_contact='".$rep_contact."' AND	rep_email='".$rep_email."' AND rep_address='".$rep_addr."'";
				
				$query = mysqli_query($con,$sql);
				
				if(mysqli_num_rows($query)>0){//success editing
					$msg = '	
						The organizer named <strong><em>'.$old_org_name.'</em></strong> has this new values now :
					';
					$content = edit($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,false,$org_id,true);
				}
				else{
					$msg = '	
						All inputs where valid but somehow the changes are not saved, please contact the system administrator to fix this
					';
					$content = edit($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id,false);
				}
				
			
			}else{
				$msg = '	
					The organizer that you are trying to edit doesn&apos;t exist, someone might have changed it before you do, please try searching again for the organizer
				';
				$content = edit($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id,false);
			}
		
		
		}else{
			$msg = '	
					The organizer&apos;s record you entered contains invalid input<br />
							This might be : 
							<ul>
								<li>Representative&apos;s contact number</li>
								<li>Representative&apos;s email address</li>
							</ul>
							Please check your input, or try to search again the record before editing then try again
				';
				
			$content = edit($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true,$org_id,false);
		
		}
		$_POST["page"]="Organizer"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "edit";
		$subhead=ucwords($action)." organizers";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);
	}
	
	elseif(isset($_GET["search"])){//for search bar case
		$limit = 30; //default
		if(isset($_GET["limit"])){$limit=filter_var($_GET["limit"],FILTER_SANITIZE_NUMBER_INT);if($limit==""){$limit=0;}if($limit>30){$limit=30;}}
		$keyword = filter_var($_GET["search"],FILTER_SANITIZE_SPECIAL_CHARS);
		$sql = "SELECT * FROM organizer WHERE org_name LIKE '%".$keyword."%' OR rep_name LIKE '%".$keyword."%' ORDER BY org_name";
		$query=mysqli_query($con,$sql);
		
		if(mysqli_num_rows($query)>0&&mysqli_num_rows($query)<=$limit){
		$i=0;
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
			echo	'<tr class="gradeX">
					<td>'.$row["org_name"].'</td>
					<td>'.$row["rep_name"].'</td>
					<td class="center">'.$row["rep_contact"].'</td>
					<td class="center">'.$row["rep_email"].'</td>
					<td class="center">'.$row["rep_address"].'</td>
					<td>
						<form method="POST" action="Organizer.php" >
							<input class="hide" name="ed_org_name" type="text" value="'.$row["org_name"].'" />
							<input class="hide" name="ed_rep_name" type="text" value="'.$row["rep_name"].'" />
							<input class="hide" name="ed_rep_contact" type="text" value="'.$row["rep_contact"].'" />
							<input class="hide" name="ed_rep_email" type="text" value="'.$row["rep_email"].'" />
							<input class="hide" name="ed_rep_addr" type="text" value="'.$row["rep_address"].'" />
							<input id="org_btn" class="btn btn-default" type="submit" value="Edit" />
						</form>
						<form method="POST" action="Organizer.php" >
							<input class="hide" name="del_org_name" type="text" value="'.$row["org_name"].'" />
							<input class="hide" name="del_rep_name" type="text" value="'.$row["rep_name"].'" />
							<input class="hide" name="del_rep_contact" type="text" value="'.$row["rep_contact"].'" />
							<input class="hide" name="del_rep_email" type="text" value="'.$row["rep_email"].'" />
							<input class="hide" name="del_rep_addr" type="text" value="'.$row["rep_address"].'" />
							<input id="org_btn" class="btn btn-default" type="submit" value="Delete" />
						</form>
					</td>
				</tr>';
					$i++;
			}
			echo	'<tr class="gradeX">
					<td colspan="6" style="text-align:center;" > Total entries displayed : '.$i.'</td>
					</tr>';
		}
		elseif(mysqli_num_rows($query)==0){
			echo	'<tr class="gradeX">
						<td colspan="6" style="text-align:center;" > No results found, please try another keyword and make sure that <em><strong>Javascript</strong></em> is enabled </td>
					</tr>';
		}elseif(mysqli_num_rows($query)>$limit){
			echo	'<tr class="gradeX">
						<td colspan="6" style="text-align:left;margin-left:20px;" > 
							<strong>A result was found but too many to display</strong>
							<br /><br />
							Tips : 
							<ol>
								<li>Try adding more keywords in the search to limit the results to display</li>
								<li>Increasing the maximum records to display (current limit is '.$limit.')</li>
								<li>Try typing again the keyword and check for misspelled words</li>
							</ol>
						</td>
					</tr>';
		}
	}
	elseif(isset($_POST["org_name"])){
		$org_name = filter_var($_POST["org_name"],FILTER_SANITIZE_SPECIAL_CHARS);
		
		$rep_name="None";$rep_contact="None";$rep_email="None";$rep_addr="None";
		
		if(isset($_POST["rep_name"])&&strlen($_POST["rep_name"])>0){$rep_name = filter_var($_POST["rep_name"],FILTER_SANITIZE_SPECIAL_CHARS);}
		
		if(isset($_POST["rep_contact"])&&strlen($_POST["rep_contact"])>0){$rep_contact = filter_var($_POST["rep_contact"], FILTER_SANITIZE_NUMBER_INT);}
		
		if(isset($_POST["rep_email"])&&strlen($_POST["rep_email"])>0){$rep_email = filter_var($_POST["rep_email"],FILTER_SANITIZE_SPECIAL_CHARS);}
		
		if(isset($_POST["red_addr"])&&strlen($_POST["rep_addr"])>0){$rep_addr = filter_var($_POST["rep_addr"],FILTER_SANITIZE_SPECIAL_CHARS);}
		
			
		$sql="SELECT * FROM organizer WHERE org_name='".$org_name."'";
		$query=mysqli_query($con,$sql);
		if(mysqli_num_rows($query)==0){//this means this new org is not already in the db

			if(checker($rep_contact,$rep_email)&&strlen($org_name)){//valid email and contact //error checking

				//adding record
				$sql = "INSERT INTO organizer (org_id, org_name, rep_name, rep_contact, rep_email, rep_address) VALUES (NULL, '".$org_name."', '".$rep_name."', '".$rep_contact."', '".$rep_email."', '".$rep_addr."')";
				$query=mysqli_query($con,$sql);
			
				//verifying if the record is added
				$sql = "SELECT * FROM organizer WHERE org_name='".$org_name."' AND rep_name='".$rep_name."' AND rep_contact='".$rep_contact."' AND rep_email='".$rep_email."' AND rep_address='".$rep_addr."'";
				$query=mysqli_query($con,$sql);
				
				if(mysqli_num_rows($query)>0){

					$msg = '	
							The organizer&s record with this information is added to the database : <br />
							Organizer Name : '.$org_name.'<br />
							Representative&apos;s Name : '.$rep_name.'<br />
							Representative&apos;s Contact Number : '.$rep_contact.'<br />
							Representative&apos;s Email Address : '.$rep_email.'<br />
							Representative&apos;s Adress :'.$rep_addr.'
						';
						
					$content = add($con,null,null,null,null,null,$msg,false);
				}else{
					$msg = '	
							The organizer&apos;s record you entered contains valid input but cannot be added for some reason<br />
							Contact your system administrator to fix this.
						';
						
					$content = add($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true);
				}
			}else{
				$msg = '	
							The organizer&apos;s record you entered contains invalid input<br />
							This might be : 
							<ul>
								<li>Organizer&apos;s name is invalid</li>
								<li>Representative&apos;s contact number</li>
								<li>Representative&apos;s email address</li>
							</ul>
							Please check your input then try again
						';
						
					$content = add($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true);
			}
			
		}else{
				$msg = '
						The organizer with the name &apos;'.$org_name.'&apos; already exist <br />
						If you are trying to edit a record, go to <a href="Organizer.php?action=edit">Edit Organizer</a> instead<br />
						If this is a mistake, please try again with the correct organizer name
						';
				$content = add($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true);
		}
		
		$_POST["page"]="Organizer"; //set page title and other functionalities using this
		require($head);
		require($nav);
		$action = "add";
		$subhead=ucwords($action)." organizers";
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		require($foot);
	}
	else{
		$_POST["page"]="Organizer"; //set page title and other functionalities using this
		require($head);
		require($nav);
		
		//note just edit main since this contains the main part
		$action = "search organizers";
		$act_true = isset($_GET["action"]);
		
		$content = "";
		$subhead = "Organizers";
		$valid_act = false;
		
			if($act_true){
				$action=filter_var($_GET["action"],FILTER_SANITIZE_SPECIAL_CHARS);
				if($action==="search"){$content = search($con);$valid_act=true;}
				elseif($action==="edit"){$content = edit($con,null,null,null,null,null,null,null,null,true);$valid_act=true;}
				elseif($action==="delete"){$content = delete($con,null,null,null,null,null,null,null,null,true);$valid_act=true;}
				elseif($action==="add"){$content = add($con,null,null,null,null,null,null,null);$valid_act=true;}
				else{header("location:index.php?missing_page=true");}
			}
			else{
				$content = search($con);
			}
		if($act_true&&$valid_act){$subhead=ucwords($action)." organizers";}
		//ucwords() uppercases the first letter of a word
		echo $main_h1 . $subhead . $main_h2 . $content . $main_l;
		echo "</div>"; //this is to end the div wrapper in nav.php
		
		require($foot);
	}
	mysqli_close($con);
}
else{die("Error : The website is missing a critical file, contact system administrator");}

function search($con){
	$content_h='
			<div class="row">
				
					<div class="col-sm-6">
						<div onmouseup="showResult(document.getElementById('."'search_bar_orgs'".').value)" class="dataTables_length" id="dataTables-example_length">
							<label style="width:10%margin-right:10px;" >Show entries : </label>
								<select id="limit_org_records" style="width:15%;" name="dataTables-example_length" aria-controls="dataTables-example" class="form-control input-sm">
									<option value="1">1</option>
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option selected="selected" value="30">30</option>
								</select> 
						</div>
					</div>
					
					
					<div class="col-sm-6"  >
						<div id="dataTables-example_filter" class="dataTables_filter" style="width:100%;" >
							<label style="width:10%margin-right:20px;" >Search:</label>
							<input id="search_bar_orgs" onkeyup="showResult(this.value)" style="width:85%;" class="form-control input-sm" placeholder="Type the organizer name or representative name here" aria-controls="dataTables-example" type="search" />
						</div>
					</div>
					
			</div>
			
			<br style="clear:both;" />
			<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>Organizer Name</th>
						<th>Representative&apos;s Name</th>
						<th>Representative&apos;s Contact</th>
						<th>Representative&apos;s Email</th>
						<th>Organizer&apos;s Address</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="org_records_table" >
					<!--ACTUAL DATA HERE-->
					';
					
					
	$content_l='
					<!--END OF ACTUAL DATA-->
				</tbody>
			</table>
			</div>
			<!--
			<div class="row">
				<div class="col-sm-6">
					<div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
						Showing 1 to 2 of 2 entries
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate" >
						<ul class="pagination">
							<li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous">
								<a href="#">Previous</a>
							</li>
							
							<li class="paginate_button active" aria-controls="dataTables-example" tabindex="0">
								<a href="#">1</a>
							</li>
							
							<li class="paginate_button next disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">
								<a href="#">Next</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			-->
			
			';
			
			/*
			<tr class="odd gradeX">
				<td>XYZ62</td>
				<td>Frank Industries</td>
				<td>09170001997</td>
				<td class="center">Sec.Tony Stark</td>
				<td class="center">iamironman@fmail.com</td>
				<td class="center">n/a</td>
			</tr>
			
			<tr class="gradeX">
				<td>AWP123</td>
				<td>SK Gaming</td>
				<td>09234478789</td>
				<td class="center">Coldzera</td>
				<td class="center">absolutezera@gmail.com</td>
				<td>n/a</td>
			</tr>
			*/
	$data = "";
	
		$sql = "SELECT * FROM organizer ORDER BY org_name";
		$query=mysqli_query($con,$sql);
		$limit=30;
		
		if(mysqli_num_rows($query)>0&&mysqli_num_rows($query)<=$limit){
			$i = 0;
			while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
			$data = $data . 
				'<tr class="gradeX">
					<td>'.$row["org_name"].'</td>
					<td>'.$row["rep_name"].'</td>
					<td class="center">'.$row["rep_contact"].'</td>
					<td class="center">'.$row["rep_email"].'</td>
					<td class="center">'.$row["rep_address"].'</td>
					<td>
						<form method="POST" action="Organizer.php" >
							<input class="hide" name="ed_org_name" type="text" value="'.$row["org_name"].'" />
							<input class="hide" name="ed_rep_name" type="text" value="'.$row["rep_name"].'" />
							<input class="hide" name="ed_rep_contact" type="text" value="'.$row["rep_contact"].'" />
							<input class="hide" name="ed_rep_email" type="text" value="'.$row["rep_email"].'" />
							<input class="hide" name="ed_rep_addr" type="text" value="'.$row["rep_address"].'" />
							<input id="org_btn" class="btn btn-default" type="submit" value="Edit" />
						</form>
						<form method="POST" action="Organizer.php" >
							<input class="hide" name="del_org_name" type="text" value="'.$row["org_name"].'" />
							<input class="hide" name="del_rep_name" type="text" value="'.$row["rep_name"].'" />
							<input class="hide" name="del_rep_contact" type="text" value="'.$row["rep_contact"].'" />
							<input class="hide" name="del_rep_email" type="text" value="'.$row["rep_email"].'" />
							<input class="hide" name="del_rep_addr" type="text" value="'.$row["rep_address"].'" />
							<input id="org_btn" class="btn btn-default" type="submit" value="Delete" />
						</form>
					</td>
				</tr>';
			$i++;
			}
			$data = $data . 
					'<tr class="gradeX">
					<td colspan="6" style="text-align:center;" > Total entries displayed : '.$i.'</td>
					</tr>';
		}
		elseif(mysqli_num_rows($query)==0){
			$data = '<tr class="gradeX">
					<td colspan="6" style="text-align:center;" > No results found, there are no organizations registered to the database </td>
					</tr>';
		}elseif(mysqli_num_rows($query)>$limit){
			$data = '<tr class="gradeX">
					<td colspan="6" style="text-align:center;" > 
						This means that there are a lot of entries in the database (more than 10 entries)<br />
						We suggest that you	start typing the name of the organizer you are looking for in the search bar to narrow the results<br />
						You can also try searching for the name of the representative of the organizer that you are looking for<br />
						You also need to make sure that your browser enable&apos;s <strong><em>Javascript</em></strong> for the search bar to work
					</td>
					</tr>';
					
			/*
				THIS IS FOR SEARCH LATER
				$data = '<tr class="gradeX">
					<td colspan="4" style="text-align:center;" > A result was found but too many to display, try adding more keywords in the search to limit the results to display</td>
					<td>n/a</td>
					</tr>';
			*/
		}
			
			
	$content = $content_h . $data . $content_l;
	return $content;
}

function edit($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,$is_error,$org_id,$readonly){
	//note: prefix : ed_
	$sms = "";
	$er_msg="The organizer&apos;s information was successfully changed";
	$read = 'readonly="true"';
	
	if(!$readonly){$read = '';}
	
	if($msg!=null){
		$id = "success_msg";
		if($is_error){$id='error_msg';$er_msg="Error with trying to edit an organizer";}
		$sms = '
				<div >
					<h4 id="'.$id.'" >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}
	
	$content ='
			<div class="row">
				<div id="add_org_cont" class="col-lg-6">
					
					<form role="form" >
						<label style="display:block" >Search:</label>
						<input class="form-control" onkeyup="edit(this.value)" style="width:100%;" class="form-control input-sm" placeholder="Type the organizer name or representative name here to select the record to edit" aria-controls="dataTables-example" type="search" />
					</form>
					
					<br /><br />
				
					<form id="edit_html" role="form" method="POST" action="Organizer.php" >
					
						'.$sms.'
						
						<div style="display:none;" >
							<label>Organization ID</label>
							<input readonly="true" name="edit_id" class="form-control" value="'.$org_id.'" >
						</div>
							
						<label>Organizer Name</label>
						<input name="edit_org_name" '.$read.' class="form-control" placeholder="Organizer Name" value="'.$org_name.'" >

						<br />
						<label>Representative Details:</label>
						
						<br />
						Name :<br />
						<input name="edit_rep_name" '.$read.' class="form-control" placeholder="Representative Name" value="'.$rep_name.'" >

						<br />
						Contact Number :<br />
						<input name="edit_rep_contact" '.$read.' class="form-control" placeholder="Contact Number" value="'.$rep_contact.'" >
						
						<br />
						Email :<br />
						<input name="edit_rep_email" '.$read.' class="form-control" type="email" placeholder="Email Address" value="'.$rep_email.'" >
						
						<br />
						Address:<br />
						<textarea name="edit_rep_addr" '.$read.' class="form-control" rows="3" placeholder="Address" >'.$rep_addr.'</textarea>
						
						<br />
						<input type="submit" class="btn btn-default" value="Save Changes" />
					</form>
				</div>
			   
			</div>
	
	';
	return $content;
}

function delete($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,$is_error,$org_id){

//note: prefix : del_
	$sms = "";
	$er_msg="The organizer&apos;s information was successfully deleted";
		
	if($msg!=null){
		$id = "success_msg";
		if($is_error){$id='error_msg';$er_msg="Error with trying to delete an organizer";}
		$sms = '
				<div >
					<h4 id="'.$id.'" >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}
	
	$content ='
			<div class="row">
				<div id="add_org_cont" class="col-lg-6">
					
					<form role="form" >
						<label style="display:block" >Search:</label>
						<input class="form-control" onkeyup="del(this.value)" style="width:100%;" class="form-control input-sm" placeholder="Type the organizer name or representative name here to select the record to delete" aria-controls="dataTables-example" type="search" />
					</form>
					
					<br /><br />
				
					<form id="delete_html" role="form" method="POST" action="Organizer.php" >
					
						'.$sms.'
						
						<div style="display:none;" >
							<label>Organization ID</label>
							<input readonly="true" name="delete_id" class="form-control" value="'.$org_id.'" >
						</div>
							
						<label>Organizer Name</label>
						<input name="delete_org_name" readonly="true" class="form-control" placeholder="Organizer Name" value="'.$org_name.'" >

						<br />
						<label>Representative Details:</label>
						
						<br />
						Name :<br />
						<input name="delete_rep_name" readonly="true" class="form-control" placeholder="Representative Name" value="'.$rep_name.'" >

						<br />
						Contact Number :<br />
						<input name="delete_rep_contact" readonly="true" class="form-control" placeholder="Contact Number" value="'.$rep_contact.'" >
						
						<br />
						Email :<br />
						<input name="delete_rep_email" readonly="true" class="form-control" type="email" placeholder="Email Address" value="'.$rep_email.'" >
						
						<br />
						Address:<br />
						<textarea name="delete_rep_addr" readonly="true" class="form-control" rows="3" placeholder="Address" >'.$rep_addr.'</textarea>
						
						<br />
						<input type="submit" class="btn btn-default" id="del" value="Delete Organizer" />
					</form>
				</div>
			   
			</div>
	
	';
	return $content;

}

function add($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,$is_error){
	$sms = "";
	$er_msg="The organizer was successfully added";
	
	$org_name=str_replace("None","",$org_name);
	$rep_name=str_replace("None","",$rep_name);
	$rep_contact=str_replace("None","",$rep_contact);
	$rep_email=str_replace("None","",$rep_email);
	$rep_addr=str_replace("None","",$rep_addr);
	
	
	if($msg!=null){
		$id = "success_msg";
		if($is_error){$id='error_msg';$er_msg="Error with trying to add an organizer";}
		$sms = '
				<div >
					<h4 id="'.$id.'" >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}
	
	$content = '<div class="row">
					<div id="add_org_cont" class="col-lg-6">
						<form id="add_org" role="form" method="POST" action="Organizer.php" >
							
							<div>
								'.$sms.'
								<!--
								<h4>Note : </h4>
									<h5>All specials characters are automatically removed while adding records to the database</h5>
									<h5>If an entry is optional and your input is invalid it will not be added to the organizations&apos;s record, go to <a href="Organizer.php?action=edit" >Edit Organizers</a> if you want to fix this</h5>
								<br /><br />
								-->
								
								<label>Organizer Name</label>
								<input name="org_name" class="form-control" type="text" placeholder="Enter the organizer&apos;s name (Required)" value="'.$org_name.'" >
								
								<br />
								
								<label>Representative Details (Optional)</label>
								<br />
									Name : <br />
									<input name="rep_name" class="form-control" type="text" placeholder="Enter name of representative (Optional)" value="'.$rep_name.'" >
								<br />
									Contact Number: <br />
									<input name="rep_contact" class="form-control" type="text" placeholder="i.e. 09099730701 (Optional)" value="'.$rep_contact.'" >
								<br />
									Email : <br />
									<input name="rep_email" class="form-control" type="email" placeholder="i.e. juandelacruz@up.edu.ph (Optional)" value="'.$rep_email.'" >
								<br />
									Address : <br />
									<textarea name="rep_addr" placeholder="i.e. Cabinet Hill, Baguio City (Optional)" class="form-control" rows="3" >'.$rep_addr.'</textarea>
							</div>
							<br style="clear:both;" />
							<input type="submit" class="btn btn-default" value="Add Organizer" />
							<button type="reset" class="btn btn-default">Reset Values</button>
						</form>
					</div>
				   
				</div>';
	return $content;
}

function checker($rep_contact,$rep_email){
	$val = true;

		if($rep_contact!="None"){
			$rep_contact_array = str_split($rep_contact);
			foreach($rep_contact_array as $digit){
				if(!is_numeric($digit)){
					$val = false;
					break;
				}
			}
			if(strlen($rep_contact)!=11){$val=false;}
		}
		
		
		if($rep_email!="None"&&$val){$val = filter_var($rep_email, FILTER_VALIDATE_EMAIL);}//only do this when the val is still true

	return $val;
}


?>