<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$productId = isset($_GET['productId']) ? $_GET['productId'] : 0;
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

$sql = "SELECT pd_id, c.cat_id, cat_name, pd_name, pd_code, pd_thumbnail, pd_stat
        FROM tbl_equipment p, tbl_category c
		WHERE p.cat_id = c.cat_id $sql2
		ORDER BY pd_name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

$sqllist = "SELECT *
        FROM tbl_borrowed where b_id='$productId'";
		$resultlist = mysql_query($sqllist);
		$show = mysql_fetch_array($resultlist);	
		$broomno= $show['b_roomno'];
		$bclass= $show['b_class'];
		$bsubject= $show['b_subject'];
		$bborrower= $show['b_borrower'];
		$bpurpose= $show['b_purpose'];
		$bdate= $show['b_bm'].'-'.$show['b_bd'].'-'.$show['b_by'].' to '.$show['b_rm'].'-'.$show['b_rd'].'-'.$show['b_ry'];
		$btime= $show['b_bh'].':'.$show['b_bmi'].' to '.$show['b_rh'].':'.$show['b_rmi'];
		$Bm=$show['b_bm'];
		$Bd=$show['b_bd'];
		$By=$show['b_by'];

$sql1 = "SELECT *
        FROM tbl_user where user_name='$bborrower'";
		$result1 = mysql_query($sql1);
		$show = mysql_fetch_array($result1);	
		$firstname= $show['user_fname'];
		$lastname= $show['user_lname'];


?> 
<div class="table">
<table width="100%">
<tr>
<td valign="top" width="50%">



<table>
<tr width="30%">
<th align="left">Borrower:
<td> <?php echo $firstname .' '. $lastname;?>
<tr>
<th align="left">Location:
<td> <?php echo $broomno;?>
<tr>
<th align="left">Class:
<td> <?php echo $bclass;?>
<tr>
<th align="left">Purpose:
<td> <?php echo $bpurpose;?>
<tr>
<th align="left">Date:
<td> <?php echo $bdate;?>
<tr>
<th align="left">Time:
<td> <?php echo $btime;?>
<tr>
<th align="left" valign="top">borrowed:
<td>



<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$search = (isset($_GET['search']) && $_GET['search'] > '') ? $_GET['search'] : '';

$sqlq = "SELECT e_id, e_bid, e_eid from tbl_equipborrowed where e_bid=$productId";
$resultq = dbQuery($sqlq);

?> 


					<!-- Table -->
					<div class="table">
<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">

<?php
while($rowq = dbFetchAssoc($resultq)) {
	extract($rowq);
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	
	$i += 1;
	
	$sqla = "SELECT pd_name
        FROM tbl_equipment where pd_id=$e_eid";
		$resulta = mysql_query($sqla);
		$shows = mysql_fetch_array($resulta);	
		$equipname= $shows['pd_name'];
	
	
	
	
?>
<?php echo $equipname; ?>, 
<?php
} // end while

?>
</form>
</div>


</table>
