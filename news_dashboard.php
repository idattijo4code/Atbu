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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_board = 10;
$pageNum_board = 0;
if (isset($_GET['pageNum_board'])) {
  $pageNum_board = $_GET['pageNum_board'];
}
$startRow_board = $pageNum_board * $maxRows_board;

mysql_select_db($database_atbu_ee, $atbu_ee);
$query_board = "SELECT * FROM news";
$query_limit_board = sprintf("%s LIMIT %d, %d", $query_board, $startRow_board, $maxRows_board);
$board = mysql_query($query_limit_board, $atbu_ee) or die(mysql_error());
$row_board = mysql_fetch_assoc($board);

if (isset($_GET['totalRows_board'])) {
  $totalRows_board = $_GET['totalRows_board'];
} else {
  $all_board = mysql_query($query_board);
  $totalRows_board = mysql_num_rows($all_board);
}
$totalPages_board = ceil($totalRows_board/$maxRows_board)-1;

$queryString_board = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_board") == false && 
        stristr($param, "totalRows_board") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_board = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_board = sprintf("&totalRows_board=%d%s", $totalRows_board, $queryString_board);

if (!isset($_SESSION)) {
	session_start();
}
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
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
</head>

<body>

	<div><?php require("header.php"); ?></div>
	<section id="content">
		<div class="top">
			<div class="container">
            <div><a href="staff_profile.php" style="color:#00F;"> << My Profile </a></div>
                    <p>&nbsp;</p>
				<div class="clearfix">
					<div class="grid9 first">
						<div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2 class="left">Current Articles</h2>
            
          </div>
          <!-- End Box Head -->
          <!-- Table -->
          <div class="table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="13"><input type="checkbox" class="checkbox" /></th>
                <th>Title</th>
                <th>Date</th>
                <th>Category</th>
                <th width="110" class="ac">Content Control</th>
              </tr>
              <?php do { ?>
              <tr>
                <td><input type="checkbox" class="checkbox" /></td>
                <td><h3><a href="#"><?php echo ucfirst($row_board['title']); ?>.</a></h3></td>
                <td><?php echo $row_board['date']; ?></td>
                <td><?php if($row_board['newsCat']==1) { echo "News";} elseif ($row_board['newsCat']==2) {echo "Events";} ?></td>
                <td><a href="#" class="ico del">Delete</a><a href="edit_news.php?news_id=<?php echo $row_board['news_id']; ?>" class="ico edit">Edit</a></td>
              </tr>
              <?php } while($row_board = mysql_fetch_assoc($board));?>
              
            </table>
            <!-- Pagging -->
            <div class="pagging">
              <div class="left">Showing <?php echo ($startRow_board + 1) ?> to <?php echo min($startRow_board + $maxRows_board, $totalRows_board) ?> of <?php echo $totalRows_board ?> </div>
              <div class="right">
                <table border="0">
                  <tr>
                    <td><?php if ($pageNum_board > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_board=%d%s", $currentPage, 0, $queryString_board); ?>">First</a>
                        <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_board > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_board=%d%s", $currentPage, max(0, $pageNum_board - 1), $queryString_board); ?>">Previous</a>
                        <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_board < $totalPages_board) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_board=%d%s", $currentPage, min($totalPages_board, $pageNum_board + 1), $queryString_board); ?>">Next</a>
                        <?php } // Show if not last page ?></td>
                    <td><?php if ($pageNum_board < $totalPages_board) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_board=%d%s", $currentPage, $totalPages_board, $queryString_board); ?>">Last</a>
                        <?php } // Show if not last page ?></td>
                  </tr>
                </table>
              </div>
              
            </div>
            <!-- End Pagging -->
          </div>
          <!-- Table -->
        </div>
					</div>
					<div class="grid3">
                    <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2>Management</h2>
          </div>
          <!-- End Box Head-->
          <div class="box-content"> <a href="add_news.php" class="add-button"><span>Add new Article</span></a>
            <div class="cl">&nbsp;</div>
            <p class="select-all">
              <input type="checkbox" class="checkbox" />
              <label>select all</label>
            </p>
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
				
	</section>
<div><?php require("footer.php"); ?></div>
</body>
</html>
<?php
mysql_free_result($board);
?>
