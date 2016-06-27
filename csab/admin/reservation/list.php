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
		$bpurpose= $show['b_purpose'];
		$bdate= $show['b_bm'].'-'.$show['b_bd'].'-'.$show['b_by'].' to '.$show['b_rm'].'-'.$show['b_rd'].'-'.$show['b_ry'];
		$btime= $show['b_bh'].':'.$show['b_bmi'].' to '.$show['b_rh'].':'.$show['b_rmi'];
		$Bm=$show['b_bm'];
		$Bd=$show['b_bd'];
		$By=$show['b_by'];

?> 
<div class="table">
<table width="100%">
<tr>
<td valign="top" width="50%">



<table>
<tr width="30%">
<th align="left">Borrower:
<td> <?php echo $fname .' '. $lname;?>
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
<?php require_once 'list2.php';?>
</table>

<p>&nbsp;</p>

<td>
<form action="processReservation.php?action=addReservation" method="post"  name="frmListReservation" id="frmListReservation">

 <table border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="right">View Items in : 
    <select name="cboCategory" class="field" id="cboCategory" onChange="viewReservation(<?php echo $productId;?>);">
     <option selected>All Category</option>
	<?php echo $categoryList; ?>
   </select>
 </td>
 </tr>
</table>
<br>
 <table border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th width="75">Category</td>
   <th>Item Name</td>
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
   <td align="center"><?php echo $cat_name; ?></td>
   
<?
	$sql1 = "SELECT * FROM tbl_equipborrowed where e_eid='$pd_id' and e_by='$By' and e_bm='$Bm' and e_bd='$Bd'";
		$result1 = mysql_query($sql1);
		$show1 = mysql_fetch_array($result1);	
	$count = mysql_num_rows($result1);
	
		if ($count != 0)
	{
	
	?>
	<td><font color=red><?php echo $pd_name; ?> ( <?php echo $pd_code; ?> ) - not available
    <?	
	}
	else {
?>
   <td><a href="javascript:addBorrowed(<?php echo $productId; ?>, <?php echo $pd_id;?>, <?php echo $Bm;?>, <?php echo $Bd;?>, <?php echo $By;?>);">
   <?php echo $pd_name; ?> ( <?php echo $pd_code; ?> )</a></td>
   
  </tr>
  <?php
  }
  
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
 <tr>
 <td colspan="2" align="center"><br><br>
 
 <div class="content"><input name="btnAddUser" type="button"  value="Reserve" class="add-button" onClick="window.location.href = '../myreservationhistory/?alert=You Have successfully Made a Reservation'"></div>
 
 <p>&nbsp;</p>
</form>