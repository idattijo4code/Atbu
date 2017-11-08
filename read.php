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

$colname_news = "-1";
if (isset($_GET['n_id'])) {
  $colname_news = $_GET['n_id'];
}
mysql_select_db($database_atbu_ee, $atbu_ee);
$query_news = sprintf("SELECT * FROM news WHERE news_id = %s LIMIT 1", GetSQLValueString($colname_news, "int"));
$news = mysql_query($query_news, $atbu_ee) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);

$colname_side = "-1";
if (isset($row_news['newsCat'])) {
  $colname_side = $row_news['newsCat'];
}
mysql_select_db($database_atbu_ee, $atbu_ee);
$query_side = sprintf("SELECT * FROM news WHERE newsCat = %s ORDER BY news_id DESC", GetSQLValueString($colname_side, "int"));
$side = mysql_query($query_side, $atbu_ee) or die(mysql_error());
$row_side = mysql_fetch_assoc($side);
$totalRows_side = mysql_num_rows($side);

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_side_title = "SELECT newsCat FROM news_category WHERE newsCat_id = '$row_news[newsCat]' LIMIT 1";
$side_title = mysql_query($query_side_title, $atbu_ee) or die(mysql_error());
$row_side_title = mysql_fetch_assoc($side_title);
$totalRows_side_title = mysql_num_rows($side_title);

?>
<!DOCTYPE html>
<html lang="en">
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
					
					<div class="grid9 first">
						<h2><?php echo ucfirst($row_news['title']); ?></h2>
                        <p><?php echo ucfirst($row_news['body']); ?></p>
										
											</div>
                                            
       <div class="grid3">
       
						<h2><?php echo ucfirst($row_side_title['newsCat']); ?></h2>
                        <?php do { ?>
						<span><a href="#"><?php echo ucfirst($row_side['title']); ?></a></span>
                        <?php } while($row_side = mysql_fetch_assoc($side));?>
						
					</div>
				</div>
			</div>
		</div>
					
		
	</section>
	<div><?php require("footer.php"); ?></div>
</body>
</html>
<?php
mysql_free_result($news);

mysql_free_result($side);

mysql_free_result($side_title);
?>
