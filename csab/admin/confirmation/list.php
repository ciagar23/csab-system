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

$viewdepartment = 'and b_department='.'"'.$department.'"';
}
else if ($position == 'President')
{
$levelposition = 'b_president';

$viewdepartment = '';
}
else if ($position == 'IMC')
{
$levelposition = 'b_imc';

$viewdepartment = '';
}
else
{
$levelposition = 'b_gso';

$viewdepartment = '';
}




// for paging
// how many rows to show per page
$rowsPerPage = 5;

$sql = "SELECT b_id,b_eid,b_name,b_department,b_borrower,b_code,b_by ,b_bm ,b_bd ,b_bh ,b_bmi,b_ry ,b_rm ,b_rd ,b_rh ,b_rmi, b_purpose,b_class,
		b_dean, b_imc, b_president, b_roomno, b_subject, b_gso
        FROM tbl_borrowed where $levelposition=0 and b_gso !=2 $viewdepartment";
		
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

else if ($position == 'IMC')
{

	if($b_dean ==0)
	{
	$confirm = 'javascript:sorryDean('.$b_id.', '.$b_eid.');';
	}
	else 
	{
	$confirm = 'javascript:confirmIMC('.$b_id.');';
	}

	
	
}
else if ($position == 'President')
{

if($b_dean ==0)
	{
	$confirm = 'javascript:sorryDean('.$b_id.', '.$b_eid.');';
	}
	else if ($b_imc==0)
	{
	$confirm = 'javascript:sorryIMC('.$b_id.');';
	}
	else
	{
	$confirm = 'javascript:confirmPresident('.$b_id.');';
	}

}

else
{

	if ($b_dean==0)
	{
	$confirm = 'javascript:sorryDean('.$b_id.', '.$b_eid.');';
	//pati pa gid and president kag ang imc
	}

	else if ($b_imc==0)
	{
	$confirm = 'javascript:sorryIMC('.$b_id.', '.$b_eid.');';
	//pati pa gid and president kag ang imc
	}
	else if ($b_president==0)
	{
	$confirm = 'javascript:sorryPresident('.$b_id.', '.$b_eid.');';
	//pati pa gid and president kag ang imc
	}
	else
	{	

	$confirm = 'javascript:confirmGSO('.$b_id.', '.$b_eid.');';

	}
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
		$sql1 = "SELECT *
        FROM tbl_user where user_name='$b_borrower'";
		$result1 = mysql_query($sql1);
		$show = mysql_fetch_array($result1);	
		$firstname= $show['user_fname'];
		$lastname= $show['user_lname'];
		
		
		
		
		$i += 1;
?>
<table width="100%" border="0">
  <tr>
    <th  align=left width="20%">Borrower:</td>
    <td colspan="2"><?php echo $firstname.' '.$lastname;?></td>
  <tr>
    <th  align=left>Room Number:</td>
    <td colspan="2" width="313"><?php echo $b_roomno;?></td>
  </tr>
  <tr>
    <th  align=left>Class:</td>
    <td colspan="2"><?php echo $b_class;?></td>
  <tr>
    <th  align=left>Subject:</td>
    <td colspan="2"><?php echo $b_subject;?></td>
  </tr>
  <tr>
    <th  align=left>Item Name:</td>
    <td colspan="2"><?php echo $b_name;?></td>
  <tr>
    <th  align=left>Item Code:</td>
    <td colspan="2"><?php echo $b_code;?></td>
  </tr>
  <tr>
    <th  align=left>Date From:</td>
    <td colspan="3"><?php echo $b_by;?>-<?php echo $b_bm;?>-<?php echo $b_bd;?> (<?php echo $b_bh;?>:<?php echo $b_bmi;?>) To:	<?php echo $b_ry;?>-<?php echo $b_rm;?>-<?php echo $b_rd;?> (<?php echo $b_rh;?>:<?php echo $b_rmi;?>)</td>

  <tr>
    <th  align=left colspan="3">Purpose: <?php echo $b_purpose;?></td>  </tr>
  <tr>
    <th  align=left>Approved by:</td>
    
        <?php 
	if ($b_department =='')
	{

	}
	else
	{
	?>
     
    <th  align=left  colspan="2">Dean (<?php echo $b_dean;?> )</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <?php 
	
	}
	
	?>
    <th  align=left  colspan="2">IMC: (<?php echo $b_imc;?>)</td>
    </tr>
    <?php 
	if ($b_eid ==1)
	{
	?>
    
    
  <tr>
    <td>&nbsp;</td>
    <th  align=left colspan="2">President (<?php echo $b_president;?>)</td>
    </tr>
    <?php
    }
	else
	{
	}
	?>
    
    
  <tr>
    <th  align=left>Approve this Reservation?</td>
   
    
    
  <td ><h3><div class="pagging"><a href="<?php echo $confirm;?>">Yes</a></div></td>
  <td ><h3><div class="pagging"><a href="javascript:disapprove(<?php echo $b_id;?>,<?php echo $b_eid;?>)">No</a></div></td>
</div>
 
 
</table>

<br>
<hr>
<br>


  <?php
	} // end while
?>
  <tr> 
   <td colspan="2" align="center">
   <?php 
echo $pagingLink;
   ?></td>
  </tr>
<?php	
} else {
?>
  <tr> 
   <td colspan="2" align="center">No Items Yet</td>
  </tr>
  <?php
}
?>

 </table>
 <p>&nbsp;</p>
</form>