<?php
require_once '../library/config.php';
require_once './library/functions.php';

$errorMessage = '';

if (isset($_POST['txtUserName'])) {
	$result = doLogin();
	
	if ($result != '') {
		$errorMessage = $result;
	}
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSA-B Online Booking System</title>
<link rel="SHORTCUT ICON" href="<?php echo WEB_ROOT;?>admin/include/images/favicon.ico" />
<link href="<?php echo WEB_ROOT;?>admin/include/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WEB_ROOT;?>admin/include/colorbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/menu.js" ></script>
<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/include/colorbox/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){		
		$(".addProject").colorbox({width:"440px", inline:true, href:"#add-new-project"});
		$(".addMilestone").colorbox({width:"440px", inline:true, href:"#add-new-milestone"});		
		
	});
</script>
<title>CSAB- Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>

<div id="body-bg">
<div id="wrapper">

<font color="#FFFFFF"><h1><center>CSAB Institutional Online Booking System</center></h1></font>
	<div class="login">
   
    	 <form method="post" name="frmLogin" id="frmLogin">
    	<div class="formWrapper">
            <div class="label left" style="width:100px;">Username</div>
            <div class="inputWrapper left"><input name="txtUserName" type="text" id="txtUserName"></div>
            <div class="clear"></div>
        </div>
        <div class="formWrapper">
            <div class="label left" style="width:100px;">Password</div>
            <div class="inputWrapper left"><input name="txtPassword" type="password" id="txtPassword"></div>
            <div class="clear"></div>
        </div>
         <div class="inputWrapper"><input type="submit" value="Login"></div>
		</form>        
    </div>
</div>
    
   
</body>
</html>
 
 <?
if ($errorMessage !='')
{
?>
<script>
alert('<?php echo $errorMessage;?>');
</script>

<?
}
else
{
}
?>
