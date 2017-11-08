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

$search= htmlentities($_GET['search'], ENT_QUOTES);
//we perform filtering
$search=strtoupper($search);
$search=strip_tags($search);
$search=trim($search);
if(!empty($search)) {
	
mysql_select_db($database_atbu_ee, $atbu_ee);
$query_search = "SELECT * FROM academic_staff a, nonacademic_staff n WHERE a.surname like '%$search%' or n.surname like '%$search%' or a.othername like'%$search%' or n.othername like'%$search%' or CONCAT(a.surname,' ',a.othername) like '%$search%' or CONCAT(a.othername,' ',a.surname) like '%$search%' or CONCAT(n.surname,' ',n.othername) like '%$search%' or CONCAT(n.othername,' ',n.surname) like '%$search%' or phone like '%$search%' or email like '%$search%'";
$search = mysql_query($query_search, $atbu_ee) or die(mysql_error());
$row_search = mysql_fetch_assoc($search);
}
else {
	echo "Cannot Search Empty Value";	
	}
	
	
	

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
                    
                        <?php 
$anymatches=@mysql_num_rows($search);
if ($anymatches==00)
{echo '<div class="warning">';
echo "sorry no Matches Found.";
echo '</div>';
}
else {
?>
<table width="98%" border="0" cellpadding="2" cellspacing="2" class="box">
  <tr class="box-head">
      <td width="22">S/N</td>
    <td width="127">Surname</td>
    <td width="117">OtherNames</td>
    <td width="86">Phone</td>
    <td width="174">Course</td>
  </tr>
  
<?php 
	$counter = 0; 
$a=1;  
do { 
$t_id[] = $row_search['user_id'];
}while($result=mysql_fetch_array($search));

foreach ($t_id as $key) { 

	mysql_select_db($database_atbu_ee, $atbu_ee);
$query_list = "SELECT * FROM academic_staff WHERE user_id = '$key'";
$list = mysql_query($query_list, $atbu_ee) or die(mysql_error());
$row_list = mysql_fetch_assoc($list);
$totalRows_list = mysql_num_rows($list);

if ($totalRows_list >0) {
?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
    <td><?php echo $a++; ?></td>
    <td><a href="view_profile.php?lecturer=<?php echo $result['user_id']; ?>"><?php echo $row_list['surname']; ?> </a></td>
    <td><a href="view_stu.php?id=<?php echo $result['id']; ?>"><?php echo $row_list['othername'];?> </a></td>
    <td><a href="view_stu.php?id=<?php echo $result['id']; ?>"><?php echo $row_list['phone']; ?></a></td>
    <td><a href="view_stu.php?id=<?php echo $result['id']; ?>"><?php echo $row_list['rank'];  ?></a></td>
  </tr>
   <?php } else { false;}
   
   $t_id = $result['user_id'];
	mysql_select_db($database_atbu_ee, $atbu_ee);
$query_list2 = "SELECT * FROM nonacademic_staff WHERE user_id = '$key'";
$list2 = mysql_query($query_list2, $atbu_ee) or die(mysql_error());
$row_list2 = mysql_fetch_assoc($list2);
$totalRows_list2 = mysql_num_rows($list2);

   if ($totalRows_list2 > 0) {
	   ?>
  <tr <?php if ($counter++ %2) { echo 'class="hilite"';} ?>>
    <td><?php echo $a++; ?></td>
    <td><a href="view_profile.php?lecturer=<?php echo $list2['user_id']; ?>"><?php echo $row_list['surname']; ?> </a></td>
    <td><a href="view_stu.php?id=<?php echo $result['id']; ?>"><?php echo $row_list2['othername'];?> </a></td>
    <td><a href="view_stu.php?id=<?php echo $result['id']; ?>"><?php echo $row_list2['phone']; ?></a></td>
    <td><a href="view_stu.php?id=<?php echo $result['id']; ?>"><?php echo $row_list2['rank'];  ?></a></td>
  </tr>
  <?php 
   }
    } 
}
 ?>

  </table>

										  </div>
                                          
                                          <div class="grid3">
						<h3>Structure of The Department</h3>
						<!--<div class="img-wrap"><figure><img src="images/org.png" alt=""></figure></div>-->
						
					</div>
				</div>
			</div>
		</div>
				
	</section>
	<div><?php require("footer.php"); ?></div>
</body>
</html>
