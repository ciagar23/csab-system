<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	// redirect to index.php if product id is not present
	header('Location: index.php');
}

// get product info
$sql = "SELECT b_bh, b_bmi, b_by, b_bm, b_bd, b_roomno, b_borrower, b_name, b_purpose FROM tbl_borrowed
		WHERE b_id = $productId";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());
$row    = mysql_fetch_assoc($result);
extract($row);

?>
	<div class="form"> 
<form action="processReturning.php?action=return&productId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddReservation" id="frmAddReservation">
 <p align="center" class="formTitle"><label>Booking Details</label></p>
 
									<input name="txtBorrower" type="hidden" id="txtBorrower" value="<?php echo $_SESSION["username"]; ?>">
 								<p>
									<label>
                                    Time:: 
                                    <span><?php echo $b_bh; ?> : <?php echo $b_bmi;?></span>
                                    </label>
									<input name="txtName" type="hidden" id="txtName" value="<?php echo $pd_name; ?>">
                                    
								</p>
                                
                                <p>
									<label>
                                    Date: 
                                    <span><?php echo $b_by; ?>-<?php echo $b_bm; ?>-<?php echo $b_bd; ?></span>
                                    </label>
									<input name="txtCode" type="hidden" id="txtCode" value="<?php echo $pd_code; ?>">
								</p>	
                                
                                <p>
									<label>
                                    Venue: 
                                    <span><?php echo $b_roomno; ?></span>
                                    </label>
							
								</p>
                                
                                
                                <p>
									<label>
                                    Borrower: 
                                    <span><?php echo $b_borrower; ?></span>
                                    </label>
							
								</p>	
                                
                                
                                
                                <p>
									<label>
                                    Borrowed: 
                                    <span><?php echo $b_name; ?></span>
                                    </label>
							
								</p>	
                                
                                <p>
									<label>
                                    Purpose: 
                                    <span><?php echo $b_purpose; ?></span>
                                    </label>
							
								</p>	
 


 <p align="center" class="formTitle"><label>Clearance</label></p>
 
  
   							  <p>
									<label>
                                    Assigned Staff
                                    </label>
									<input name="txtStaff" type="text" id="txtStaff"  class="field size3">
								</p>
   							  <p>
									<label>
                                    Comment: 
                                    </label>
									<textarea name="txtComment" cols="100" rows="10"> </textarea>
                                    
								</p>
 
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Reserve" onClick="checkClearanceForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
