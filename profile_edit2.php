<?php require_once('Connections/atbu_ee.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
$query_cat = "SELECT * FROM staff_category";
$cat = mysql_query($query_cat, $atbu_ee) or die(mysql_error());
$row_cat = mysql_fetch_assoc($cat);
$totalRows_cat = mysql_num_rows($cat);

$colname_non_acad = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_non_acad = $_SESSION['user_id'];
}
mysql_select_db($database_atbu_ee, $atbu_ee);
$query_non_acad = sprintf("SELECT * FROM nonacademic_staff WHERE user_id = %s", GetSQLValueString($colname_non_acad, "int"));
$non_acad = mysql_query($query_non_acad, $atbu_ee) or die(mysql_error());
$row_non_acad = mysql_fetch_assoc($non_acad);
$totalRows_non_acad = mysql_num_rows($non_acad);

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
    
      
      <div class="top"> 
			<div class="container">
           
				<div class="clearfix">
                
					<div class="grid9 first">
                    <form action="#" method="POST" enctype="multipart/form-data" name="add_detail" id="add_detail"><table width="659" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="2" rowspan="12">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><u> <strong>Personal Details</strong></u></td>
        <td width="154"><u><strong>Staff Image:</strong></u></td>
      </tr>
      <tr>
        <td align="right"><div align="right" style="color: #F00;">*Staff Category:</div></td>
        <td>          
          <select name="cat" id="cat">
          <option>Choose...</option>
          <?php do { ?>
          <option  <?php if(isset($row_staff['category_id'])) { echo ($row_staff['category_id']== $row_cat['cat_id'] ? ' selected="selected" ' :''); } ?> value="<?php echo $row_cat['cat_id']; ?>"><?php echo $row_cat['category'] ?></option>
          <?php } while($row_cat = mysql_fetch_assoc($cat));?>
          </select></td>
        <td width="154" rowspan="10"><input name="image" type="file" id="image" size="10" /></td>
      </tr>
      <tr>
        <td align="right">Title:</td>
        <td><select name="title" id="title">
				           <option>Choose...</option>
                            <option <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'mr.' ? ' selected="selected" ' :''); } ?> value="Mr.">Mr.</option>
				            <option <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'mal.' ? ' selected="selected" ' :''); } ?> value="Mal.">Mal.</option>
				            <option <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'mrs.' ? ' selected="selected" ' :''); } ?> value="Mrs.">Mrs.</option>
				            <option <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'miss.' ? ' selected="selected" ' :''); } ?> value="Miss.">Miss.</option>
				            <option <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'Alhaji.' ? ' selected="selected" ' :''); } ?> value="Alhaji.">Alhaji.</option>
				            <option <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'Hajiya.' ? ' selected="selected" ' :''); } ?> value="Hajiya.">Hajiya.</option>
                            <option  <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'Dr.' ? ' selected="selected" ' :''); } ?>value="Dr.">Dr.</option>
                            <option <?php if(isset($row_staff['title'])) { echo ($row_staff['title']== 'professor' ? ' selected="selected" ' :''); } ?> value="Professor">Professor</option>
              </select></td>
        </tr>
      <tr>
          <td width="176"><div align="right">Surname:</div></td>
      <td width="322">
       
        <input name="surname" type="text" id="textfield" size="40"  required="required" value="<?php echo $row_staff['surname']; ?>" />
      </td>
      </tr>
    <tr>
      <td><div align="right">Other Name(s):</div></td>
      <td>
        <label><?php
if (isset($missing) && in_array('othername', $missing)) { ?>
<span class="warn">Please enter your othername</span><?php } ?> </label>
          <input name="othername" type="text" id="textfield2" size="40" required value="<?php echo $row_staff['othername']; ?>" />
                 </td>
      </tr>
             
      <tr>
          <td><div align="right">Gender:</div></td>
          <td>
          <label>
          <label for="gender"></label>
          <select name="gender" id="gender">
          <option <?php if (isset($row_staff['gender'])) { echo ($row_staff['gender'] =='female' ? 'selected="selected"' :''); } ?> value="female">Female</option>
          <option <?php if (isset($row_staff['gender'])) { echo ($row_staff['gender'] =='male' ? 'selected="selected"' :''); } ?> value="male">Male</option>
          </select></td>
          
        </tr>
      <tr>
        <td><div align="right">Phone:</div></td>
        <td><input name="phone" type="text" id="phone" size="40" value="<?php echo $row_non_acad['phone'] ?>"></td>
      </tr>
      <tr>
        <td><div align="right">E-mail:</div></td>
        <td><input name="email" type="text" id="email" size="40" value="<?php echo $row_non_acad['email'] ?>"></td>
      </tr>
      
      <tr>
        <td><div align="right">Rank:</div></td>
        <td><input name="rank" type="text" required id="textfield6" size="40" value="<?php echo $row_non_acad['rank']; ?>"  /></td>
      </tr>
      <tr>
        <td><div align="right">Office:</div></td>
        <td><textarea name="office" cols="44" rows="3" id="office"><?php echo $row_non_acad['office']; ?></textarea></td>
      </tr>
    <tr>
      <td><div align="right">Qualification:</div></td>
      <td><textarea name="qualification" id="qualification" cols="44" rows="3" required><?php echo $row_non_acad['qualification']; ?></textarea></td>
      </tr>
        
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="right"><input / type="submit" name="submit" value="Submit Details">
        </td>
      <td>&nbsp;</td>
    </tr>
      </table>
                     <input type="hidden" name="MM_insert" value="add_detail">
                   </form>
										</div>
						
						<!--<a href="#" class="more">Read More</a>-->
					</div>
					<div class="grid3">
                    <div class="wrapper">
							
					  </div>
                  </div>
                  
              </div>
                 
		  </div>
                
	  
    
</section>
<div><?php require("footer.php"); ?></div>

</body>
</html>
<?php
mysql_free_result($staff);

mysql_free_result($cat);

mysql_free_result($non_acad);
?>
