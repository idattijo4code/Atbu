<?php require_once('Connections/atbu_ee.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<?php
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

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_staff = "SELECT * FROM staff WHERE user_id = $_GET[user_id]";
$staff = mysql_query($query_staff, $atbu_ee) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_non_academic = "SELECT * FROM nonacademic_staff WHERE user_id = $_GET[user_id]";
$non_academic = mysql_query($query_non_academic, $atbu_ee) or die(mysql_error());
$row_non_academic = mysql_fetch_assoc($non_academic);
$totalRows_non_academic = mysql_num_rows($non_academic);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo ucfirst($row_staff['surname']." ".$row_staff['othername']); ?> | ATBU Department of Electrical and Electronics Engineering</title>
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
		<div class="top">
			<div class="container">
				<div class="clearfix">
                <?php if ($row_staff['category_id'] == 3) { 
				
				mysql_select_db($database_atbu_ee, $atbu_ee);
$query_misc = "SELECT * FROM academic_staff WHERE user_id = '$row_staff[user_id]'";
$misc = mysql_query($query_misc, $atbu_ee) or die(mysql_error());
$row_misc = mysql_fetch_assoc($misc);
$totalRows_misc = mysql_num_rows($misc);
				?>
					<div class="grid9 first">
                    <div> <a href="staff.php" style="color: #00F;"> << Staff List</a></div>
                    <p>&nbsp;</p>
						<h3><?php echo ucfirst($row_staff['surname']." ".$row_staff['othername']); ?></h3>
							<div class="img-box">
							<figure><img src="images/3page-img1.jpg" alt="" width="169" height="172"></figure>
							<p><h2><?php echo ucfirst($row_staff['title']." ".$row_staff['othername']." ".$row_staff['surname']); ?></h2>
                            		<div><strong><?php echo $row_misc['rank']; ?></strong></div>
                          <?php echo $row_misc['biography'] ?>
                            </p>
						</div>
					
						<!--<a href="#" class="more">Read More</a>-->
					</div>
					<div class="grid3">
                    <div class="wrapper">
							<dl class="departments">
								<dt>Contact Information:</dt>
								<dd><span>Office Address:</span><?php echo $row_misc['office']; ?></dd>				
                                <dd><span>Office Phone:</span><?php echo $row_misc['phone']; ?></dd>
                                <dd><span>E-mail:</span><?php echo $row_misc['email']; ?></dd>
								
								<dt>Primary Teaching Area:</dt>
								<span><?php echo ucfirst($row_misc['primary_teaching']); ?></span>
																
								<dt> Research Interests:</dt>
                                <?php //do { ?>
								<span><?php echo ucfirst($row_misc['research']); ?></span>	
                                <?php //} while($row_misc = mysql_fetch_assoc($misc));?>						
								<dt>Education:</dt>
                                <?php //do { ?>
								<span><?php echo ucfirst($row_misc['education']); ?></span>
                                <?php //} while($row_misc = mysql_fetch_assoc($misc));?>						
								
							</dl>
						</div>
                                      </div>

                
                <?php } elseif ($row_staff['category_id'] == 1 || 2) {  ?>
                <div class="grid9 first">
                     <div> <a href="staff.php" style="color: #00F;"> << Staff List</a></div>
                     <p>&nbsp; </p>
				  <h2><?php echo ucfirst($row_staff['surname']." ".$row_staff['othername']);?></h2> <h4>Non-Academic Staff</h4>
							<table width="65%" border="0">
  <tr>
    <td width="23%">Name:</td>
    <td width="23%"><?php echo ucfirst($row_staff['title']." ".$row_staff['surname']." ".$row_staff['othername']); ?></td>
    <td width="47%" rowspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td>Gender:</td>
    <td><?php echo ucfirst($row_staff['gender']); ?></td>
    </tr>
  <tr>
    <td>Phone:</td>
    <?php 
	mysql_select_db($database_atbu_ee, $atbu_ee);
$query_misc2 = "SELECT * FROM nonacademic_staff WHERE user_id = '$row_staff[user_id]'";
$misc2 = mysql_query($query_misc2, $atbu_ee) or die(mysql_error());
$row_misc2 = mysql_fetch_assoc($misc2);
$totalRows_misc2 = mysql_num_rows($misc2);
	?>
    <td><?php echo $row_misc2['phone']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Rank:</td>
    <td><?php echo $row_misc2['rank']; ?></td>
    <td>&nbsp;</td>
    </tr>
                  </table>

						
						<!--<a href="#" class="more">Read More</a>-->
					</div>
					<div class="grid3">
                    
                  </div>

                <?php } else { ?>
                <h2 class="msg-error">No Records Found</h2>
                <?php  } ?>
				</div>
                
			</div>
		
				</div>
	</section>
<div><?php require("footer.php"); ?></div>
</body>
</html>
