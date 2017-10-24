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
							<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
						<!--CHANGE STARTS HERE-->
        ';
						
$main_l ='
							</div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
';
if(file_exists($fnc)){
	require($fnc);
	if(isset($_GET["search"])){//for search bar case
		$limit = 10; //default
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
							<input class="org_btn" type="submit" value="Edit" />
						</form>
						<form method="POST" action="Organizer.php" >
							<input class="hide" name="del_org_name" type="text" value="'.$row["org_name"].'" />
							<input class="hide" name="del_rep_name" type="text" value="'.$row["rep_name"].'" />
							<input class="hide" name="del_rep_contact" type="text" value="'.$row["rep_contact"].'" />
							<input class="hide" name="del_rep_email" type="text" value="'.$row["rep_email"].'" />
							<input class="hide" name="del_rep_addr" type="text" value="'.$row["rep_address"].'" />
							<input class="org_btn" type="submit" value="Delete" />
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
		
		//error checking
		$val_email = filter_var($rep_email, FILTER_VALIDATE_EMAIL);
		$val_contact = true;
		
		$rep_contact_array = str_split($rep_contact);
		
		foreach($rep_contact_array as $digit){
			if(!is_numeric($digit)){
				$val_contact = false;
				break;
			}
		}
		
		if(strlen($rep_contact)!=11){$val_contact=false;}
			
		$sql="SELECT * FROM organizer WHERE org_name='".$org_name."'";
		$query=mysqli_query($con,$sql);
		if(mysqli_num_rows($query)==0){//this means this new org is not already in the db

			if($val_email&&$val_contact){//valid email and contact
			
				//adding record
				$sql = "INSERT INTO organizer (org_id, org_name, rep_name, rep_contact, rep_email, rep_address) VALUES (NULL, '".$org_name."', '".$rep_name."', '".$rep_contact."', '".$rep_email."', '".$rep_addr."')";
				$query=mysqli_query($con,$sql);
			
				//verifying if the record is added
				$sql = "SELECT * FROM organizer WHERE org_name='".$org_name."' AND rep_name='".$rep_name."' AND rep_contact='".$rep_contact."' AND rep_email='".$rep_email."' AND rep_address='".$rep_addr."'";
				$query=mysqli_query($con,$sql);
				
				if(mysqli_num_rows($query)>0){

					$msg = '	
							The organizer&s record with this information is added to the database : <br />
							Organization Name : '.$org_name.'<br />
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
								<li>Representative&apos;s contact number</li>
								<li>Representative&apos;s email address</li>
							</ul>
							Please check your input then try again
						';
						
					$content = add($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,true);
			}
			
		}else{
				$msg = '
						The organization with the name &apos;'.$org_name.'&apos; already exist <br />
						If you are trying to edit a record, go to <a href="Organizer.php?action=edit">Edit Organizer</a> instead<br />
						If this is a mistake, please try again with the correct organization name
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
				elseif($action==="edit"){$content = edit($con);$valid_act=true;}
				elseif($action==="delete"){$content = delete($con);$valid_act=true;}
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
		mysqli_close($con);
	}
}
else{die("Error : The website is missing a critical file, contact system administrator");}

function search($con){
	$content_h='
			<div class="row">
				
					<div class="col-sm-6">
						<div onmouseup="showResult(document.getElementById('."'search_bar_orgs'".').value)" class="dataTables_length" id="dataTables-example_length">
							Show entries : 
								<select id="limit_org_records" style="width:15%;" name="dataTables-example_length" aria-controls="dataTables-example" class="form-control input-sm">
									<option value="1">1</option>
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
								</select> 
						</div>
					</div>
					
					
					<div class="col-sm-6" style="float:right;" >
						<div id="dataTables-example_filter" class="dataTables_filter" style="width:100%;" >
							Search:<input id="search_bar_orgs" onkeyup="showResult(this.value)" style="width:70%;margin-left:10px;" class="form-control input-sm" placeholder="Type the organization name or representative name here" aria-controls="dataTables-example" type="search" />
						</div>
					</div>
					
			</div>
			
			<br style="clear:both;" />
			
			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>Organization Name</th>
						<th>Representative&apos;s Name</th>
						<th>Representative&apos;s Contact</th>
						<th>Representative&apos;s Email</th>
						<th>Organization&apos;s Address</th>
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
		
		if(mysqli_num_rows($query)>0&&mysqli_num_rows($query)<=10){
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
							<input class="org_btn" type="submit" value="Edit" />
						</form>
						<form method="POST" action="Organizer.php" >
							<input class="hide" name="del_org_name" type="text" value="'.$row["org_name"].'" />
							<input class="hide" name="del_rep_name" type="text" value="'.$row["rep_name"].'" />
							<input class="hide" name="del_rep_contact" type="text" value="'.$row["rep_contact"].'" />
							<input class="hide" name="del_rep_email" type="text" value="'.$row["rep_email"].'" />
							<input class="hide" name="del_rep_addr" type="text" value="'.$row["rep_address"].'" />
							<input class="org_btn" type="submit" value="Delete" />
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
		}elseif(mysqli_num_rows($query)>10){
			$data = '<tr class="gradeX">
					<td colspan="6" style="text-align:center;" > 
						This means that there are a lot of entries in the database (more than 10 entries)<br />
						We suggest that you	start typing the name of the organization you are looking for in the search bar to narrow the results<br />
						You can also try searching for the name of the representative of the organization that you are looking for<br />
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

function edit($con){
}

function delete($con){
}

function add($con,$org_name,$rep_name,$rep_contact,$rep_email,$rep_addr,$msg,$is_error){
	$sms = "";
	$er_msg="The organization was successfully added";
	
	$org_name=str_replace("None","",$org_name);
	$rep_name=str_replace("None","",$rep_name);
	$rep_contact=str_replace("None","",$rep_contact);
	$rep_email=str_replace("None","",$rep_email);
	$rep_addr=str_replace("None","",$rep_addr);
	
	
	if($msg!=null){
		$id = "";
		if($is_error){$id='id="error_msg"';$er_msg="Error with trying to add an organization";}
		$sms = '
				<div >
					<h4 '.$id.' >'.$er_msg.'</h4>
					<h5 style="padding-left:20px;" >'.$msg.'</h5>
				<br /><br />
				</div>';
	}
	$content = '<div class="row">
					<div id="add_org_cont" class="col-lg-6">
						<form id="add_org" role="form" method="POST" action="Organizer.php" >
							
							<div>
								'.$sms.'
								
								<h4>Note : </h4>
									<h5>All specials characters are automatically removed while adding records to the database</h5>
									<h5>If an entry is optional and your input is invalid it will not be added to the organizations&apos;s record, go to <a href="Organizer.php?action=edit" >Edit Organizers</a> if you want to fix this</h5>
								<br /><br />
								
								<label>Organization Name</label>
								<input name="org_name" class="form-control" type="text" placeholder="Enter the organization&apos;s name (Required)" value="'.$org_name.'" >
								
								<br /><br /><br />
								
								<label>Representative Details (Optional)</label>
								<br /><br />
									Name : <br />
									<input name="rep_name" class="form-control" type="text" placeholder="Enter name of representative (Optional)" value="'.$rep_name.'" >
								<br /><br />
									Contact : <br />
									<input name="rep_contact" class="form-control" type="text" placeholder="Enter contact number (Optional)" value="'.$rep_contact.'" >
								<br /><br />
									Email : <br />
									<input name="rep_email" class="form-control" type="email" placeholder="i.e. juandelacruz@up.edu.ph (Optional)" value="'.$rep_email.'" >
								<br /><br />
									Address : <br />
									<textarea name="rep_addr" placeholder="i.e. Cabinet Hill, Baguio City (Optional)" class="form-control" rows="3" >'.$rep_addr.'</textarea>
							</div>
							<br style="clear:both;" /><br />
							<input type="submit" class="btn btn-default" value="Add Organization" />
							<button type="reset" class="btn btn-default">Reset Values</button>
						</form>
					</div>
				   
				</div>';

	return $content;
}




?>