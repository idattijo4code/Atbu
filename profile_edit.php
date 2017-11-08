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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit_detail")) {
  $updateSQL = sprintf("UPDATE staff SET title=%s, first_name=%s, other_name=%s, gender=%s, office=%s, primary_teaching=%s, biography=%s WHERE phone=%s AND email=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['surname'], "text"),
                       GetSQLValueString($_POST['othername'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['primary_teaching'], "text"),
                       GetSQLValueString($_POST['bio'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['mail'], "text"));

  mysql_select_db($database_atbu_ee, $atbu_ee);
  $Result1 = mysql_query($updateSQL, $atbu_ee) or die(mysql_error());

  $updateGoTo = "staff_profile.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP:Profile Edit</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	
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
      
                   <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="edit_detail" id="add_detail"><table width="659" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="2" rowspan="7">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><u> <strong>Personal Details</strong></u></td>
        <td width="154"><u><strong>Staff Image:</strong></u></td>
      </tr>
      <tr>
        <td align="right">Title:</td>
        <td><select name="title" id="title">
				           <option>Choose...</option>
                            <option value="Mr.">Mr.</option>
				            <option value="Mal.">Mal.</option>
				            <option value="Mrs.">Mrs.</option>
				            <option value="Miss.">Miss.</option>
				            <option value="Alhaji.">Alhaji.</option>
				            <option value="Hajiya.">Hajiya.</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Professor">Professor</option>
              </select></td>
        <td width="154" rowspan="5"><input name="image" type="file" id="image" size="10" /></td>
      </tr>
      <tr>
          <td width="176"><div align="right">Surname:</div></td>
      <td width="322">
        <label><?php
if (isset($missing) && in_array('surname', $missing)) { ?>
  <span class="warn">Please enter your surname</span><?php } ?> </label>
        <input name="surname" type="text" id="textfield" size="30"  required="required" <?php if (isset($missing)) {
			echo 'value="'.htmlentities(@$_POST['surname']).'"';
			} ?> />
      </td>
      </tr>
    <tr>
      <td><div align="right">Other Name(s):</div></td>
      <td>
        <label><?php
if (isset($missing) && in_array('othername', $missing)) { ?>
<span class="warn">Please enter your othername</span><?php } ?> </label>
          <input name="othername" type="text" id="textfield2" size="30" required  <?php if (isset($missing)) {
			echo 'value="'.htmlentities(@$_POST['othername']).'"';
			} ?> />
                 </td>
      </tr>
             
      <tr>
          <td><div align="right">Gender:</div></td>
          <td>
          <label><?php
if (isset($missing) && in_array('sex', $missing)) { ?>
<span class="warn">Please Select your sex</span><?php } ?> </label>
          <label for="gender"></label>
          <select name="gender" id="gender">
          <option value="female">Female</option>
          <option value="male">Male</option>
          </select></td>
          
        </tr>
    <tr>
      <td><div align="right">Primary Teaching Area:</div></td>
      <td>
             <input name="primary_teaching" type="text" id="primary_teaching" /></td>
      </tr>
        
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
      <td>&nbsp;</td>
      <td><strong><u>Office Details</u></strong></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right"> Office Phone:</div></td>
      <td>
    
      <input type="tel" name="phone" id="textfield6" required  <?php if (isset($missing)) {
			echo 'value="'.htmlentities(@$_POST['phone']).'"';
			} ?>/></td>
      <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
      <td><div align="right"> Office Email:</div></td>
      <td><input type="email" name="mail" id="textfield5"  <?php if (isset($missing)) {
			echo 'value="'.htmlentities(@$_POST['mail']).'"';
			} ?> /></td>
      <td colspan="2">&nbsp;</td>
      </tr>
    <tr>
      <td><div align="right">Office Address:</div></td>
      <td colspan="3">
      <label><?php
if (isset($missing) && in_array('address', $missing)) { ?>
<span class="warn">Please enter your Address</span><?php } ?> </label>
         <textarea name="address" id="textarea" cols="35" rows="3" required><?php if (isset($missing)) {
			echo trim(@$_POST['address']);
			} ?></textarea>        </td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><strong><u>About Me:</u></strong></td>
    </tr>
         <tr>
      <td>&nbsp;</td>
      <td colspan="3"><textarea name="bio" id="textarea" cols="50" rows="6" required><?php if (isset($missing)) {
			echo trim(@$_POST['address']);
			} ?></textarea></td>
      </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" align="right"><input / type="submit" name="submit" value="Submit Details">
      </td>
      <td>&nbsp;</td>
      </tr>
      </table>
                     <input type="hidden" name="MM_insert" value="add_detail">
                     <input type="hidden" name="MM_update" value="edit_detail">
                   </form>
			
		</div>
        <div class="grid3">
            TURANCI
            </div>
		</div>
        </div>
		</div>
	</section>
<div><?php require("footer.php"); ?></div>
</body>
</html>