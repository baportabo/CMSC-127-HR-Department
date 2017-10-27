<?php
$page = "#";
$page_val = isset($_POST["page"]);
$record = "";
if($page_val){
	$page = filter_var($_POST["page"],FILTER_SANITIZE_SPECIAL_CHARS);
	if($page==="Organizer"){$record=$page."s";}//OC
	else{$record=$page;}//for others
}
// $age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");

//THIS PART IS FOR DYNAMIC PAGES
$links = array("Organizer","Activities","Personnel","Attendance");

?>
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
						<?php
						$link_page="#";
						foreach ($links as $link) {
							$link_page="#";
							if($page_val){$link_page=$link.".php";}
							
							if($link!=$page){
								echo '
								<li class="divider"></li><li><a href="'.$link_page.'"><div><i class="fa fa-book fa-fw"></i>'.$link.'</div></a></li>
								';
							}
						} 
						?>
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
                            <a href="<?php echo $page; ?>.php?action=search"><i class="fa fa-search fa-fw"></i> Search <?php echo $record; ?></a>
                        </li>
						<li>
							<a href="<?php echo $page; ?>.php?action=edit"><i class="fa fa-edit fa-fw"></i> Edit <?php echo $record; ?></a>
						</li>
						<li>
							<a href="<?php echo $page; ?>.php?action=delete"><i class="fa fa-trash-o fa-fw"></i> Delete <?php echo $record; ?></span></a>
						</li>
						<li>
							<a href="<?php echo $page; ?>.php?action=add"><i class="fa fa-plus-circle fa-fw"></i> Add <?php echo $record; ?></a>
						</li>
					  
					</ul>
				</div>
			</div>
			
        </nav>
		