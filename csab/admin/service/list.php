<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$search = (isset($_GET['search']) && $_GET['search'] > '') ? $_GET['search'] : '';

$by = date('Y');
$bm = date('m');
$bd = date('d');

$sql = "SELECT b_id,b_name,b_borrower, b_roomno,b_ry,b_rd,b_rm,b_by,b_bd,b_bm,b_bh,b_bmi,b_rh,b_rmi, b_cleared
        FROM tbl_borrowed where b_by=$by and b_bd = $bd and b_bm= $bm";
$result = dbQuery($sql);

?> 


					<!-- Table -->
					<div class="table">
<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">


 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <th width="120">Equipment/room:</th>
   <th width="120">borrowed by:</th>
   <th width="120">location:</th>
   <th width="120">date/time needed:</th>
   <th width="120">Status</th>
   <th width="70">Serve</th>
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);
	
	
	if ($b_cleared ==1)
	{
	$status = '<font color=red>Served</font>';
	$class = 'bgcolor=yellow';
	}
	else
	{
	$status = '<font color=green>Unserved</font>';
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
   <td width="120" align="center"><?php echo $b_bm; ?>-<?php echo $b_bd; ?>-<?php echo $b_by; ?> | <?php echo $b_bh; ?>:<?php echo $b_bmi; ?></td>
   <td width="70" align="center"><?php echo $status;?></td>
   
   <?php
   if ($b_cleared ==1)
   {   
   ?>
   <td width="120" align="center">-</td>
   <?php
   }
   else
   {?>
   <td width="120" align="center"><a href="../serving/index.php?view=return&productId=<?php echo $b_id;?>" class="ico edit">serve</a></td>
   <?php
   }?>
   
   
   
   
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="6">&nbsp;</td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>
</div>