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
<a href="javascript:deleteBorrowed(<?php echo $productId; ?>,<?php echo $e_id; ?>);" class="ico del"> <?php echo $equipname; ?></a>, 
<?php
} // end while

?>
</form>
</div>