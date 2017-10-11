<?php
$loc="";
if(isset($_GET["loc"])){$loc=$_GET["loc"];}
?>

<div class="login-block">
	<div id='cssmenu_2'>
		<ul>
			<li class='active'><a href='#'>Personnel List</a></li>
			<li><a href='index.php?loc=staff_records'>Add Personnel</a></li>
		</ul>
	</div>

	 <div class="field" id="searchform">
		<input type="text" id="searchterm" placeholder="Enter personnel name" />
		<button type="button" id="search">Find!</button>
	</div>

	<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</div>

</body>
<html>
