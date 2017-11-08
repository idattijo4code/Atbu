<?php require_once('Connections/atbu_ee.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();
}

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form-addnews")) {
  $insertSQL = sprintf("INSERT INTO news (user_id, newsCat, title, body, `date`) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['category'], "int"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['body'], "text"),
                       GetSQLValueString($_POST['date'], "date"));

  mysql_select_db($database_atbu_ee, $atbu_ee);
  $Result1 = mysql_query($insertSQL, $atbu_ee) or die(mysql_error());

  $insertGoTo = "news_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


mysql_select_db($database_atbu_ee, $atbu_ee);
$query_news_cat = "SELECT * FROM news_category";
$news_cat = mysql_query($query_news_cat, $atbu_ee) or die(mysql_error());
$row_news_cat = mysql_fetch_assoc($news_cat);
$totalRows_news_cat = mysql_num_rows($news_cat);
?>
<?php 
if (array_key_exists('submit', $_POST)) {
$to = 'dee@gmail.com';	
$subject = 'Feedback from Deaprtment Website';

// list expected fields
$expected = array('name', 'email', 'comments');
// set required fields
$required = array('name', 'comments');
// create empty array for any missing fields
$missing = array();

// assume that there is nothing suspect
$suspect = false;
// create a pattern to locate suspect phrases
$pattern = '/Content-Type:|Bcc:|Cc:/i';

// function to check for suspect phrases
function isSuspect($val, $pattern, &$suspect) {
// if the variable is an array, loop through each element
// and pass it recursively back to the same function
if (is_array($val)) {
foreach ($val as $item) {
isSuspect($item, $pattern, $suspect);
}
}
else {
// if one of the suspect phrases is found, set Boolean to true
if (preg_match($pattern, $val)) {
$suspect = true;
}
}
}
// check the $_POST array and any subarrays for suspect content
isSuspect($_POST, $pattern, $suspect);

if ($suspect) {
$mailSent = false;
unset($missing);
}
else {

//User Input
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
}

// validate the email address
if (!empty($email)) {
// regex to ensure no illegal characters in email address
$checkEmail = '/^[^@]+@[^\s\r\n\'";,@%]+$/';
// reject the email address if it doesn't match
if (!preg_match($checkEmail, $email)) {
array_push($missing, 'email');
}
}


//build message
// go ahead only if all required fields OK
if (!$suspect && empty($missing)) {
// build the message
$message = "Name: $name\n\n";
$message .= "Email: $email\n\n";
$message .= "Comments: $comments";
// limit line length to 70 characters
$message = wordwrap($message, 70);



// send it
$mailSent = mail($to, $subject, $message);
if ($mailSent) {
// $missing is no longer needed if the email is sent, so unset it
unset($missing);
}
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ATBU-EEP:Contact Us</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">

	<link rel="stylesheet" href="css/jquery-ui-1.8.5.custom.css" type="text/css" media="all">
	
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
                <?php
if ($_POST && isset($missing)) {
?>
<p class="warning">Please complete the missing item(s) indicated.</p>
<?php
}
elseif ($_POST && !$mailSent) {
?>
<p class="warning">Sorry, there was a problem sending your message.
Please try later.</p>
<?php
}
elseif ($_POST && $mailSent) {
?>
<p><strong>Your message has been sent. Thank you for your feedback.
</strong></p>
<?php } ?>
                  <div style=" width: 200px; padding: 5px; font-size: 13px;">
                   ATBU - Department  of Electrical And Electronics Engineering.
                   P.M.B 111, Bauchi - Nigeria. <br />
                   <strong>Website:</strong> xxx.com<br />
                   <strong>E-mail:</strong> <br />
                   <strong>Tel:</strong> <br />
                   </div>
                    
                    
					<h3 style=" text-decoration: underline;"><strong>You can also contact us by filling the contact form  below:</strong></h3>
                    <form action="" method="post" name="feedback"><div>
                    <span>Name:<?php
if (isset($missing) && in_array('name', $missing)) { ?>
<span class="warning">Please enter your name</span><?php } ?><br />
                   
                    <input type="text" name="name" size="35" <?php if (isset($missing)) {
echo 'value="'.htmlentities($_POST['name']).'"';
} ?> /></span><br />
                   
                    
                    <span>Email:<?php
if (isset($missing) && in_array('email', $missing)) { ?>
<span class="warning">Please enter your E-mail</span><?php } ?><br />
                 
                    <input name="email" type="text" size="35" <?php if (isset($missing)) {
echo 'value="'.htmlentities($_POST['email']).'"';
} ?>><br />
                 
                    
                    
                    <span>Comments:<?php
if (isset($missing) && in_array('comments', $missing)) { ?>
<span class="warning">Please enter your Comment</span><?php } ?></span><br />
                    
                    <textarea name="comments" cols="45" rows="6" id="comments"><?php if (isset($missing)) { echo htmlentities($_POST['comments']);
} ?></textarea></span><br />
                    
                    <span style="float: right; margin-right: 50%;"><input name="submit" type="submit" value="Send Message"></span>
                    </div>
				  </div></form>
					
					<div class="grid3">
                    
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
?>
