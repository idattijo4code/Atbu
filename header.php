<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<header>
		<nav>
			<div class="container">
				<div class="wrapper">
					<h1><strong>A.T.B.U</strong>&nbsp;&nbsp;&nbsp;Department Of Electrical<br /> and Electronics  Engineering</h1>
					<ul>
	<li><a href="index.php"<?php if (basename($_SERVER['SCRIPT_NAME'])=="index.php"){ ?> class="current"<?php }?>>HOME</a></li>
<li><a href="academics.php"<?php if (basename($_SERVER['SCRIPT_NAME'])=="academics.php"){?> class="current"<?php }?>>ACADEMICS </a></l><li><a href="staff.php"<?php if (basename($_SERVER['SCRIPT_NAME'])=="staff.php") { ?> class="current"<?php }?>>STAFF</a></li>
<li><a href="news_list.php"<?php if (basename($_SERVER['SCRIPT_NAME'])=="news_list.php") { ?> class="current"<?php }?>>News & Events</a></li>
						<li><a href="contact.php"<?php if (basename($_SERVER['SCRIPT_NAME'])=="contact.php") { ?> class="current"<?php }?>>CONTACT US</a></li>
                        					</ul>
                                           
				</div>
			</div>
		</nav>
		<section class="adv-content">
			<div class="container">
				<ul class="breadcrumbs">
                <?php if (basename($_SERVER['SCRIPT_NAME'])=="index.php"){ ?> <li>Home</li> 
				<?php }elseif (basename($_SERVER['SCRIPT_NAME'])=="view_profile.php"){ ?><li>Staff Profile</li>
                <?php }elseif (basename($_SERVER['SCRIPT_NAME'])=="news_list.php"){?><li>News & Events</li>
                <?php }elseif (basename($_SERVER['SCRIPT_NAME'])=="staff.php"){ ?>	<li>Staff List</li>
                <?php }elseif (basename($_SERVER['SCRIPT_NAME'])=="academics.php"){  ?><li>Academics</li>
                <?php }elseif (basename($_SERVER['SCRIPT_NAME'])=="nonacad_insert.php"){  ?><li>Add Non Academic/Technical Staff</li>
                <?php }elseif (basename($_SERVER['SCRIPT_NAME'])=="staff_profile.php"){  ?><li>Staff Profile</li>
                <?php }elseif (basename($_SERVER['SCRIPT_NAME'])=="contact.php"){  ?><li>Contact Us</li>
                <?php }?>
				</ul>
                
				<?php if (!isset($_SESSION['MM_Username'])) { ?>
                                            <h3><a href="login.php" class="more logtext">Login Here</a></h3>
                                            <?php } else { ?>
                                            <h4 class="logtext"><a href="staff_profile.php">Welcome:</a> <br />
                         <span><a href="staff_profile.php">My Profile</a></span> 
                         <span style="color:#FFF; font-weight: bold;">|</span> 
                         <span class="more"><a href="logout.php">Logout</a></span></h4>
                                            <?php } ?>
			</div>
		</section>
	</header>