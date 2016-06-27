<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$search = (isset($_GET['search']) && $_GET['search'] > '') ? $_GET['search'] : '';
$alert = (isset($_GET['alert']) && $_GET['alert'] > '') ? $_GET['alert'] : '';

$sql = "SELECT b_id,b_name,b_borrower, b_roomno,b_ry,b_rd,b_rm,b_rh,b_rmi, b_cleared
        FROM tbl_borrowed
		WHERE b_borrower='$session'";
$result = dbQuery($sql);

?> 


					<!-- Table -->
					<div class="table">
<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">


 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th width="120">borrowed by:</td>
   <th width="120">location:</td>
   <th width="120">date/time return:</td>
   <th>View:</td>
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	
	if ($b_cleared ==1)
	{
	$status = '<font color=red>Out</font>';
	}
	else
	{
	$status ='<font color=green>in</font>';
	}
	
	$i += 1;
?>
  <tr> 
   <td width="120" align="center"><?php echo $fname.' '.$lname; ?></td>
   <td width="120" align="center"><?php echo $b_roomno; ?></td>
   <td width="120" align="center"><?php echo $b_rm; ?>-<?php echo $b_rd; ?>-<?php echo $b_ry; ?> | <?php echo $b_rh; ?>:<?php echo $b_rmi; ?></td>
   <td width="120" align="center"><a href="index.php?view=detail&productId=<?php echo $b_id;?>">View</a></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
 </table>
 <p align="center"><input type="button" value="Print" onclick="window.print()" /></p>
</form>
</div>

 
 <?
if ($alert !='')
{
?>
<script>
alert('<?php echo $alert;?>');
</script>

<?
}
else
{
}
?>
