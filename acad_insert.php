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
$image_tempname = @$_FILES['image']['name'];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_detail")) {
	 $image_tempname = $_FILES['image']['name'];
			$ImageDir ="c:/xampp/htdocs/atbu/staff_pic/";
			
			//**INSERT THIS LINE:
			$ImageThumb = $ImageDir . "thumbs/";
			//**END OF INSERT
			$ImageName = $ImageDir . $image_tempname;
						
						
			if (move_uploaded_file($_FILES['image']['tmp_name'], $ImageName))
					{
							//get info about the image being uploaded
							list($width, $height, $type, $attr) = getimagesize($ImageName);
							
							if ($type > 3)
								{
									//echo "Sorry, but the file you uploaded was not a GIF, JPG, or PNG file.<br>";
									//echo "Please hit your browser’s ‘back’ button and try again.";
									//echo "include('error.php')";
									//header("Location: it.php");
								}else{
											//image is acceptable; ok to proceed

  $insertSQL = sprintf("INSERT INTO staff (category_id, title, surname, othername, gender) VALUES (%s, %s, %s, %s, %s)",
  					   
                       GetSQLValueString(3, "int"),
					   GetSQLValueString(htmlentities(trim($_POST['title'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['surname'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['othername'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['gender'])), "text"));

  mysql_select_db($database_atbu_ee, $atbu_ee);
  $Result1 = mysql_query($insertSQL, $atbu_ee) or die(mysql_error());
  
  $lastpicid = mysql_insert_id();
  	if($Result1) {
		$insertSQL2 = sprintf("INSERT INTO academic_staff (user_id, phone, office, email, rank, primary_teaching, research, education, biography) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s)",
					   GetSQLValueString($lastpicid, "int"),
					   GetSQLValueString(htmlentities(trim($_POST['phone'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['address'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['mail'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['rank'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['primary_teaching'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['research'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['education'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['bio'])), "text"));
		mysql_select_db($database_atbu_ee, $atbu_ee);
		$Result2 = mysql_query($insertSQL2, $atbu_ee) or die(mysql_error());
		}
  
  $newfilename = $ImageDir . $lastpicid . ".jpg";
			
					if ($type == 2){
							rename($ImageName, $newfilename);
							}
							else{
								if ($type == 1) {
									 $image_old = imagecreatefromgif($ImageName);
												}
										elseif($type == 3) {
												$image_old = imagecreatefrompng($ImageName);
														   }
												//"convert" the image to jpg
											$image_jpg = imagecreatetruecolor(300, 300/*$width, $height*/);
											imagecopyresampled($image_jpg, $image_old, 0, 0, 0, 0,300, 300, /*$width, $height*/ $width, $height);
											imagejpeg($image_jpg, $newfilename);
											imagedestroy($image_old);
											imagedestroy($image_jpg);
												}
												
												//**INSERT THESE LINES
$newthumbname = $ImageThumb . $lastpicid . ".jpg";
//get the dimensions for the thumbnail
$thumb_width = 120;
$thumb_height = 120;
//create the thumbnail
$largeimage = imagecreatefromjpeg($newfilename);
$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
imagecopyresampled($thumb, $largeimage, 0, 0, 0, 0,
$thumb_width, $thumb_height, $width, $height);
imagejpeg($thumb, $newthumbname);
imagedestroy($largeimage);
imagedestroy($thumb);
//**END OF INSERT
unlink($newfilename);																}
							
						}			
		
else {

 
  $insertSQL = sprintf("INSERT INTO staff (category_id, title, surname, othername, gender) VALUES (%s, %s, %s, %s, %s)",
  					   
                       GetSQLValueString(3, "int"),
					   GetSQLValueString(htmlentities(trim($_POST['title'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['surname'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['othername'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['gender'])), "text"));

  mysql_select_db($database_atbu_ee, $atbu_ee);
  $Result1 = mysql_query($insertSQL, $atbu_ee) or die(mysql_error());
  
  $lastpicid = mysql_insert_id();
  	if($Result1) {
		$insertSQL2 = sprintf("INSERT INTO academic_staff (user_id, phone, office, email, rank, primary_teaching, research, education, biography) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s)",
					    GetSQLValueString($lastpicid, "int"),
					   GetSQLValueString(htmlentities(trim($_POST['phone'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['address'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['mail'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['rank'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['primary_teaching'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['research'])), "text"),
					   GetSQLValueString(htmlentities(trim($_POST['education'])), "text"),
                       GetSQLValueString(htmlentities(trim($_POST['bio'])), "text"));
		mysql_select_db($database_atbu_ee, $atbu_ee);
		$Result2 = mysql_query($insertSQL2, $atbu_ee) or die(mysql_error());
		}
  
 }
 

	
  
  


  $insertGoTo = "acad_insert.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
                            <option value="Engr.">Engr.</option>
                            <option value="Prof.">Prof.</option>
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
             <input name="primary_teaching" type="text" id="primary_teaching" size="30" /></td>
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
    
      <input type="tel" name="phone" id="textfield6"  <?php if (isset($missing)) {
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
      <label></label>
         <textarea name="address" id="textarea" cols="35" rows="3"><?php if (isset($missing)) {
			echo trim(@$_POST['address']);
			} ?></textarea>        </td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><strong><u> Research &amp; Education</u></strong></td>
    </tr>
    <tr>
      <td><div align="right" style="vertical-align:text-bottom;">Rank:</div></td>
      <td colspan="3">
     
      <input name="rank" type="text" id="rank" placeholder="" size="35"></td>
    </tr>
    <tr>
      <td><div align="right">Research Interest:</div></td>
      <td colspan="3">
      <span style="font-size:11px; color:#F00; text-align: right; margin-left: 8px;">Separate Multiple Values with a semi-colon(;)</span><br />
      <input name="research" type="text" id="textfield3" size="35"  <?php if (isset($missing)) {
			echo 'value="'.htmlentities(@$_POST['mail']).'"';
			} ?> /></td>
    </tr>
    <tr>
      <td><div align="right">Education:</div></td>
      <td colspan="3"><span style="font-size:11px; color:#F00; text-align: right; margin-left: 8px;">Separate Multiple Values with a semi-colon(;)</span><br />
        <textarea name="education" cols="35" rows="3" id="education"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><strong><u>Biography:</u></strong></td>
    </tr>
         <tr>
      <td>&nbsp;</td>
      <td colspan="3"><textarea name="bio" id="textarea" cols="50" rows="6"><?php if (isset($missing)) {
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
                   </form>
			
		</div>
        <div class="grid3">
            &nbsp;
            </div>
		</div>
        </div>
		</div>
	</section>
<div><?php require("footer.php"); ?></div>
</body>
</html>