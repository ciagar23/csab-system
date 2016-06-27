<?php
if (!defined('WEB_ROOT')) {
	exit;
}

?> 
<p class="errorMessage">&nbsp;</p>
<form action="processUser.php?action=add" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">


 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">First Name</td>
   <td class="content"> <input name="txtFName" type="text" class="box" id="txtFName" size="50" maxlength="50"></td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Last Name</td>
   <td class="content"> <input name="txtLName" type="text" class="box" id="txtLName" size="50" maxlength="50"></td>
  </tr>
  
  <tr> 
   <td width="150" class="label">User Name</td>
   <td class="content"> <input name="txtUserName" type="text" class="box" id="txtUserName" size="20" maxlength="20"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Password</td>
   <td class="content"> <input name="txtPassword" type="password" class="box" id="txtPassword" value="" size="20" maxlength="20"></td>
      
  <tr> 
   <td width="150" class="label">Position</td>
   <td class="content">
   
   <select name="txtPosition" class="box">
     <option value=""> - Select Position - </option>
     <option>Dean</option>
     <option>IMC</option>
     <option>GSO</option>
     <option>President</option>
     <option>GSO Staff</option>
     <option>IMC Staff</option>
     <option>Faculty</option>
     <option>NTP</option>
     <option>STAKEHOLDER</option>
  
   </select>
   
   
  </td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Department</td>
   <td class="content"> 
   
      <select name="txtDepartment" class="box">
     <option value=""> - Select Department - </option>
     <option>BED</option>
     <option>CASE</option>
     <option>CABECS</option>
     <option>CON</option>
     <option>COE</option>
     <option value="SCHOOL ORG">SCHOOL ORGANIZATION</option>
  
   </select>
   
   </td>
 </table>
   
                       <br>
                       <br>
                       <br>
                       <br>     
 
 <div align="center" class="content"> 
  <input name="btnAddUser" type="button" id="btnAddUser" value="Add User" onClick="checkAddUserForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </div>
</form>