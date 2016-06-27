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

$sql = "SELECT pd_id, c.cat_id, cat_name, pd_name, pd_code, pd_thumbnail, pd_stat
        FROM tbl_equipment p, tbl_category c
		WHERE p.cat_id = c.cat_id $sql2
		ORDER BY pd_name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 
<div class="table">
<p>&nbsp;</p>
<form action="processReservation.php?action=addReservation" method="post"  name="frmListReservation" id="frmListReservation">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="right">View Items in : 
    <select name="cboCategory" class="field" id="cboCategory" onChange="viewReservation();">
     <option selected>All Category</option>
	<?php echo $categoryList; ?>
   </select>
 </td>
 </tr>
</table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th width="75">Category</td>
   <th>Item Name</td>
   <th width="150">Status</td>
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($pd_stat == 0)
{
$pd_stat1 = '<font color=green>Available</font>';
}
else if ($pd_stat == 1)
{
$pd_stat1 = '<font color=blue>Pending</font>';
}
else

{
$pd_stat1 = '<font color=red>Not Available</font>';
}

		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td width="75" align="center"><h3><?php echo $cat_name; ?></td>
   <td><h3><?php echo $pd_name; ?> ( <?php echo $pd_code; ?> )</h3></td>

   <td width="70" align="center"><h3><a href="javascript:modifyReservation(<?php echo $pd_id; ?>);" >Reserve</a></td>
   
  </tr>
  <?php
	} // end while
?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
echo $pagingLink;
   ?></td>
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

 </table>
 <p>&nbsp;</p>
</form>