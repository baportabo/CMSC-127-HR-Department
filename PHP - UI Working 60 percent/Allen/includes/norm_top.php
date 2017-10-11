<?php
$loc="";
if(isset($_GET["loc"])){$loc=$_GET["loc"];}
?>
<!doctype html>
<html lang=''>
<head>
<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<style>

 * { margin: 0; padding: 0; }
        .clear { clear: both; }
        #page-wrap { width: 800px; margin: 40px auto 60px; }
        #pic { float: right; margin: -50px 0 0 0; }
        h1 { margin: 0 0 16px 0; padding: 0 0 16px 0; font-size: 42px; font-weight: bold; letter-spacing: -2px; border-bottom: 1px solid #999; }
        h2 { font-size: 20px; margin: 0 0 6px 0; position: relative; }
        h2 span { position: absolute; bottom: 0; right: 0; font-style: italic; font-family: Georgia, Serif; font-size: 16px; color: #999; font-weight: normal; }
        p { margin: 0 0 16px 0; }
        a { color: #999; text-decoration: none; border-bottom: 1px dotted #999; }
        a:hover { border-bottom-style: solid; color: black; }
        ul { margin: 0 0 32px 17px; }
        #objective { width: 500px; float: left; }
        #objective p { font-family: Georgia, Serif; font-style: italic; color: #666; }
        dt { font-style: italic; font-weight: bold; font-size: 18px; text-align: right; padding: 0 26px 0 0; width: 150px; float: left; height: 100px; border-right: 1px solid #999;  }
        dd { width: 600px; float: right; }
        dd.clear { float: none; margin: 0; height: 15px; }


 


.field {
  display:flex;
  position:realtive;
  margin:5em auto;
  width:70%;
  flex-direction:row;
  box-shadow:
   1px 1px 0 rgb(22, 160, 133),
   2px 2px 0 rgb(22, 160, 133),
   3px 3px 0 rgb(22, 160, 133),
   4px 4px 0 rgb(22, 160, 133),
   5px 5px 0 rgb(22, 160, 133),
   6px 6px 0 rgb(22, 160, 133),
   7px 7px 0 rgb(22, 160, 133)
  ;
}

.field>input[type=text],
.field>#search {
  display:block;
  font:1.2em 'Montserrat Alternates';
}

.field>input[type=text] {
  flex:1;
  padding:0.6em;
  border:0.2em solid rgb(26, 188, 156);
}

.field>#search {
  padding:0.6em 0.8em;
  background-color:rgb(26, 188, 156);
  color:white;
  border:none;
}









.login-block {
    width: 1020px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 10px solid #47c9af; /* BORDER TOP */

    margin-left:14.5%;
    margin-top:5%;
}

body{
background:#B2FCE8;
}
</style>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <script src="search_bar.js"></script>
   <title>
		<?php
			if(strlen(strstr($loc,"org"))){echo "Organizations";}
			elseif(strlen(strstr($loc,"act"))){echo "Activities";}
			elseif(strlen(strstr($loc,"staff"))){echo "Personell";}
			elseif(strlen(strstr($loc,"attendance"))){echo "Attendance";}
			else{echo "Home";}
		?>
   </title>
</head>
<body>



<div id='cssmenu'>
      <ul>	<!--put class='active'-->
			<li <?php if($loc===""){echo "class='active'";}?> ><a href="index.php" >Home</a></li>
			<li <?php if($loc==="org"){echo "class='active'";}?> ><a href="index.php?loc=org" >Organizer</a></li>
			<li <?php if($loc==="act"){echo "class='active'";}?> ><a href="index.php?loc=act" >Activities</a></li>
			<li <?php if($loc==="staff"||$loc==="staff_records"){echo "class='active'";}?> ><a href="index.php?loc=staff" >Personnel</a></li>
			<li <?php if($loc==="attendance"){echo "class='active'";}?> ><a href="index.php?loc=attendance" >Attendance</a></li>

			<li style="float:right"><a href="home.html">Logout</a></li>
      </ul>
</div>