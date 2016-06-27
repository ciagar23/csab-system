<?php
if (!defined('WEB_ROOT')) {
	exit;
}


		

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
$successMessage = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';

if ($errorMessage == '')
{
$errorMessage = '';
}
else
{
$errorMessage = '<div class="msg msg-error">
			<p><strong>'.$errorMessage.'</strong></p>
		</div>';
}


if ($successMessage == '')
{
$successMessage = '';
}
else
{
$successMessage = '<div class="msg msg-ok">
			<p><strong>'.$successMessage.'</strong></p>
		</div>';
}


$session = $_SESSION["username"];

$sql = "SELECT *
        FROM tbl_user where user_name='$session'";
		$result = mysql_query($sql);
		$show = mysql_fetch_array($result);	
		$fname= $show['user_fname'];
		$lname= $show['user_lname'];
		$position= $show['user_position'];
		$department = $show['user_department'];






$self = WEB_ROOT . 'admin/index.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "">
<html>
<head>
<title><?php echo $pageTitle; ?></title>

	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo WEB_ROOT;?>admin/include/css/style.css" type="text/css" media="all" />
<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>library/common.js"></script>
<?php
$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
		echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'admin/library/' . $script[$i]. '"></script>';
	}
}
?>

<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="<?php echo WEB_ROOT; ?>admin/">CSAB Institutional Online Booking System</a></h1>
			<div id="top-navigation">
				Welcome <a href="#"><strong><?php echo $fname; ?> <?php echo $lname; ?> 
                (<?php echo $position; ?> , <?php echo $department; ?>)</strong></a>
				<span>|</span>
				<a href="#">Help</a>
				<span>|</span>
				<a href="#">Profile Settings</a>
				<span>|</span>
				<a href="<?php echo $self; ?>?logout">Log out</a>
			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
        <?php if ($position =='Faculty' || $position =='NTP')
		{
        
		?>
        
		<!-- teacher -->
		<div id="navigation">
			<ul>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/" ><span>Home</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/reservation/"><span>Reservation</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
        <?php
        }
		else if ($position =='GSO' || $position =='IMC')
		{
		
		?>
        
        
        		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/" ><span>Home</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/category/"><span>Category</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/equipment/"><span>Equipment/Rooms</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/reservation/"><span>Reservation</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/statistics/"><span>Statistics</span></a></li>
			    <li><a href="#"><span>Borrowed</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/confirmation/"><span>Confirmation</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/user/"><span>User</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
        
        
        <?php
        
		}else if ($position =='Dean' || $position =='President')
		{
		
		?>
        
        
        		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/" ><span>Home</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/reservation/"><span>Reservation</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/confirmation/"><span>Confirmation</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
        
        
        <?php
        
		}
		else  if ($position =='GSO Staff' || $position =='IMC Staff')
		{
        
		?>
        
	      		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/" ><span>Home</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/category/"><span>Category</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/equipment/"><span>Equipment/Rooms</span></a></li>
			    <li><a href="#"><span>Borrowed</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
        
        
        
        
        <?php
        }
		else
		{
        
		?>
        
		<!-- teacher -->
		<div id="navigation">
			<ul>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/" ><span>Home</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/reservation/"><span>Reservation</span></a></li>
			    <li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
        <?php
        }
	
		
		?>
        
        
        
	</div>
</div>
<!-- End Header -->


<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav 
		<div class="small-nav">
			<a href="#">Dashboard</a>
			<span>&gt;</span>
			Current Articles
		</div>
	 End Small Nav -->
		
	<!-- diri naun ang error message -->
    
    
    
    		<!-- Message Error -->
		<?php echo $errorMessage;?>
		<?php echo $successMessage;?>
		<!-- End Message Error -->
    
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
							<!-- Box -->
				<div class="box">
                
               
                
                
                
                <!-- Box Head --> 
                <form action="index.php" method="get" enctype="multipart/form-data" name="frmsearch" id="frmsearch">
					<div class="box-head">
						<h2 class="left"><?php echo $pageTitle; ?></h2>
						<div class="right">
							<label>search articles</label>
                           
							<input type="text" name="search" class="field small-field" />
							<input type="submit" class="button" value="search" />
                            
						</div>
					</div></form>
					<!-- End Box Head -->	
                    
               <?php
require_once $content;	 
?> 
                
               
                    
                    </div>
					
				</div>
				<!-- End Box -->
                
                
                

			</div>
			<!-- End Content -->
			
		
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span class="left">&copy; 2012 - GSO</span>
		<span class="right">
			
		</span>
	</div>
</div>
<!-- End Footer -->
	
</body>
</html>