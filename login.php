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

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "staff_profile.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_atbu_ee, $atbu_ee);
  
  $LoginRS__query=sprintf("SELECT user_id, username, password FROM login WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $atbu_ee) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  
  
  if ($loginFoundUser) {
     $loginStrGroup = "";
		mysql_select_db($database_atbu_ee, $atbu_ee);
		$query_user = sprintf("SELECT * FROM login WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));
	;
		$user = mysql_query($query_user, $atbu_ee) or die(mysql_error());
		$row_user = mysql_fetch_assoc($user);
		$totalRows_user = mysql_num_rows($user);
		
	$_SESSION['user_id'] = $row_user['user_id'];
	
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Log In</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	
	<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>

<body>

	<div><?php require("header.php"); ?></div>
	<section id="content">
    
		<div class="top">
        <div class="container">
				<div class="clearfix">
                
				  <div class="grid9 first">
      
     <figure>         
<!--LOGIN FORM-->
<form name="login-form" class="login-form" action="<?php echo $loginFormAction; ?>" method="POST">

	<!--HEADER-->
    <div class="header">
    <!--TITLE--><h1>Login Form</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Fill out the form below to login to Your Account.</span><!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME--><input name="username" type="text" class="input username" value="Username" onfocus="this.value=''" /><!--END USERNAME-->
    <!--PASSWORD--><input name="password" type="password" class="input password" value="Password" onfocus="this.value=''" /><!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><input type="submit" name="submit" value="Login" class="button" /><!--END LOGIN BUTTON-->
        </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->
     
	</figure>		
		</div>
        <div class="grid3">
           <h4>If You are unable to Login to this site, <wbr /> Contact the site administrator to get more information on how to resolve the issue. </h4>
            </div>
		</div>
        </div>
		</div>
	</section>
<div><?php require("footer.php"); ?></div>
</body>
</html>
<?php

?>
