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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form-editnews")) {
  $updateSQL = sprintf("UPDATE news SET newsCat=%s, title=%s, body=%s, `date`=%s WHERE news_id='$_GET[news_id]'",
                       GetSQLValueString($_POST['category'], "int"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['body'], "text"),
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_atbu_ee, $atbu_ee);
  $Result1 = mysql_query($updateSQL, $atbu_ee) or die(mysql_error());

  $updateGoTo = "news_dashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_news_cat = "SELECT * FROM news_category";
$news_cat = mysql_query($query_news_cat, $atbu_ee) or die(mysql_error());
$row_news_cat = mysql_fetch_assoc($news_cat);
$totalRows_news_cat = mysql_num_rows($news_cat);

$colname_news = "-1";
if (isset($_GET['news_id'])) {
  $colname_news = $_GET['news_id'];
}
mysql_select_db($database_atbu_ee, $atbu_ee);
$query_news = sprintf("SELECT * FROM news WHERE news_id = %s", GetSQLValueString($colname_news, "int"));
$news = mysql_query($query_news, $atbu_ee) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP:News &amp; Events Dashboard</title>
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

<link type="text/css" href="jq/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jq/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="jq/js/jquery-ui-1.8.21.custom.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#date').datepicker({dateFormat:'yy-mm-dd',changeMonth:true,changeYear:true,yearRange:'2003:2150'});
		});
	
	
	<!--end of date picker-->

	 </script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
</head>

<body>

	<div><?php require("header.php"); ?></div>
	<section id="content">
		<div class="top">
         
			<div class="container">
            <div><a href="news_dashboard.php" style="color: #00F;"> << Back </a></div>
                    <p>&nbsp;</p>
				<div class="clearfix">
					<div class="grid9 first">
                   
						        <!-- Table -->
          <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Edit Article           
            </h2>
          </div>
          <!-- End Box Head -->
          <form action="<?php echo $editFormAction; ?>" method="POST" name="form-editnews">
            <!-- Form -->
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
            <div class="form">
              <p> <span class="req">max 100 symbols</span>
                <label>Article Title <span>(Required Field)</span></label>
                <input name="title" type="text" class="field size1" id="title" value="<?php echo $row_news['title']; ?>" maxlength="100" />
              </p>
              <p class="inline-field">
                <label>Category</label>
                 <select name="category" class="field size3" id="category">
                 <?php do { ?>
             <option <?php if(isset($row_news['newsCat'])) { echo ($row_news['newsCat']== $row_news_cat['newsCat_id'] ? ' selected="selected" ' :''); } ?> value="<?php echo $row_news_cat['newsCat_id']; ?>"><?php echo ucfirst($row_news_cat['newsCat']); ?></option>
                  <?php } while($row_news_cat = mysql_fetch_assoc($news_cat));?>
                </select>
              </p>
              <p class="inline-field">
                <label>Date</label>
                <input type="text" id="date" name="date" value="<?php echo $row_news['date']; ?>"/>
                
              </p>
              <p> <span class="req">max 1000 symbols</span>
                <label>Content <span>(Required Field)</span></label>
                <textarea name="body" cols="30" rows="10" class="field size1" id="body"><?php echo $row_news['body']; ?></textarea>
              </p>
            </div>
            <!-- End Form -->
            <!-- Form Buttons -->
            <div class="buttons">
             
              <input type="submit" class="button" value="submit" />
            </div>
            <!-- End Form Buttons -->
            <input type="hidden" name="MM_insert" value="form-addnews">
            <input type="hidden" name="MM_update" value="form-editnews">
          </form>
        </div>
          <!-- Table -->
        </div>
					
					<div class="grid3">
                    <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Management</h2>
          </div>
          <!-- End Box Head-->
          <div class="box-content"> <a href="news_dashboard.php" class="button left"><span>Dash Board</span></a>
            <div class="cl">&nbsp;</div>
           <!-- <p class="select-all">
              <input type="checkbox" class="checkbox" />
              <label>select all</label>
            </p>-->
            <p><a href="#">Delete Selected</a></p>
            <!-- Sort -->
            <!--<div class="sort">
              <label>Sort by</label>
              <select class="field">
                <option value="">Title</option>
              </select>
              <select class="field">
                <option value="">Date</option>
              </select>
              <select class="field">
                <option value="">Author</option>
              </select>
            </div>-->
            <!-- End Sort -->
          </div>
        </div>
                  </div>
				</div>
			</div>
		</div>
		<div class="middle">
        <div class="container">
        <div class="clearfix">
        <div class="grid9 first">
			
        </div>
		  </div></div>
      </div>
		
	</section>
<div><?php require("footer.php"); ?></div>
</body>
</html>
<?php
mysql_free_result($news_cat);

mysql_free_result($news);
?>
