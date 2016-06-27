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


$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
		echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'admin/library/' . $script[$i]. '"></script>';
	}
}






$self = WEB_ROOT . 'admin/index.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSA-B Online Booking System V1</title>
<link rel="SHORTCUT ICON" href="<?php echo WEB_ROOT;?>admin/include/images/favicon.ico" />
<link href="<?php echo WEB_ROOT;?>admin/include/style.css" rel="stylesheet" type="<?php echo WEB_ROOT;?>admin/include/text/css" />
<link href="<?php echo WEB_ROOT;?>admin/include/colorbox.css" rel="stylesheet" media="screen" />
<script type="<?php echo WEB_ROOT;?>admin/include/text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/jquery-1.7.1.min.js"></script>
<script type="<?php echo WEB_ROOT;?>admin/include/text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/menu.js" ></script>
<script type="<?php echo WEB_ROOT;?>admin/include/text/javascript" src="<?php echo WEB_ROOT;?>admin/include/colorbox/jquery.colorbox.js"></script>


<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>library/common.js"></script>

<script>

	$(document).ready(function(){		
		$(".addProject").colorbox({width:"440px", inline:true, href:"#add-new-project"});
		$(".addMilestone").colorbox({width:"440px", inline:true, href:"#add-new-milestone"});		
		
	});
</script>
</head>
<body>
<div id="body-bg">
<div id="wrapper">
     <div id="header">
          <div class="left"><a title="CSA-B Booking system" href="<?php echo WEB_ROOT; ?>admin/"><img src="<?php echo WEB_ROOT;?>admin/include/images/logo1.png" alt="" /></a></div>
          <div class="accounts">
               <p>Hi <a href="#"><?php echo $fname; ?> <?php echo $lname; ?> 
                (<?php echo $position; ?> , <?php echo $department; ?>)</a>
               <a class="logout" href="<?php echo $self; ?>?logout">Log Out</a>
               </p> 
          </div> <!-- end of accounts -->
     </div> <!-- end of header -->
     <div id="staff-content-area">      
          <div class="tabs">                
               <div id="sideBar">
                    <p class="date"><?php echo date('M d, Y');?></p>     
                   
                   
<ul class="tabmenu">
<?php if ($position =='Faculty' || $position =='NTP')
	{
?>
<li><a href="<?php echo WEB_ROOT; ?>admin/reservation/index.php?view=reserve">Reservation</a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/myreservationhistory/"><span>My Reservation History</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/calendar/">CALENDAR</a></li>

<?php
	}
else if ($position =='GSO' || $position =='IMC')
	{
	if ($position =='GSO')
	{		
?>
<li><a href="<?php echo WEB_ROOT; ?>admin/category/index.php?catId=19"><span>GSO Category</span></a></li>
<?php }
else
{?>
<li><a href="<?php echo WEB_ROOT; ?>admin/category/index.php?catId=18"><span>IMC Category</span></a></li>
<?php 
}?>

<li><a href="<?php echo WEB_ROOT; ?>admin/reservation/index.php?view=reserve"><span>Reservation</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/myreservationhistory/"><span>My Reservation History</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/statistics/"><span>Statistics</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/borrowed/"><span>Return</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/service/"><span>Release</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/confirmation/"><span>Confirmation</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/reports/"><span>Reports</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/user/"><span>User</span></a></li>

<?php
}
else if ($position =='Dean' || $position =='President')
{		
?>
<li><a href="<?php echo WEB_ROOT; ?>admin/reservation/index.php?view=reserve"><span>Reservation</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/myreservationhistory/"><span>My Reservation History</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/confirmation/"><span>Confirmation</span></a></li>


<?php
        
}
else  if ($position =='GSO Staff' || $position =='IMC Staff')
{      
?>
<li><a href="<?php echo WEB_ROOT; ?>admin/category/"><span>Category</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/equipment/"><span>Equipment/Rooms</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/borrowed/"><span>Return</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/service/"><span>Release</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>

<?php
}
else
{       
?>        
<li><a href="<?php echo WEB_ROOT; ?>admin/" ><span>Home</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/reservation/index.php?view=reserve"><span>Reservation</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/reservationhistory/"><span>Reservation History</span></a></li>
<li><a href="<?php echo WEB_ROOT; ?>admin/calendar/"><span>Calendar</span></a></li>

<?php
}		
?>


<li><a href="<?php echo WEB_ROOT; ?>admin/user/index.php?view=changepassword"><span>Change Password</span></a></li>
</ul> 
                    
               </div> <!-- end of sideBar -->
    
               <div id="rightCol">                    
                    <div class="tabContent">                        
                        <ul id="staff-menu">
                            <li style="width:240px;">&nbsp;</li>
                            
                        </ul>    
         <div class="rightCol-inside">
                             <div class="tab">                                  
                                            
<?php require_once $content;?> 
    
                        
                                             </div>                          
                            
                        </div> <!-- end of rightCol-inside -->    
                        
                         
                        
                                        
                    </div> <!-- end of dashboard -->
                    
                    
 
                    <div class="clear"></div>                     
                    
               </div> <!-- end of rightCol -->         
          </div> <!-- end of tabs -->               
     </div> <!-- end of staff-content-area -->
     <div class="clear"></div>            
</div> <!-- end of wrapper -->
</div> <!-- end of body-bg -->

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
    <div id="add-new-project" class="lightbox-holder">
         <h4>Project Details</h4>
         <div class="lightbox-container">
              <table border="0" cellpadding="5" cellspacing="10">
                     <tr>
                         <td><label for="projname">Project Name</label></td>
                         <td><input type="text" class="width235" id="projname" name="" value="" /></td> 
                     </tr>
                     <tr>
                         <td><label for="share">Share with</label></td>
                         <td><select class="width249" id="share" name="share">
                                 <option value=""></option> 
                             </select>
                         </td> 
                     </tr>
                     <tr>
                         <td valign="top"><label>Start Date</label></td>
                         <td><input type="button" class="btn-prev"  value=""/>
                             <select class="select-date">
                                     <option value="#">Jun</option>
                             </select>
                             <select class="select-date">
                                     <option value="#">01</option>
                             </select>
                             <select class="select-date">
                                     <option value="#">2012</option>
                             </select> 
                             <input type="button" class="btn-next"  value=""/>
                         </td> 
                     </tr>
                     <tr>
                         <td valign="top"><label>Deadline</label></td>
                         <td><input type="button" class="btn-prev"  value=""/>
                             <select class="select-date">
                                     <option value="#">Jun</option>
                             </select>
                             <select class="select-date">
                                     <option value="#">01</option>
                             </select>
                             <select class="select-date">
                                     <option value="#">2012</option>
                             </select> 
                             <input type="button" class="btn-next"  value=""/>
                         </td> 
                     </tr>
                     <tr>
                         <td valign="top"><label for="notes">Notes</label></td>
                         <td><a href="#">+ Add Milestone</a></td> 
                     </tr>
                     <tr>
                         <td valign="top"><label for="notes">Notes</label></td>
                         <td><textarea name="notes" id="notes" class="width235"></textarea></td> 
                     </tr>
                     <tr>
                         <td><label for="priority">Priority</label></td>
                         <td><select class="width249" id="priority" name="priority">
                                 <option value=""></option> 
                             </select>
                         </td> 
                     </tr>
                     <tr>
                         <td colspan="2" class="alignRight"><input type="button" class="btn-red" value="Cancel" />
                               <input type="button" class="btn-green" value="Save" />
                         </td>
                     </tr>
              </table>
         </div> <!-- end of lightbox-container -->
    </div>
</div>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
    <div id="add-new-milestone" class="lightbox-holder">
         <h4>Add New Milestone</h4>
         <div class="lightbox-container">
              <table border="0" cellpadding="5" cellspacing="10">
                     <tr>
                         <td><label for="milestone">Milestone</label></td>
                         <td><input type="text" class="width235" id="milestone" name="" value="" /></td> 
                     </tr>
                     <tr>
                         <td><label for="Project">Project</label></td>
                         <td><select class="width249" id="Project" name="Project">
                                 <option value=""></option> 
                             </select>
                         </td> 
                     </tr>                     
                     <tr>
                         <td valign="top"><label>Deadline</label></td>
                         <td><input type="button" class="btn-prev"  value=""/>
                             <select class="select-date">
                                     <option value="#">Jun</option>
                             </select>
                             <select class="select-date">
                                     <option value="#">01</option>
                             </select>
                             <select class="select-date">
                                     <option value="#">2012</option>
                             </select> 
                             <input type="button" class="btn-next"  value=""/>
                         </td> 
                     </tr>                    
                     <tr>
                         <td valign="top"><label for="notes">Notes</label></td>
                         <td><textarea name="notes" id="notes" class="width235"></textarea></td> 
                     </tr>
                     <tr>
                         <td><label for="assigned">Assigned to</label></td>
                         <td><select class="width249" id="assigned" name="assigned">
                                 <option value=""></option> 
                             </select>
                         </td> 
                     </tr>
                     <tr>
                         <td colspan="2" class="alignRight"><input type="button" class="btn-red" value="Cancel" />
                               <input type="button" class="btn-green" value="Save" />
                         </td>
                     </tr>
              </table>
         </div> <!-- end of lightbox-container -->
    </div>
</div>

</body>
</html>