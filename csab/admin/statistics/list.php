<?php
if (!defined('WEB_ROOT')) {
	exit;
}


if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND p.cat_id = $catId";
	$queryString = "catId=$catId";
} else {
	$catId = 0;
	$sql2  = '';
	$queryString = '';
}

// for paging
// how many rows to show per page
$rowsPerPage = 5;

$sql = "SELECT pd_id, c.cat_id, cat_name, pd_name, pd_code, pd_thumbnail
        FROM tbl_equipment p, tbl_category c
		WHERE p.cat_id = c.cat_id $sql2
		ORDER BY pd_name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 
<p>&nbsp;</p>
<div class="table">
<form action="processProduct.php?action=addProduct" method="post"  name="frmListProduct" id="frmListProduct">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="right">View Items in : 
    <select name="cboCategory" class="field" id="cboCategory" onChange="viewProduct();">
     <option selected>All Category</option>
	<?php echo $categoryList; ?>
   </select>
 </td>
 </tr>
</table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th>Item Name</td>
   <th width="75">Thumbnail</td>
   <th width="75">Category</td>
   <th width="70">Modify</td>
   <th width="70">Delete</td>
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($pd_thumbnail) {
			$pd_thumbnail = WEB_ROOT . 'images/product/' . $pd_thumbnail;
		} else {
			$pd_thumbnail = WEB_ROOT . 'images/no-image-small.png';
		}	
		
		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><h3><a href="index.php?view=detail&productId=<?php echo $pd_id; ?>"><?php echo $pd_name; ?> ( <?php echo $pd_code; ?> )</a></td>
   <td width="75" align="center"><img src="<?php echo $pd_thumbnail; ?>"></td>
   <td width="75" align="center"><h3><?php echo $cat_name; ?></td>
   <td width="70" align="center"><h3><a href="javascript:modifyProduct(<?php echo $pd_id; ?>);" class="ico edit">Modify</a></td>
   <td width="70" align="center"><h3><a href="javascript:deleteProduct(<?php echo $pd_id; ?>, <?php echo $catId; ?>);" class="ico del">Delete</a></td>
  </tr>
  <?php
	} // end while
?>
  <tr> 
   <td colspan="5" align="center">
 

   <?php 
echo $pagingLink;
   ?>
   
   </td>
  </tr>
<?php	
} else {
?>
  <tr> 
   <td colspan="5" align="center">No Items Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddProduct" type="button" id="btnAddProduct" value="Add Item" class="add-button" onClick="addProduct(<?php echo $catId; ?>)"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>

