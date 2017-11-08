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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP: Home</title>
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
					<section id="gallery">
						<div class="pics">
							<img src="images/slide1.png" alt="" width="495" height="329">
							<img src="images/slide3.png" alt="" width="495" height="329">
							<img src="images/slide2.png" alt="" width="495" height="329">
							<img src="images/slide4.png" alt="" width="495" height="329">
							<img src="images/slide5.png" alt="" width="495" height="329">
						</div>
						<a href="#" id="prev"></a>
						<a href="#" id="next"></a>
					</section>
					<section id="intro">
						<div class="inner">
                          
							<h2>ATBU-Department Of Electrical And Electronics Engineering</h2>
							<a href="#" class="extra-button">A.T.B.U Bauchi</a>
					  </div>
					</section>
				</div>
			</div>
		</div>
		<div class="middle">
			<div class="container">
				<div class="wrapper">
					<div class="grid3 first">
						<ul class="categories">
							<li><a href="index.php">HOME</a></li>
							<li><a href="academics.php">ACADEMICS</a></li>
							<li><a href="staff.php">STAFF</a></li>
							<li><a href="undergraduate_0.php">UNDERGRADUATE</a></li>
							<li><a href="#">ALUMNI </a></li>
							<li><a href="#">CONTACT US </a></li>
                            
							<!--<li><a href="#">Engineering and Construction</a></li>
							<li><a href="#">High Technology</a></li>
							<li><a href="#">Industrial Manufacturing</a></li>-->
						</ul>
					</div>
					<div class="grid9">
						<h2>Welcome To The Official Website Of  ATBU<br />Department Of Electrical And 
						  Electronics Engineering</h2>
						<p>The Electrical and Electronics Engineering Programme was approved in 1983 to offer courses in Electrical and Electronics Engineering in the former Federal University of Technology, Bauchi, now Abubakar Tafawa Balewa University, Bauchi.  The programme recorded her first intake of undergraduate and postgraduates in 1983 and 1987 respectively.  Students’ population has continued to grow with progressive consolidation in academic activities. More than 80% of the students’ intake into the Electrical/Electronics Engineering Programme came from the School of Science and Science Education of this university where the students undergo a one year pre-degree programme (100 level).  In 1998, the University Senate directed that the administration of all students including those of 100-level be done in their respective programmes.
Dr. S. Ososwki, a Reader of Electronics Engineering and some other Polish and Nigerian lecturers were some of the key staff who helped to start the programme and nurture it to grow.  Over the years the programme has expanded, new laboratories have been established. The Laboratories include Machines Laboratory, Control Engineering Lab, Microwave Engineering Lab., Digital and Analogue Electronics Engineering Laboratories, Microprocessor Lab and Telecommunications Laboratory.
The syllabus used by the programme up to 1989/90 session was developed based on the recommendations of the Electrical Engineering Department of the Ahmadu Bello University, Zaria.  Presently the NUC approved syllabus is being used for 100 to 500 levels. 
</p>
						
						<section class="images">
                        <h2>News & Events</h2>
							<figure><a href="#"><img src="images/1page-img1.jpg" alt="" width="159" height="120"></a>
                            <p> date</p>
                          <h3><?php echo $row_news['title']; ?></h3>
                          <p><a href="read.php?n_id=<?php echo $row_news['news_id']; ?>" class="more">Read More</a></p>
                          </figure>
							<figure><a href="#"><img src="images/1page-img2.jpg" alt=""></a></figure>
							<figure><a href="#"><img src="images/1page-img3.jpg" alt=""></a></figure>
                           
					  </section>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	<?php require("footer.php"); ?>
</body>
</html>
<?php
mysql_free_result($news);
?>
