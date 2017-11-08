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
$query_news = "SELECT * FROM news ORDER BY news_id DESC";
$news = mysql_query($query_news, $atbu_ee) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);

if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP: News &amp; Events</title>
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
					
					<div class="grid11">
						<h2>News</h2>
                      <?php 
						  
						  mysql_select_db($database_atbu_ee, $atbu_ee);
$query_news = "SELECT * FROM news WHERE newsCat = 1";
$news = mysql_query($query_news, $atbu_ee) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);

						   do { ?>
						<div class="img-box">
                        <figure><img src="images/1page-img3.jpg" />
                        <h3><?php echo ucfirst($row_news['title']); ?></h3>
                        <?php echo $row_news['body']; ?>
                        <br /><a href="read.php?n_id=<?php echo $row_news['news_id']; ?>" class="more">Read More </a>
                        </figure>
                        </div>
                             <?php } while($row_news = mysql_fetch_assoc($news));
					  
							  ?>                 
						
											</div>
				</div>
			</div>
		</div>
		<div class="middle">
			<div class="container">
				<div class="clearfix">
					
					<div class="grid11">
						<h2>Events</h2>
						<?php mysql_select_db($database_atbu_ee, $atbu_ee);
$query_news1 = "SELECT * FROM news  WHERE newsCat = 2";
$news1 = mysql_query($query_news1, $atbu_ee) or die(mysql_error());
$row_news1 = mysql_fetch_assoc($news1);
$totalRows_news1 = mysql_num_rows($news1);
						  
						   do { ?>
						<div class="img-box">
                        <figure><img src="images/1page-img3.jpg" />
                        <h3><?php echo ucfirst($row_news1['title']); ?></h3>
                        <?php echo $row_news1['body']; ?>
                        <br /><a href="read.php?n_id=<?php echo $row_news1['news_id']; ?>" class="more">Read More </a>
                        </figure>
                        </div>
                             <?php } while($row_news = mysql_fetch_assoc($news1));
					 
							  ?>       
				</div>
			</div>
		</div>
		
	</section>
	<div><?php require("footer.php"); ?></div>
</body>
</html>
<?php
mysql_free_result($news);
?>
