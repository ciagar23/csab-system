<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$search = (isset($_GET['search']) && $_GET['search'] > '') ? $_GET['search'] : '';

$ry = date('Y');
$rm = date('m');
$rd = date('d');

$sql = "SELECT b_id,b_name,b_borrower, b_roomno,b_ry,b_rd,b_rm,b_by,b_bd,b_bm,b_rh,b_rmi, b_cleared
        FROM tbl_borrowed where b_ry=$ry and b_rd = $rd and b_rm= $rm";
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
   <th width="120">date/time returned:</td>
   <th width="120">Status</td>
   <th width="70">Clear</td>
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
	$class = 'bgcolor=yellow';
	}
	else
	{
	$status ='<font color=green>Cleared</font>';
	$class = 'bgcolor=white';
	}
	
		
	$sql1 = "SELECT *
        FROM tbl_user where user_name='$b_borrower'";
		$result1 = mysql_query($sql1);
		$show = mysql_fetch_array($result1);	
		$firstname= $show['user_fname'];
		$lastname= $show['user_lname'];
		
	$i += 1;
?>
  <tr <?php echo $class; ?>> 
   <td width="120" align="center"><a href="../viewitem/index.php?view=detail&productId=<?php echo $b_id;?>">View</a></td>
   <td width="120" align="center"><?php echo $firstname.' '.$lastname;?></td>
   <td width="120" align="center"><?php echo $b_roomno; ?></td>
   <td width="120" align="center"><?php echo $b_rm; ?>-<?php echo $b_rd; ?>-<?php echo $b_ry; ?> | <?php echo $b_rh; ?>:<?php echo $b_rmi; ?></td>
   <td width="70" align="center"><?php echo $status;?></td>

         <?php
   if ($b_cleared ==1)
   {   
   ?>
   <td width="120" align="center"><a href="../returning/index.php?view=return&productId=<?php echo $b_id;?>" class="ico edit">clear</a></td>
    <?php
   }
   else
   {?> 
     <td width="120" align="center">-</td>
  <?php }?>
   
   
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>
</div>