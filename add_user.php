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
mysql_select_db($database_atbu_ee, $atbu_ee);
$query_category = "SELECT * FROM staff_category";
$category = mysql_query($query_category, $atbu_ee) or die(mysql_error());
$row_category = mysql_fetch_assoc($category);
$totalRows_category = mysql_num_rows($category);

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_access_level = "SELECT * FROM access_level ORDER BY level_id DESC";
$access_level = mysql_query($query_access_level, $atbu_ee) or die(mysql_error());
$row_access_level = mysql_fetch_assoc($access_level);
$totalRows_access_level = mysql_num_rows($access_level);


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_user")) {
 



// list expected fields
$expected = array('username', 'password');
// set required fields
$required = array('username', 'password');
// create empty array for any missing fields
$missing = array();

// process the $_POST variables
foreach ($_POST as $key => $value) {
// assign to temporary variable and strip whitespace if not an array
$temp = is_array($value) ? $value : trim($value);
// if empty and required, add to $missing array
if (empty($temp) && in_array($key, $required)) {
array_push($missing, $key);
}
// otherwise, assign to a variable of the same name as $key
elseif (in_array($key, $expected)) {
${$key} = $temp;
}
}

if (empty($missing)) {
	 $insertSQL = sprintf("INSERT INTO login (user_id, username, password, access_level, staff_category) VALUES (%s, %s, %s, %s, %s)",
  					   GetSQLValueString($_POST['user_id'], "text"),
                       GetSQLValueString(htmlentities(trim($_POST['username'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['password'])), "text"),
                       GetSQLValueString(htmlentities($_POST['access_level']), "int"),
                       GetSQLValueString(htmlentities($_POST['staff_cat']), "int"));

  mysql_select_db($database_atbu_ee, $atbu_ee);
  $Result1 = mysql_query($insertSQL, $atbu_ee) or die(mysql_error());

  $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

	if ($mailSent) {
// $missing is no longer needed if the email is sent, so unset it
unset($missing);
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ATBU-EEP:Add New User</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<div><?php require("header.php"); ?></div>
	<section id="content">
<div class="middle">
			<div class="container">
				<div class="wrapper">
					<div class="grid3 first">
						<ul class="categories">
							<li><a href="#">HOME</a></li>
							<li><a href="#">ACADEMICS</a></li>
							<li><a href="#">POST GRADUATE</a></li>
							<li><a href="#">UNDERGRADUATE</a></li>
							<li><a href="#">ALUMNI </a></li>
							<li><a href="#">CONTACT US </a></li>
                            
							<!--<li><a href="#">Engineering and Construction</a></li>
							<li><a href="#">High Technology</a></li>
							<li><a href="#">Industrial Manufacturing</a></li>-->
						</ul>
					</div>
					<div class="grid9">
                     <div><a href="staff_profile.php" style="color:#00F;"> << My Profile </a></div>
                    <p>&nbsp;</p>
						<h2>Add New User</h2>
                        
                      <?php
if ($_POST) {
?>
<p class="warning">Sorry, there was a problem inserting your record.
Please try later.</p>
<?php
}
elseif ($_POST) {
?>
<p><strong>Username & Password created.
</strong></p>
<?php } ?>
						<p align="center"><form action="<?php echo $editFormAction; ?>" method="POST" id="add_user" name="add_user"><table width="65%" border="0">
  <tr>
    <td width="30%"><div align="right">Username:</div></td>
    <td width="70%"><label for="username"></label>
      <input name="username" type="text" id="username" size="40" required="required" /></td>
  </tr>
  <tr>
    <td><div align="right">Password:</div></td>
    <td><label for="password"></label>
      <input name="password" type="password" id="password" size="40" required="required" /></td>
  </tr>
  <tr>
    <td><div align="right">Access Level:</div></td>
    <td><label for="access_level"></label>
    
      <select name="access_level" id="access_level" required="required">
      <?php do { ?>
      <option value="<?php echo $row_access_level['level_id']; ?>"><?php echo $row_access_level['access_level']; ?></option>
      <?php } while($row_access_level = mysql_fetch_assoc($access_level));?>
      </select></td>
  </tr>
  <tr>
    <td><div align="right">Category:</div></td>
    <td>
      <select name="ii" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
      <option value="">Choose...</option>
      <?php do { ?>
      <option  <?php if(isset($_GET['cat_id'])) { echo ($_GET['cat_id']== $row_category['cat_id'] ? ' selected="selected" ' :''); } ?> value="add_user.php?cat_id=<?php echo $row_category['cat_id']; ?>"><?php echo $row_category['category']; ?></option>
      <?php } while($row_category = mysql_fetch_assoc($category));?>
      </select>
      <input name="staff_cat" type="hidden" value="<?php echo $_GET['cat_id']; ?>" /></td>
  </tr>
  <?php if (isset($_GET['cat_id']) && $_GET['cat_id'] != " ") { 
 
  
  

  mysql_select_db($database_atbu_ee, $atbu_ee);
$query_acad = "SELECT * FROM staff WHERE category_id = '$_GET[cat_id]'";
$acad = mysql_query($query_acad, $atbu_ee) or die(mysql_error());
$row_acad = mysql_fetch_assoc($acad);
$totalRows_acad = mysql_num_rows($acad);


  ?>
	
	<tr align="center">
    <td colspan="2">
    
    <table width="230" border="1" align="center" class="box">
    <tr class="box-head">
    <td width="10%">S/N</td>
    <td width="45%">Name</td>
    <td width="34%">Rank</td>
    <td width="11%">Select </td>
    </tr>
    <?php $a=1; do {?>
    <tr>
    <td><?php echo $a++; ?></td>
  <td><?php echo $row_acad['title']." ".$row_acad['surname']." ".$row_acad['othername']; ?></td>
  <td><?php if ($row_acad['category_id']==3) {
	  mysql_select_db($database_atbu_ee, $atbu_ee);
$query_acad_rank = "SELECT rank FROM academic_staff WHERE user_id = '$row_acad[user_id]'";
$acad_rank = mysql_query($query_acad_rank, $atbu_ee) or die(mysql_error());
$row_acad_rank = mysql_fetch_assoc($acad_rank);
 echo $row_acad_rank['rank'];

} elseif ($row_acad['category_id']==1 || 2) {
	  mysql_select_db($database_atbu_ee, $atbu_ee);
$query_non_rank = "SELECT rank FROM nonacademic_staff WHERE user_id = '$row_acad[user_id]'";
$non_rank = mysql_query($query_non_rank, $atbu_ee) or die(mysql_error());
$row_non_rank = mysql_fetch_assoc($non_rank);
 echo $row_non_rank['rank'];

} ?></td>
  <td><input name="user_id" type="radio" value="<?php echo $row_acad['user_id'] ?>" /></td>
  </tr>
  <?php } while($row_acad = mysql_fetch_assoc($acad));?>
  </table>
  
  </td>
  </tr>  
<?php  }  ?>
  
   
  <tr>
    <td>&nbsp;</td>
    <td>
    <div class="buttons">
    <input name="submit" type="submit" class="button" id="submit" value="Submit" />
    </div>
    </td>
  </tr>
                        </table>
						  <input type="hidden" name="MM_insert" value="add_user" />
						</form>

                        </p>
						
						
					</div>
				</div>
			</div>
		</div>
        </section>
	<?php require("footer.php"); ?>

</body>
</html>
<?php
mysql_free_result($category);

mysql_free_result($access_level);

mysql_free_result($acad);

mysql_free_result($acad_rank);
?>
