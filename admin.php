<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Learning Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
		<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
</head>

<body>
<div class="container">
            <!-- Codrops top bar --><!--/ Codrops top bar -->
            <?php include("header.php"); ?>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                  <div id="wrapper" style="width: 600px;">
                    
                    <div id="login" class="animate form">
                    <h1> Staff Profile</h1>
                    <span style="border: 1px solid rgba(147, 184, 189,0.8);
	-webkit-box-shadow: 0pt 2px 5px rgba(105, 108, 109,  0.7),	0px 0px 8px 5px rgba(208, 223, 226, 0.4) inset;
	   -moz-box-shadow: 0pt 2px 5px rgba(105, 108, 109,  0.7),	0px 0px 8px 5px rgba(208, 223, 226, 0.4) inset;
	        box-shadow: 0pt 2px 5px rgba(105, 108, 109,  0.7),	0px 0px 8px 5px rgba(208, 223, 226, 0.4) inset;
	-webkit-box-shadow: 5px;
	-moz-border-radius: 5px;
		 border-radius: 5px; width: 150px; float: left; height: 200px; margin-right: 3px; ">
                    <img src="images/std.jpg" width="150" height="200" alt="image" /></span>
                    </span>
                    <span style="float: right; height: 250px; width: 370px;">
                    <h2 style="font-size: 27px;">Name</h2>
                    <h3>rank</h3>
                    
                    
                    <div id="TabbedPanels1" class="TabbedPanels">
                      <ul class="TabbedPanelsTabGroup">
                        <li class="TabbedPanelsTab" tabindex="0">Personal Info.</li>
                        <li class="TabbedPanelsTab" tabindex="0">Students</li>
                        <li class="TabbedPanelsTab" tabindex="0">Tab 3</li>
                                             </ul>
                      <div class="TabbedPanelsContentGroup">
                        <div class="TabbedPanelsContent">
                        <h2>Contact Information</h2>
                        
                        <h2>Primary Teaching Area</h2>
                        
                        <h2>Research Interests</h2>
                        
                        <h2>Education</h2>
                        
                        </div>
                        <div class="TabbedPanelsContent">
                        <h2><a href="#">-->Insert Result</a></h2>
                        <h2>View Students Records</h2>
                        <h2>Place Announcement</h2>
                        
                        
                        </div>
                        <div class="TabbedPanelsContent">Content 3</div>

                      </div>
                    </div>
                    
                    		</span>
                    
                                        </div>
                                        
                                        
                    
                    <!--<div id="login" class="animate form">
                            <form  action="" autocomplete="on"> 
                                <h1>Login</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Username </label>
                                    <input id="username" name="username" required type="text" placeholder="username"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p">Password </label>
                                    <input id="password" name="password" required type="password" placeholder="Password" /> 
                                </p>
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
								</p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
                                <p class="change_link">
									Unable to Log in ?
									<a href="#toregister" class="to_register">Click Here</a>
								</p>
                            </form>
                        </div>-->

                        <!--<div id="register" class="animate form">
                            <form  action="" autocomplete="on"> 
                                <h1> Registration Guidelines </h1> 
                                <p> 
                                  You must be a student or a staff of the Mathematical science department to be able to access this Application.
                                </p>
                                <p> 
                                   Contact the department to obtain your Log in username and password.
                                </p>
                                <p> 
                                    If you are having problem accessing your account, Please contact the site administrator in person to rectify your problem.
                                </p>
                                <p> 
                                You must abide by the rules and regulations of the school while using this application. The school/department can suspend any user from accessing this application if he/she is found Breaking any rule.
                                </p> 
                               <p class="signin button"> 
									<input type="submit" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and login </a>
								</p>
                            </form>
                        </div>-->
						
                    </div>
                </div>  
            </section>
    </div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html>