<?php
$loc="";
if(isset($_GET["loc"])){$loc=$_GET["loc"];}
?>

<div class="login-block">
	<div id='cssmenu_2'>
		<ul>
			<li class='active'><a href='index.php?loc=staff'>Personnel List</a></li>
			<li><a href='index.php?loc=staff_records'>Add Personnel</a></li>
		</ul>
	</div>

	 <div class="field" id="searchform">
		<input type="text" id="searchterm" onkeypress="showResult(this.value)" placeholder="Enter personnel name" />
		<input type="submit" value="Find!" onclick="showResult(document.getElementById('searchterm').value)" id="search" />
	</div>

	<div id="page-wrap">
    
		<img src="images/lukes_logo.png" alt="Luke's Foundation" id="pic" />
		
		<div id="contact-info" class="vcard">
		
			<!-- Microformats! -->
		
			<h2>Enter the personell's first, middle, or last name (only)</h2>
			<br /><br /><br /><br />
			
		</div>

    </div>

 </div>
</body>
<html>

