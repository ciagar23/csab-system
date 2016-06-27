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
$rowsPerPage = 100;



$sql = "SELECT b_id, b_name, b_borrower, b_by, b_bm, b_bd
		 FROM tbl_borrowed
		WHERE b_cleared =0";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 
<div class="table">
&nbsp;
<form action="processReservation.php?action=addReservation" method="post"  name="frmListReservation" id="frmListReservation">

  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		$i += 1;
?>
 
 
 
 <p>
 * <?php echo $b_name;?> which borrowed by <?php echo $b_borrower;?> borrowed on <?php echo $b_by;?>-<?php echo $b_bm;?>-<?php echo $b_bd;?><br><br>
 
 </p>
  <?php
	} // end while
	
} else {



}
?>

 <p>&nbsp;</p>
</form>