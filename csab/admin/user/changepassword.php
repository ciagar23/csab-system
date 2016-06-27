<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
$alert = (isset($_GET['alert']) && $_GET['alert'] != '') ? $_GET['alert'] : '';

$sql = "SELECT user_fname, user_lname, user_name, user_position, user_department
        FROM tbl_user
        WHERE user_name = '$session'";
$result = dbQuery($sql);		
extract(dbFetchAssoc($result));


?> 
<p class="errorMessage"><?php echo $errorMessage; ?></p>
<form action="processUser.php?action=changepass" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
    <tr> 
   <td width="150" class="label" height="50">User Name</td>
   <td class="content"> <?php echo $user_name; ?></td>
  </tr>
  
  
  <tr> 
   <td width="150" class="label" height="50">First Name</td>
   <td class="content"> <?php echo $user_fname; ?></td>
  </tr>
  
  <tr> 
   <td width="150" class="label" height="50">Last Name</td>
   <td class="content"><?php echo $user_lname; ?></td>
  </tr>

      
  <tr> 
   <td height="50" width="150" class="label">Position</td>
   <td class="content">
     <?php echo $user_position; ?>
   
   
  </td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Department</td>
   <td class="content">
   
<?php echo $user_department; ?>
   </td>
   
    
  <tr> 
   <td width="150" class="label" height="50">Password</td>
   <td class="content"> <input name="txtPassword" type="password" class="box" id="txtPassword" value="" size="20" maxlength="20"></td>    
  <tr> 
   <td width="150" class="label" height="50">Repeat Password</td>
   <td class="content"> <input name="txtPassword2" type="password" class="box" id="txtPassword2" value="" size="20" maxlength="20"></td>
 </table>
 <p align="center"> 
  <input name="btnModifyUser" type="button" id="btnModifyUser" value="Modify User" onClick="checkPassword();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
<?
if ($alert !='')
{
?>
<script>
alert('<?php echo $alert;?>');
</script>

<?
}
else
{
}
?>