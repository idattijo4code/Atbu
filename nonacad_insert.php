<?php require_once('Connections/atbu_ee.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_detail")) {
 $insertSQL = sprintf("INSERT INTO staff (category_id, title, surname, othername, gender) VALUES (%s, %s, %s, %s, %s)",
  					   
                       GetSQLValueString(htmlentities(trim($_POST['cat'])), "int"),
					   GetSQLValueString(htmlentities(trim($_POST['title'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['surname'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['othername'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['gender'])), "text"));

  mysql_select_db($database_atbu_ee, $atbu_ee);
  $Result1 = mysql_query($insertSQL, $atbu_ee) or die(mysql_error());
  
  $lastpicid = mysql_insert_id();
  	if($Result1) {
		$insertSQL2 = sprintf("INSERT INTO nonacademic_staff (user_id, phone, office, email, rank, qualification) VALUES ( %s, %s, %s, %s, %s, %s)",
					   GetSQLValueString($lastpicid, "int"),
					   GetSQLValueString(htmlentities(trim($_POST['phone'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['office'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['email'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['rank'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['qualification'])), "text"));
		mysql_select_db($database_atbu_ee, $atbu_ee);
		$Result2 = mysql_query($insertSQL2, $atbu_ee) or die(mysql_error());
		}

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_staff_cat = "SELECT * FROM staff_category WHERE cat_id !=3";
$staff_cat = mysql_query($query_staff_cat, $atbu_ee) or die(mysql_error());
$row_staff_cat = mysql_fetch_assoc($staff_cat);
$totalRows_staff_cat = mysql_num_rows($staff_cat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP:</title>
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
				<div class="clearfix">
					<div class="grid9 first">
      
                   <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="add_detail" id="add_detail"><table width="659" border="0" cellpadding="0" cellspacing="1">
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
          <option value="<?php echo $row_staff_cat['cat_id']; ?>"><?php echo $row_staff_cat['category'] ?></option>
          <?php } while($row_staff_cat = mysql_fetch_assoc($staff_cat));?>
          </select></td>
        <td width="154" rowspan="10"><input name="image" type="file" id="image" size="10" /></td>
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
        </tr>
      <tr>
          <td width="176"><div align="right">Surname:</div></td>
      <td width="322">
        <label><?php
if (isset($missing) && in_array('surname', $missing)) { ?>
  <span class="warn">Please enter your surname</span><?php } ?> </label>
        <input name="surname" type="text" id="textfield" size="40"  required="required" <?php if (isset($missing)) {
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
          <input name="othername" type="text" id="textfield2" size="40" required  <?php if (isset($missing)) {
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
        <td><div align="right">Phone:</div></td>
        <td><input name="phone" type="text" id="phone" size="40"></td>
      </tr>
      <tr>
        <td><div align="right">E-mail:</div></td>
        <td><input name="email" type="text" id="email" size="40"></td>
      </tr>
      
      <tr>
        <td><div align="right">Rank:</div></td>
        <td><input name="rank" type="text" required id="textfield6" size="40"  /></td>
      </tr>
      <tr>
        <td><div align="right">Office:</div></td>
        <td><textarea name="office" cols="44" rows="3" id="office"></textarea></td>
      </tr>
    <tr>
      <td><div align="right">Qualification:</div></td>
      <td><textarea name="qualification" id="qualification" cols="44" rows="3" required></textarea></td>
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
<?php
mysql_free_result($staff_cat);
?>
