<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';


?>


	<div class="form"> 
<form action="processReservation.php?action=Reserve&productId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddReservation" id="frmAddReservation">
 <p align="center" class="formTitle"><label>Reservation</label></p>
 
<input name="txtBorrower" type="hidden" id="txtBorrower" value="<?php echo $_SESSION["username"]; ?>">
<input name="txtPosition" type="hidden" id="txtPosition" value="<?php echo $position; ?>">


 <p align="center" class="formTitle"><label>Booking / Borrowing</label></p>
 
   							  <p>
									<label>
                                    Borrower: 
                                    </label>
									<h2><?php echo $fname;?> <?php echo $lname;?>: <?php echo $department;?></h2>
                                    
									<input name="txtDepartment" type="hidden" id="txtDepartment" value="<?php echo $department; ?>">
								</p>
   							  <p>
									<label>
                                    Location: 
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
                                <font color=red><?php echo $error;?></font>
   							  <p class="inline-field">
									<label>
                                    Date From: 
                                   
									<select name="txtBy" class="field size3">
                                        <option value=""> - Select -</option>
										<option>2013</option>
										<option>2014</option>
										<option>2015</option>
										<option>2016</option>
										<option>2017</option>
										<option>2018</option>
										<option>2019</option>
										<option>2020</option>
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
										<option>2013</option>
										<option>2014</option>
										<option>2015</option>
										<option>2016</option>
										<option>2017</option>
										<option>2018</option>
										<option>2019</option>
										<option>2020</option>
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
										<option value="1"> 1 AM </option>
										<option value="2"> 2 AM </option>
										<option value="3"> 3 AM </option>
										<option value="4"> 4 AM </option>
										<option value="5"> 5 AM </option>
										<option value="6"> 6 AM </option>
										<option value="7"> 7 AM </option>
										<option value="8"> 8 AM </option>
										<option value="9"> 9 AM </option>
										<option value="10">10 AM </option>
										<option value="11"> 11 AM </option>
										<option value="12"> 12 AM </option>
										<option value="13"> 1 PM </option>
										<option value="14"> 2 PM </option>
										<option value="15"> 3 PM </option>
										<option value="16"> 4 PM </option>
										<option value="17"> 5 PM </option>
										<option value="18"> 6 PM </option>
										<option value="19"> 7 PM </option>
										<option value="20"> 8 PM </option>
										<option value="21"> 9 PM </option>
										<option value="22"> 10 PM </option>
										<option value="23"> 11 PM </option>
										<option value="24"> 12 PM </option>
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
										<option value="1"> 1 AM </option>
										<option value="2"> 2 AM </option>
										<option value="3"> 3 AM </option>
										<option value="4"> 4 AM </option>
										<option value="5"> 5 AM </option>
										<option value="6"> 6 AM </option>
										<option value="7"> 7 AM </option>
										<option value="8"> 8 AM </option>
										<option value="9"> 9 AM </option>
										<option value="10">10 AM </option>
										<option value="11"> 11 AM </option>
										<option value="12"> 12 AM </option>
										<option value="13"> 1 PM </option>
										<option value="14"> 2 PM </option>
										<option value="15"> 3 PM </option>
										<option value="16"> 4 PM </option>
										<option value="17"> 5 PM </option>
										<option value="18"> 6 PM </option>
										<option value="19"> 7 PM </option>
										<option value="20"> 8 PM </option>
										<option value="21"> 9 PM </option>
										<option value="22"> 10 PM </option>
										<option value="23"> 11 PM </option>
										<option value="24"> 12 PM </option>
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
