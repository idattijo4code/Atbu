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

$colname_courses = "-1";
if (isset($_GET['level'])) {
  $colname_courses = $_GET['level'];
}
mysql_select_db($database_atbu_ee, $atbu_ee);
$query_courses = sprintf("SELECT semester FROM courses WHERE `level` = %s", GetSQLValueString($colname_courses, "int"));
$courses = mysql_query($query_courses, $atbu_ee) or die(mysql_error());
$row_courses = mysql_fetch_assoc($courses);
$totalRows_courses = mysql_num_rows($courses);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
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
					
                    <div class="grid3 first">
							      <h2>Undergraduate</h2>				
						<p>The curriculum of the Programme is subjected to review from time to time.</p>
                        
						
						<ul class="list3">
							<li><a href="undergraduate.php?level=100">100 Level</a></li>
							<li><a href="undergraduate.php?level=200">200 Level</a></li>
							<li><a href="undergraduate.php?level=300">300 Level</a></li>
                            <li><a href="undergraduate.php?level=400">400 Level</a></li>
                            <li><a href="undergraduate.php?level=500">500 Level</a></li>
						</ul>
					</div>
                    
					<div class="grid9">
                    
						<h3><strong>UNDERGRADUATE</strong> SEMESTER REGISTRATION AND  COURSE CONTENTS <br />
                        <?php echo $_GET['level']; ?> Level</h3>
						<div><a href="academics.php"> << Back </a></div>
                        <p>&nbsp;</p>
                        <?php if ($_GET['level']!=500) {  ?>
                        <h2>First Semester</h2>
										<?php 
										
										mysql_select_db($database_atbu_ee, $atbu_ee);
$query_courses1 = "SELECT * FROM courses WHERE semester =1 AND `level`='$_GET[level]'";
$courses1 = mysql_query($query_courses1, $atbu_ee) or die(mysql_error());
$row_courses1 = mysql_fetch_assoc($courses1);
$totalRows_courses1 = mysql_num_rows($courses1);
										?>
                                        <table width="85%" border="0" class="box">
  <tr class="box-head">
    <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    <td width="20%">Pre-requisite</td>
  </tr>
  <?php $counter=0; $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
   <!-- <td><?php //echo $row_courses1['semester']; ?></td>-->
    <td><?php echo $row_courses1['course_code'] ?></td>
    <td><?php echo $row_courses1['course_title']; ?></td>
    <td><?php echo $row_courses1['cu']; ?></td>
    <td><?php echo $row_courses1['pre_requisite']; ?></td>
  </tr>
  <?php } while($row_courses1 = mysql_fetch_assoc($courses1));?>
</table><hr />
<?php  

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_courses2 = "SELECT * FROM courses WHERE semester =2 AND `level`='$_GET[level]'";
$courses2 = mysql_query($query_courses2, $atbu_ee) or die(mysql_error());
$row_courses2 = mysql_fetch_assoc($courses2);
$totalRows_courses2 = mysql_num_rows($courses2);
?>
<br />

<h2>Second Semester</h2>
<?php if ($_GET['level']==400) { ?>
<h3>EIT420: Student Industrial Work Experience Scheme (SIWES II):  (4 Units)</h3>

<p>Industry linked assignments under direct supervision by members of the university. The following factors are the basis of assessment of these assignments.<br />

1.	Basic Industrial Training.<br />
2.	Design and Make Group Projects.<br />
3.	Seminar on Group Project.<br />
4.	Report on Group Project.<br />
5.	Industrial Design Project.<br />
6.	Report on Industrial Design Project.<br />
7.	Individual Seminar.<br />
8.	Assessment by Individual Supervisor.<br />
9.	Overall Assessment (100%).
<hr />
</p>
<?php } else { ?>
    <table width="85%" border="0" class="box">
  <tr class="box-head">
     <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    <td width="20%">Pre-requisite</td>
  </tr>
  <?php $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
    <!--<td><?php //echo $row_courses2['semester']; ?></td>-->
    <td><?php echo $row_courses2['course_code'] ?></td>
    <td><?php echo $row_courses2['course_title']; ?></td>
    <td><?php echo $row_courses2['cu']; ?></td>
    <td><?php echo $row_courses2['pre_requisite']; ?></td>
  </tr>
  <?php } while($row_courses2 = mysql_fetch_assoc($courses2));?>
</table>
<hr />
<?php if ($_GET['level']==200) { ?>
<h3>EIT330: Student Industrial Work Experience Scheme I (SIWES I) (2 Units)</h3>
<p>
Students will undergo industrial training for 1 – 2 months during the long vacation at the end of second semester.</p>
<?php } ?>

<?php }?>

<?php } elseif ($_GET['level'] == 500) { ?>
  <h2>First Semester</h2>
										<?php 
										
		mysql_select_db($database_atbu_ee, $atbu_ee);
$query_coursesPO = "SELECT * FROM courses WHERE semester =1 AND `level`='500PO'";
$coursesPO = mysql_query($query_coursesPO, $atbu_ee) or die(mysql_error());
$row_coursesPO = mysql_fetch_assoc($coursesPO);
$totalRows_coursesPO = mysql_num_rows($coursesPO);
										?>
                                <h3>Power Options</h3>
                                        <table width="85%" border="0">
  <tr class="box-head">
    <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    <td width="20%">Pre-requisite</td>
  </tr>
  <?php $counter=0; $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
   <!-- <td><?php //echo $row_courses1['semester']; ?></td>-->
    <td><?php echo $row_coursesPO['course_code'] ?></td>
    <td><?php echo $row_coursesPO['course_title']; ?></td>
    <td><?php echo $row_coursesPO['cu']; ?></td>
    <td><?php echo $row_coursesPO['pre_requisite']; ?></td>
  </tr>
  <?php } while($row_coursesPO = mysql_fetch_assoc($coursesPO));?>
  </table><hr />
  <!--EO EO E-->
  
  							<?php 
										
		mysql_select_db($database_atbu_ee, $atbu_ee);
$query_coursesEO = "SELECT * FROM courses WHERE semester =1 AND `level`='500EO'";
$coursesEO = mysql_query($query_coursesEO, $atbu_ee) or die(mysql_error());
$row_coursesEO = mysql_fetch_assoc($coursesEO);
$totalRows_coursesEO = mysql_num_rows($coursesEO);
										?>
                                        <p>&nbsp;</p>
                             <h3>Electronics Options</h3>
                                        <table width="85%" border="0">
  <tr class="box-head">
    <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    <td width="20%">Pre-requisite</td>
  </tr>
  <?php $counter=0; $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
   <!-- <td><?php //echo $row_courses1['semester']; ?></td>-->
    <td><?php echo $row_coursesEO['course_code'] ?></td>
    <td><?php echo $row_coursesEO['course_title']; ?></td>
    <td><?php echo $row_coursesEO['cu']; ?></td>
    <td><?php echo $row_coursesEO['pre_requisite']; ?></td>
  </tr>
  <?php } while($row_coursesEO = mysql_fetch_assoc($coursesEO));?>
  </table><hr />
  <p>&nbsp;</p>
  <!--SEDCOND SEMESTER-->
   <h2>Second Semester</h2>
  <?php 
										
		mysql_select_db($database_atbu_ee, $atbu_ee);
$query_coursesPO2 = "SELECT * FROM courses WHERE semester =2 AND `level`='500PO'";
$coursesPO2 = mysql_query($query_coursesPO2, $atbu_ee) or die(mysql_error());
$row_coursesPO2 = mysql_fetch_assoc($coursesPO2);
$totalRows_coursesPO2 = mysql_num_rows($coursesPO2);
										?>
                                <h3>Power Options</h3>
                                        <table width="85%" border="0">
  <tr class="box-head">
    <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    <td width="20%">Pre-requisite</td>
  </tr>
  <?php $counter=0; $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
   <!-- <td><?php //echo $row_courses1['semester']; ?></td>-->
    <td><?php echo $row_coursesPO2['course_code'] ?></td>
    <td><?php echo $row_coursesPO2['course_title']; ?></td>
    <td><?php echo $row_coursesPO2['cu']; ?></td>
    <td><?php echo $row_coursesPO2['pre_requisite']; ?></td>
  </tr>
  <?php } while($row_coursesPO2 = mysql_fetch_assoc($coursesPO2));?>
  </table><hr />
  <!--EO EO E-->
  							<?php 
										
		mysql_select_db($database_atbu_ee, $atbu_ee);
$query_coursesEO2 = "SELECT * FROM courses WHERE semester =2 AND `level`='500EO'";
$coursesEO2 = mysql_query($query_coursesEO2, $atbu_ee) or die(mysql_error());
$row_coursesEO2 = mysql_fetch_assoc($coursesEO2);
$totalRows_coursesEO2 = mysql_num_rows($coursesEO2);
										?>
                                        <p>&nbsp;</p>
                             <h3>Electronics Options</h3>
                                        <table width="85%" border="0">
  <tr class="box-head">
    <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    <td width="20%">Pre-requisite</td>
  </tr>
  <?php $counter=0; $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
   <!-- <td><?php //echo $row_courses1['semester']; ?></td>-->
    <td><?php echo $row_coursesEO2['course_code'] ?></td>
    <td><?php echo $row_coursesEO2['course_title']; ?></td>
    <td><?php echo $row_coursesEO2['cu']; ?></td>
    <td><?php echo $row_coursesEO2['pre_requisite']; ?></td>
  </tr>
  <?php } while($row_coursesEO2 = mysql_fetch_assoc($coursesEO2));?>
  </table><hr />
  <?php 
  mysql_select_db($database_atbu_ee, $atbu_ee);
$query_courses_elec = "SELECT * FROM courses WHERE semester =1 AND `level`='500Elective'";
$courses_elec = mysql_query($query_courses_elec, $atbu_ee) or die(mysql_error());
$row_courses_elec = mysql_fetch_assoc($courses_elec);
$totalRows_courses_elec = mysql_num_rows($courses_elec);
  ?>
   <h2>Elective Courses</h2>
                             <h3>First Semester</h3>
                                        <table width="85%" border="0">
  <tr class="box-head">
    <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    
  </tr>
  <?php $counter=0; $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
   <!-- <td><?php //echo $row_courses1['semester']; ?></td>-->
    <td><?php echo $row_courses_elec['course_code'] ?></td>
    <td><?php echo $row_courses_elec['course_title']; ?></td>
    <td><?php echo $row_courses_elec['cu']; ?></td>
    
  </tr>
  <?php } while($row_courses_elec = mysql_fetch_assoc($courses_elec));?>
  </table><hr />
  
  <?php 
  mysql_select_db($database_atbu_ee, $atbu_ee);
$query_courses_elec2 = "SELECT * FROM courses WHERE semester =2 AND `level`='500Elective'";
$courses_elec2 = mysql_query($query_courses_elec2, $atbu_ee) or die(mysql_error());
$row_courses_elec2 = mysql_fetch_assoc($courses_elec2);
$totalRows_courses_elec2 = mysql_num_rows($courses_elec2);
  ?>
   <p>&nbsp;</p>
                             <h3>Second Semester</h3>
                                        <table width="85%" border="0">
  <tr class="box-head">
    <td width="6%">S/N</td>
    <!--<td width="17%">Semester</td>-->
    <td width="24%">Course Code</td>
    <td width="35%">Course Title</td>
    <td width="15%">CU</td>
    
  </tr>
  <?php $counter=0; $a=1; do {?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
  	<td><?php echo $a++; ?></td>
   <!-- <td><?php //echo $row_courses1['semester']; ?></td>-->
    <td><?php echo $row_courses_elec2['course_code'] ?></td>
    <td><?php echo $row_courses_elec2['course_title']; ?></td>
    <td><?php echo $row_courses_elec2['cu']; ?></td>
    
  </tr>
  <?php } while($row_courses_elec2 = mysql_fetch_assoc($courses_elec2));?>
  </table><hr />
  <?php }?>

											</div>
                                            
       
				</div>
			</div>
		</div>
					
		
	</section>
	<div><?php require("footer.php"); ?></div>
</body>
</html>
<?php
mysql_free_result($courses);
?>
