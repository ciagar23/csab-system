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



if ($position == 'Dean')
{
$levelposition = 'b_dean';
}
else if ($position == 'President')
{
$levelposition = 'b_president';
}
else if ($position == 'IMC')
{
$levelposition = 'b_imc';
}
else
{
$levelposition = 'b_gso';
}





// for paging
// how many rows to show per page
$rowsPerPage = 5;

$sql = "SELECT b_id,b_eid,b_name,b_borrower,b_code,b_by ,b_bm ,b_bd ,b_bh ,b_bmi,b_ry ,b_rm ,b_rd ,b_rh ,b_rmi, b_purpose,b_class,
		b_dean, b_imc, b_president, b_roomno, b_subject, b_gso
        FROM tbl_borrowed where $levelposition=0";
		
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 
<div class="table">
<p>&nbsp;</p>
<form action="processReservation.php?action=addReservation" method="post"  name="frmListReservation" id="frmListReservation">

<br>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);



if ($position == 'Dean')
{
$confirm = 'javascript:confirmDean('.$b_id.');';
}
else if ($position == 'President')
{
$confirm = 'javascript:confirmPresident('.$b_id.');';
}
else if ($position == 'IMC')
{
$confirm = 'javascript:confirmIMC('.$b_id.');';
}
else if ($position == 'IMC')
{
$confirm = 'javascript:confirmIMC('.$b_id.');';
}
else
{
$confirm = 'javascript:confirmGSO('.$b_id.', '.$b_eid.');';
}




//change to the word approved

if ($b_dean == 1)
{
$b_dean = '<font color=green>Approved</font>';
}
else
{
$b_dean = '<font color=red>Waiting for Confirmation</font>';
}

if ($b_president == 1)
{
$b_president = '<font color=green>Approved</font>';
}
else
{
$b_president = '<font color=red>Waiting for Confirmation</font>';
}

if ($b_imc == 1)
{
$b_imc = '<font color=green>Approved</font>';
}
else
{
$b_imc = '<font color=red>Waiting for Confirmation</font>';
}





	
	

		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
?>
<table width="100%" border="0">
  <tr>
    <th width="176">Borrower:</td>
    <td><?php echo $b_borrower;?></td>
    <th width="137">Room Number:</td>
    <td width="313"><?php echo $b_roomno;?></td>
  </tr>
  <tr>
    <th>Class:</td>
    <td><?php echo $b_class;?></td>
    <th>Subject:</td>
    <td><?php echo $b_subject;?></td>
  </tr>
  <tr>
    <th>Item Name:</td>
    <td><?php echo $b_name;?></td>
    <th>Item Code:</td>
    <td><?php echo $b_code;?></td>
  </tr>
  <tr>
    <th>Date From:</td>
    <td><?php echo $b_by;?>-<?php echo $b_bm;?>-<?php echo $b_bd;?></td>
    <th>To:</td>
    <td><?php echo $b_ry;?>-<?php echo $b_rm;?>-<?php echo $b_rd;?></td>
  </tr>
  <tr>
    <th>Time From:</td>
    <td><?php echo $b_bh;?>:<?php echo $b_bmi;?></td>
    <th>To:</td>
    <td><?php echo $b_rh;?>:<?php echo $b_rmi;?></td>
  </tr>
  <tr>
    <th colspan="4">Purpose: <?php echo $b_purpose;?></td>  </tr>
  <tr>
    <th>Approved by:</td>
    <th>Dean:</td>
    <td colspan="2"><?php echo $b_dean;?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <th>IMC</td>
    <td colspan="2"><?php echo $b_imc;?></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <th>President</td>
    <td colspan="2"><?php echo $b_president;?></td>
    </tr>
  <tr>
    <th>Approve this Reservation?</td>
  <td ><h3><div class="pagging"><a href="<?php echo $confirm;?>">Yes</a></div></td>
 </td>
    <td>&nbsp;</td>
    <td width="18">&nbsp;</td>
  </tr>
</table>

<br>
<hr>
<br>


  <?php
	} // end while
?>
  <tr> 
   <td colspan="4" align="center">
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