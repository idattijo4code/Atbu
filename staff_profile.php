<?php require_once('Connections/atbu_ee.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!isset($_SESSION)) {
	session_start();
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$user = $_SESSION['user_id'];

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_staff = "SELECT * FROM staff WHERE user_id='$user'";
$staff = mysql_query($query_staff, $atbu_ee) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);



mysql_select_db($database_atbu_ee, $atbu_ee);
$query_login = "SELECT * FROM login WHERE user_id = '$user'";
$login = mysql_query($query_login, $atbu_ee) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);
	 


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP: STAFF PROFILE</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/jquery-ui-1.8.5.custom.css" type="text/css" media="all">
	<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.5.custom.min.js"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
</head>

<body>

	<div><?php require("header.php"); ?></div>
	<section id="content">
     <?php if ($row_login['staff_category']==3) { 
	
	 mysql_select_db($database_atbu_ee, $atbu_ee);
$query_academic = "SELECT * FROM academic_staff WHERE user_id = '$row_staff[user_id]'";
$academic = mysql_query($query_academic, $atbu_ee) or die(mysql_error());
$row_academic = mysql_fetch_assoc($academic);
$totalRows_academic = mysql_num_rows($academic);
	if ($totalRows_academic > 0) {
	 ?>
		<div class="top"> 
			<div class="container">
           
				<div class="clearfix">
                
					<div class="grid9 first">
                    
						<h3><?php echo ucfirst($row_staff['surname']." ".$row_staff['othername']); ?></h3>
							<div class="img-box">
							<figure><img src="images/3page-img1.jpg" alt="" width="169" height="172"></figure>
							<p><h2><?php echo ucfirst($row_staff['title']." ".$row_staff['surname']." ".$row_staff['othername']); ?></h2>
                            		<div><strong><?php echo $row_academic['rank']; ?></strong></div>
                          <?php echo $row_academic['biography'] ?>
                            </p>
						</div>
					
						<!--<a href="#" class="more">Read More</a>-->
					</div>
					<div class="grid3">
                    <div class="wrapper">
                    <div>
							<dl class="departments">
								<dt>Contact Information:</dt>
								<dd><span>Office Address:</span><?php echo $row_academic['office']; ?></dd>				
                                <dd><span>Office Phone:</span><?php echo $row_academic['phone']; ?></dd>
                                <dd><span>E-mail:</span><a href="#"><?php echo $row_academic['email']; ?></a></dd>
								
								<dt>Primary Teaching Area:</dt>
								<span><?php echo ucfirst($row_academic['primary_teaching']); ?></span>
																
								<dt> Research Interests:</dt>
                                <?php //do { ?>
								<span><?php echo ucfirst($row_academic['research']); ?></span>	
                                <?php //} while($row_academic = mysql_fetch_assoc($academic));?>						
								<dt>Education:</dt>
                                <?php //do { ?>
								<span><?php echo ucfirst($row_academic['education']); ?></span>
                                <?php //} while($row_academic = mysql_fetch_assoc($academic));?>						
								
							</dl>
                      </div>
                      <div class="clear"></div>
                      <hr />
                            <div> <a href="#" class="more"><strong>Edit Account</strong></a></div>
					  </div>
                  </div>
                  
              </div>
                 
		  </div>
                
	  </div>
      <?php } else { ?>
      no record
      <?php } ?>
      	<?php if ($row_login['access_level']==1) { 
		if ($totalRows_staff < 1) { echo "Empty";}
		?>
	  <div class="middle">
      
			<h2>Administrator Previlages </h2>
			<div id="TabbedPanels1" class="">
			  <ul class="box-head" style="width:300px;">
			    <li class="TabbedPanelsTab" tabindex="0">User</li>
			    <li class="TabbedPanelsTab" tabindex="0">News & Events</li>
		      </ul>
			  <div class="TabbedPanelsContentGroup">
			    <div class="TabbedPanelsContent">
			      <div><a href="add_user.php" class="more">Add Login Detail(s)</a></div>
                   <div><a href="acad_insert.php" class="more">Add Academic Staff</a></div>
                   <div><a href="nonacad_insert.php" class="more">Add Non-Academic/Technical Staff</a></div>
			      <div><a href="staff.php" class="more">View Users</a></div>
			    </div>
			    <div class="TabbedPanelsContent">
                <div><a href="add_news.php" class="more">Add News/Event</a></div>
                <div><a href="news_dashboard.php" class="more">News & Events Dashboard</a></div>
                      </div>
                     <p> </p>
		      </div>
		  </div>
      </div>
      <?php } else {  }
			?>
	
		</div>
        <!--SEcond Part For Non ACAD STAFF-->
      <?php } elseif ($row_login['staff_category']==1 || 2) { 
	  mysql_select_db($database_atbu_ee, $atbu_ee);
$query_non = "SELECT * FROM nonacademic_staff WHERE user_id = '$row_staff[user_id]'";
$non = mysql_query($query_non, $atbu_ee) or die(mysql_error());
$row_non = mysql_fetch_assoc($non);
$totalRows_non = mysql_num_rows($non);


	  ?>
      
      <div class="top"> 
			<div class="container">
           
				<div class="clearfix">
                
					<div class="grid9 first">
                    
						<h3><?php echo ucfirst($row_staff['surname']." ".$row_staff['othername']); ?></h3>
							<div class="img-box" style="float:left;">
							<figure><img src="images/3page-img1.jpg" alt="" width="169" height="172"></figure>
							<p><h2><?php echo ucfirst($row_staff['title']." ".$row_staff['surname']." ".$row_staff['othername']); ?></h2>
                            		<table width="60%" border="0">
  <tr>
    <td width="18%">Name:</td>
    <td width="82%" colspan="2"><?php echo ucfirst($row_staff['title']." ".$row_staff['surname']." ".$row_staff['othername']); ?></td>
  </tr>
  <tr>
    <td>Gender:</td>
    <td colspan="2"><?php echo ucfirst($row_staff['gender']); ?></td>
  </tr>
  <tr>
    <td>Rank:</td>
    <td colspan="2"><?php echo ucfirst($row_non['rank']); ?></td>
  </tr>
  <tr>
    <td>Qualification:</td>
    <td colspan="2"><?php echo ucfirst($row_non['qualification']); ?></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td> <div align="right"> <a href="#" class="more"><strong>Edit Account</strong></a></div></td>
  </tr>
                              </table>

                          
                            </p>
						</div>
						<?php if ($row_login['access_level']==1) { 
		if ($totalRows_staff < 1) { echo "Empty";}
		?>
	  <div class="middle">
      
			<h2>Administrator Previlages </h2>
			<div id="TabbedPanels1" class="">
			  <ul class="box-head" style="width:300px;">
			    <li class="TabbedPanelsTab" tabindex="0">User</li>
			    <li class="TabbedPanelsTab" tabindex="0">News & Events</li>
		      </ul>
			  <div class="TabbedPanelsContentGroup">
			    <div class="TabbedPanelsContent">
			      <div><a href="add_user.php" class="more">Add Login Detail(s)</a></div>
                   <div><a href="acad_insert.php" class="more">Add Academic Staff</a></div>
                   <div><a href="nonacad_insert.php" class="more">Add Non-Academic/Technical Staff</a></div>
			      <div><a href="staff.php" class="more">View Users</a></div>
			    </div>
			    <div class="TabbedPanelsContent">
                <div><a href="add_news.php" class="more">Add News/Event</a></div>
                <div><a href="news_dashboard.php" class="more">News & Events Dashboard</a></div>
                      </div>
                     <p> </p>
		      </div>
		  </div>
      </div>
      <?php } else {  }
			?>
	
						<!--<a href="#" class="more">Read More</a>-->
					</div>
					<div class="grid3">
                    <div class="wrapper">
							
					  </div>
                  </div>
                  
              </div>
                 
		  </div>
                
	  </div>
      <?php } ?>
</section>
<div><?php require("footer.php"); ?></div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    </script>
</body>
</html>
<?php
@mysql_free_result($login);

@mysql_free_result($academic);

@mysql_free_result($non);

mysql_free_result($staff);
?>
