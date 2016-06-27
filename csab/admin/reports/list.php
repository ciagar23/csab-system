<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$search = (isset($_GET['search']) && $_GET['search'] > '') ? $_GET['search'] : '';

$sql = "SELECT b_id,b_name,b_borrower, b_roomno,b_ry,b_rd,b_rm,b_rh,b_rmi, b_cleared
        FROM tbl_borrowed";
$result = dbQuery($sql);

?> 


					<!-- Table -->
					<div class="table">
<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">


 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th>Equipment/room:</td>
   <th width="120">borrowed by:</td>
   <th width="120">location:</td>
   <th width="120">date/time return:</td>
   <th width="120">Status</td>
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
	$sql1 = "SELECT *
        FROM tbl_user where user_name='$b_borrower'";
		$result1 = mysql_query($sql1);
		$show = mysql_fetch_array($result1);	
		$firstname= $show['user_fname'];
		$lastname= $show['user_lname'];
	
	
	$i += 1;
?>
  <tr> 
   <td width="120" align="center"><a href="../viewitem/index.php?view=detail&productId=<?php echo $b_id;?>">View</a></td>
   <td width="120" align="center"><?php echo $firstname.' '.$lastname; ?></td>
   <td width="120" align="center"><?php echo $b_roomno; ?></td>
   <td width="120" align="center"><?php echo $b_rm; ?>-<?php echo $b_rd; ?>-<?php echo $b_ry; ?> | <?php echo $b_rh; ?>:<?php echo $b_rmi; ?></td>
   <td width="70" align="center"><?php echo $status;?></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
 </table>
 <p align="center"><input type="button" value="Print" onclick="print()" /> </p>
</form>
</div>