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
$query_staff = "SELECT * FROM staff";
$staff = mysql_query($query_staff, $atbu_ee) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP: STAFF</title>
	<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/jquery-ui-1.8.5.custom.css" type="text/css" media="all">
	<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.5.custom.min.js"></script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
</head>

<body>
	<div><?php require("header.php"); ?></div>
	<section id="content">
		<div class="top">
        
			<div class="container">
            <?php if (isset($_SERVER['HTTP_REFERER'])) { ?><div><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a></div><?php } ?>
            <p>&nbsp;</p>
				<div class="clearfix">
					
				  <div class="grid9 first">
                    <div class="img-box">
						<h2>Academic Staff</h2>
						<p>
                        <?php  
						mysql_select_db($database_atbu_ee, $atbu_ee);
$query_academic = "SELECT * FROM staff WHERE category_id = 3";
$academic = mysql_query($query_academic, $atbu_ee) or die(mysql_error());
$row_academic = mysql_fetch_assoc($academic);
$totalRows_academic = mysql_num_rows($academic);

						 ?>
                       <table width="95%" border="4" class="box">
  <tr class="box-head">
    <td>S/N</td>
    <td>Name</td>
    <td>Gender</td>
    <td>Rank</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  if ($totalRows_academic > 0) {
$a=1;  do { ?>
  <tr>
  	<td><?php echo $a++; ?></td>
    <td><?php echo ucfirst($row_academic['surname']." ".$row_academic['othername']); ?></td>
    <td><?php echo ucfirst($row_academic['gender']); ?></td>
    <td><?php 
	mysql_select_db($database_atbu_ee, $atbu_ee);
$query_academic1 = "SELECT * FROM academic_staff WHERE user_id = '$row_academic[user_id]' ";
$academic1 = mysql_query($query_academic1, $atbu_ee) or die(mysql_error());
$row_academic1 = mysql_fetch_assoc($academic1);

echo ucfirst($row_academic1['rank']);
?></td>
    <td><a href="view_profile.php?user_id=<?php echo $row_academic['user_id']; ?>">More Details</a></td>
  </tr>
  <?php } while($row_academic = mysql_fetch_assoc($academic));
  } else {
  ?>
  <td colspan="5"><div style="text-align:center; color:#F00; font-weight: bold;">No Records Found </div></td>
  <?php } ?>
</table>

 
                        </p>
                        </div>
                        <h2>Non-Academic Staff</h2>
						<div class="img-box">
<?php 
						mysql_select_db($database_atbu_ee, $atbu_ee);
$query_non_acad = "SELECT * FROM staff WHERE category_id = 2";
$non_acad = mysql_query($query_non_acad, $atbu_ee) or die(mysql_error());
$row_non_acad = mysql_fetch_assoc($non_acad);
$totalRows_non_acad = mysql_num_rows($non_acad);
						?>
							<table width="95%"  class="box">
  <tr class="box-head">
    <td>S/N</td>
    <td>Name</td>
    <td>Gender</td>
    <td>Rank</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  if ($totalRows_non_acad > 0) {
 $a=1; do {
  ?>
  <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo ucfirst($row_non_acad['surname']." ".$row_non_acad['othername']); ?></td>
    <td><?php echo ucfirst($row_non_acad['gender']); ?></td>
    <td><?php 
	mysql_select_db($database_atbu_ee, $atbu_ee);
$query_non_acad1 = "SELECT * FROM nonacademic_staff WHERE user_id = '$row_non_acad[user_id]'";
$non_acad1 = mysql_query($query_non_acad1, $atbu_ee) or die(mysql_error());
$row_non_acad1 = mysql_fetch_assoc($non_acad1);

echo ucfirst($row_non_acad1['rank']);
	 ?></td>
    <td><a href="view_profile.php?user_id=<?php echo $row_non_acad['user_id']; ?>">More Details</a></td>
  </tr>
  <?php } while($row_non_acad=mysql_fetch_assoc($non_acad));
  }else {
  ?>
  <td colspan="5"><div style="text-align:center; color:#F00; font-weight: bold;">No Records Found </div></td>
  <?php } ?>
</table>

					</div>
                    <h2>Technical Staff</h2>
                    <div class="img-box">
                     <?php 
						 mysql_select_db($database_atbu_ee, $atbu_ee);
$query_tech = "SELECT * FROM staff WHERE category_id = 1";
$tech = mysql_query($query_tech, $atbu_ee) or die(mysql_error());
$row_tech = mysql_fetch_assoc($tech);
$totalRows_tech = mysql_num_rows($tech);
						  ?>
							<table width="95%" class="box">
  <tr class="box-head">
    <td>S/N</td>
    <td>Name</td>
    <td>Gender</td>
    <td>Rank</td>
    <td>&nbsp;</td>
  </tr>
   <?php
   if ($totalRows_tech > 0) {
 $a=1; do {
  ?>
  <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo ucfirst($row_tech['surname']." ".$row_tech['othername']); ?></td>
    <td><?php echo ucfirst($row_tech['gender']); ?></td>
    <td><?php 
	mysql_select_db($database_atbu_ee, $atbu_ee);
$query_tech1 = "SELECT * FROM nonacademic_staff WHERE user_id = '$row_tech[user_id]'";
$tech1 = mysql_query($query_tech1, $atbu_ee) or die(mysql_error());
$row_tech1 = mysql_fetch_assoc($tech1);

echo ucfirst($row_tech1['rank']);
	 ?></td>
    <td><a href="view_profile.php?user_id=<?php echo md5($row_tech['user_id']); ?>">More Details</a></td>
  </tr>
   <?php } while($row_tech = mysql_fetch_assoc($tech));
   } else {
    ?>
    <td colspan="5"><div style="text-align:center; color:#F00; font-weight: bold;">No Records Found </div></td>
    <?php }?>
</table>

			          <blockquote>&nbsp;</blockquote>
                    </div>
						
										  </div>
                                          
                                          <div class="grid3">
						<h3>Structure of The Department</h3>
						<div class="img-wrap"><figure><img src="images/org.png" alt=""></figure></div>
						
					</div>
				</div>
			</div>
		</div>
				
	</section>
	<div><?php require("footer.php"); ?></div>
</body>
</html>
<?php
mysql_free_result($academic);

mysql_free_result($non_academic);

mysql_free_result($staff);
?>
