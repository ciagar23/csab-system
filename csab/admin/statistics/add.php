<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$catId = (isset($_GET['catId']) && $_GET['catId'] > 0) ? $_GET['catId'] : 0;

$categoryList = buildCategoryOptions($catId);
?> 
<p>&nbsp;</p>
<form action="processEquipment.php?action=addProduct" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr><td colspan="2" id="entryTableHeader">Add Product</td></tr>
  <tr> 
   <td width="150" class="label">Category</td>
   <td class="content"> <select name="cboCategory" id="cboCategory" class="box">
     <option value="" selected>-- Choose Category --</option>
<?php
	echo $categoryList;
?>	 
    </select></td>
  </tr>
  <tr> 
   <td width="150" class="label">Item Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="30" maxlength="100"></td>
  </tr>  
  <tr> 
   <td width="150" class="label">Item Code</td>
   <td class="content"> <input name="txtCode" type="text" class="box" id="txtCode" size="30" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Description</td>
   <td class="content"> <textarea name="mtxDescription" cols="70" rows="5" class="box" id="mtxDescription"></textarea></td>
  </tr>

  <tr> 
   <td width="150" class="label">Image</td>
   <td class="content"> <input name="fleImage" type="file" id="fleImage" class="box"> 
    </td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnAddProduct" type="button" id="btnAddProduct" value="Add Item" onClick="checkAddProductForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
