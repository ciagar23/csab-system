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
$sql = "SELECT pd.cat_id, pd_name, pd_code, pd_description, pd_image, pd_thumbnail
        FROM tbl_equipment pd, tbl_category cat
		WHERE pd.pd_id = $productId AND pd.cat_id = cat.cat_id";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());
$row    = mysql_fetch_assoc($result);
extract($row);

// get category list
$sql = "SELECT cat_id, cat_parent_id, cat_name
        FROM tbl_category
		ORDER BY cat_id";
$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());

$categories = array();
while($row = dbFetchArray($result)) {
	list($id, $parentId, $name) = $row;
	
	if ($parentId == 0) {
		$categories[$id] = array('name' => $name, 'children' => array());
	} else {
		$categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);	
	}
}	

//echo '<pre>'; print_r($categories); echo '</pre>'; exit;

// build combo box options
$list = '';
foreach ($categories as $key => $value) {
	$name     = $value['name'];
	$children = $value['children'];
	
	$list .= "<optgroup label=\"$name\">"; 
	
	foreach ($children as $child) {
		$list .= "<option value=\"{$child['id']}\"";
		
		if ($child['id'] == $cat_id) {
			$list .= " selected";
		}
		$list .= ">{$child['name']}</option>";
	}
	
	$list .= "</optgroup>";
}
?>
	<div class="form"> 
<form action="processReservation.php?action=Reserve&productId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddReservation" id="frmAddReservation">
 <p align="center" class="formTitle"><label>Reservation</label></p>
 
									<input name="txtBorrower" type="hidden" id="txtBorrower" value="<?php echo $_SESSION["username"]; ?>">
 								<p>
									<label>
                                    Item Name: 
                                    <span><?php echo $pd_name; ?></span>
                                    </label>
									<input name="txtName" type="hidden" id="txtName" value="<?php echo $pd_name; ?>">
								</p>
                                
                                <p>
									<label>
                                    Item Code: 
                                    <span><?php echo $pd_code; ?></span>
                                    </label>
									<input name="txtCode" type="hidden" id="txtCode" value="<?php echo $pd_code; ?>">
								</p>	
                                
                                <p>
									<label>
                                    Description: 
                                    <span><?php echo $pd_description; ?></span>
                                    </label>
							
								</p>	
 


 <p align="center" class="formTitle"><label>Booking / Borrowing</label></p>
 
   							  <p>
									<label>
                                    Borrower: 
                                    </label>
									<h2><?php echo $fname;?> <?php echo $lname;?></h2>
								</p>
   							  <p>
									<label>
                                    Equipment / Room No / Place: 
                                    </label>
									<input name="txtRoomNo" type="text" id="txtRoomNo"  class="field size3">
								</p>
   							  <p>
									<label>
                                    Class: 
                                    </label>
									<input name="txtClass" type="text" id="txtClass"  class="field size3">
								</p>
   							  <p>
									<label>
                                    Subject: 
                                    </label>
									<input name="txtSubject" type="text" id="txtSubject"  class="field size3">
								</p>
                                
                                  <p>
									<label>
                                    Purpose: 
                                    </label>
									<input name="txtPurpose" type="text" id="txtPurpose"  class="field size1">
								</p>
   							  <p class="inline-field">
									<label>
                                    Date From: 
                                   
									<select name="txtBy" class="field size3">
                                        <option value=""> - Select -</option>
										<option>2012</option>
										<option>2013</option>
										<option>2014</option>
										<option>2015</option>
										<option>2016</option>
									</select>
									<select name="txtBm" class="field size3">
                                        <option value=""> - Select -</option>
										<option value="1">Jan</option>
										<option value="2">Feb</option>
										<option value="3">Mar</option>
										<option value="4">Apr</option>
										<option value="5">May</option>
										<option value="6">Jun</option>
										<option value="7">Jul</option>
										<option value="8">Aug</option>
										<option value="9">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
									<select name="txtBd" class="field size3">
                                        <option value=""> - Select -</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
										<option>25</option>
										<option>26</option>
										<option>27</option>
										<option>28</option>
										<option>29</option>
										<option>30</option>
										<option>31</option>
									</select>
                                  
                                    <label>To: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   <select name="txtRy" class="field size3">
                                        <option value=""> - Select -</option>
										<option>2012</option>
										<option>2013</option>
										<option>2014</option>
										<option>2015</option>
										<option>2016</option>
									</select>
									<select name="txtRm" class="field size3">
                                        <option value=""> - Select -</option>
										<option value="1">Jan</option>
										<option value="2">Feb</option>
										<option value="3">Mar</option>
										<option value="4">Apr</option>
										<option value="5">May</option>
										<option value="6">Jun</option>
										<option value="7">Jul</option>
										<option value="8">Aug</option>
										<option value="9">Sep</option>
										<option value="10">Oct</option>
										<option value="11">Nov</option>
										<option value="12">Dec</option>
									</select>
									<select name="txtRd" class="field size3">
                                        <option value=""> - Select -</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
										<option>25</option>
										<option>26</option>
										<option>27</option>
										<option>28</option>
										<option>29</option>
										<option>30</option>
										<option>31</option>
									</select>
                                     </label>
								</p>
                                
                                <br>	
                                <br>
                                
                                 <p class="inline-field">
									<label>
                                    Time From: 
                                   
									<select name="txtBh" class="field size2">
                                        <option value=""> - </option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
									</select>
                                    :
									<select name="txtBmi" class="field size2">
                                        <option value=""> - </option>
										<option>00</option>
										<option>30</option>
									</select>
                            
									<label>
                                    Time To: 
                                   
									<select name="txtRh" class="field size2">
                                        <option value=""> - </option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>11</option>
										<option>12</option>
										<option>13</option>
										<option>14</option>
										<option>15</option>
										<option>16</option>
										<option>17</option>
										<option>18</option>
										<option>19</option>
										<option>20</option>
										<option>21</option>
										<option>22</option>
										<option>23</option>
										<option>24</option>
									</select>
                                    :
									<select name="txtRmi" class="field size2">
                                        <option value=""> - </option>
										<option>00</option>
										<option>30</option>
									</select>
                                   </p>
 
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Reserve" onClick="checkAddReservationForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
