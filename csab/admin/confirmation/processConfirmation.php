<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'disapprove' :
		disapprove();
		break;
		
	case 'Reserve' :
		Reserve();
		break;
		
	case 'confirmDean' :
		confirmDean();
		break;
		
	case 'confirmPresident' :
		confirmPresident();
		break;
		
	case 'confirmIMC' :
		confirmIMC();
		break;
		
	case 'confirmGSO' :
		confirmGSO();
		break;
	
	case 'deleteImage' :
		deleteImage();
		break;
    

	default :
	    // if action is not defined or unknown
		// move to main product page
		header('Location: index.php');
}


function disapprove()
{

	$productId   = (int)$_GET['productId'];	
	$assigned =	$_SESSION["username"];
	$eId   = (int)$_GET['eId'];		
	$reason   = $_GET['reason'];	
    $sql   = "UPDATE tbl_borrowed 
	          SET b_gso = 2, b_disapprovedcomment = '$reason'
			  WHERE b_id = $productId"; 
			   

	$result = dbQuery($sql);
	
	$sql   = "INSERT INTO tbl_disapproved (d_bid, d_datereg, d_assigned, d_reason)
	          VALUES ('$productId',NOW(), '$assigned', '$reason')";

	$result = dbQuery($sql);
	
	header('Location: index.php?success=This Reservation Has been Disapproved so it will be erased from the pending list');	
}

/*
	Upload an image and return the uploaded image name 
*/
function uploadProductImage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
		if (LIMIT_PRODUCT_WIDTH && $width > MAX_PRODUCT_IMAGE_WIDTH) {
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_PRODUCT_IMAGE_WIDTH);
			$imagePath = $result;
		} else {
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
		
		if ($result) {
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";
			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);
			
			// create thumbnail failed, delete the image
			if (!$result) {
				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}	
		} else {
			// the product cannot be upload / resized
			$imagePath = $thumbnailPath = '';
		}
		
	}

	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

/*
	Modify a product
*/
function Reserve()
{
	$productId   = (int)$_GET['productId'];	
    $Purpose        = $_POST['txtPurpose'];
    $Borrower        = $_POST['txtBorrower'];
    $RoomNo        = $_POST['txtRoomNo'];
    $Class        = $_POST['txtClass'];
    $Subject        = $_POST['txtSubject'];
    $By        = $_POST['txtBy'];
    $Bm        = $_POST['txtBm'];
    $Bd        = $_POST['txtBd'];
    $Ry        = $_POST['txtRy'];
    $Rm        = $_POST['txtRm'];
    $Rd        = $_POST['txtRd'];
    $Name        = $_POST['txtName'];
    $Code        = $_POST['txtCode'];
    $Bh        = $_POST['txtBh'];
    $Bmi        = $_POST['txtBmi'];
    $Rh        = $_POST['txtRh'];
    $Rmi        = $_POST['txtRmi'];
	
			
			
	$sql   = "INSERT INTO tbl_borrowed (b_eid, b_borrower, b_roomno, b_class, b_subject, b_by, b_bm, b_bd, b_ry, b_rm, b_rd, b_name, b_code, b_bh, b_bmi, b_rh, b_rmi, b_purpose, b_datereg)
	          VALUES ('$productId', '$Borrower', '$RoomNo', '$Class', '$Subject', '$By', '$Bm', '$Bd', '$Ry', '$Rm', '$Rd', '$Name', '$Code', '$Bh', '$Bmi', '$Rh', '$Rmi','$Purpose', NOW())";
	
	
	$result = dbQuery($sql);
			
			
	$sql   = "UPDATE tbl_equipment 
	          SET pd_stat =1
			  WHERE pd_id = $productId";  

	$result = dbQuery($sql);
	
	header('Location: index.php');			  
}

/*
	Remove a product
*/
function confirmDean()
{
	
	$productId   = (int)$_GET['productId'];	
	
	$assigned =	$_SESSION["username"];
	$sql   = "UPDATE tbl_borrowed 
	          SET b_dean=1
			  WHERE b_id = $productId";  

	$result = dbQuery($sql);
	
	$sql   = "INSERT INTO tbl_approved (a_bid, a_datereg, a_assigned)
	          VALUES ('$productId',NOW(), '$assigned')";

	$result = dbQuery($sql);
	
	header('Location: index.php?success=This Reservation has been Approved by the Dean');
}

function confirmPresident()
{
	
	$productId   = (int)$_GET['productId'];	
	
	$assigned =	$_SESSION["username"];
	$sql   = "UPDATE tbl_borrowed 
	          SET b_president=1
			  WHERE b_id = $productId";  

	$result = dbQuery($sql);
	
	$sql   = "INSERT INTO tbl_approved (a_bid, a_datereg, a_assigned)
	          VALUES ('$productId',NOW(), '$assigned')";

	$result = dbQuery($sql);
	
	header('Location: index.php?success=This Reservation has been Approved by the President');
}

function confirmIMC()
{
	
	$productId   = (int)$_GET['productId'];	
	$assigned =	$_SESSION["username"];
	$sql   = "UPDATE tbl_borrowed 
	          SET b_imc=1
			  WHERE b_id = $productId";  

	$result = dbQuery($sql);
	
	$sql   = "INSERT INTO tbl_approved (a_bid, a_datereg, a_assigned)
	          VALUES ('$productId',NOW(), '$assigned')";

	$result = dbQuery($sql);
	
	header('Location: index.php?success=This Reservation has been Approved by IMC');
}

function confirmGSO()
{
	
	$productId   = (int)$_GET['productId'];	
	$assigned =	$_SESSION["username"];
	$eId   = (int)$_GET['eId'];	
	$sql   = "UPDATE tbl_borrowed 
	          SET b_gso=1
			  WHERE b_id = $productId";  

	$result = dbQuery($sql);
	
	$sql   = "UPDATE tbl_equipment
	          SET pd_stat=2
			  WHERE pd_id = $eId";  

	$result = dbQuery($sql);
	
	$sql   = "INSERT INTO tbl_approved (a_bid, a_datereg, a_assigned)
	          VALUES ('$productId',NOW(), '$assigned')";

	$result = dbQuery($sql);
		

	$result = dbQuery($sql);
	
	header('Location: index.php?success=This Reservation has been Approved by the GSO');
}


/*
	Remove a product image
*/
function deleteImage()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
	$deleted = _deleteImage($productId);

	// update the image and thumbnail name in the database
	$sql = "UPDATE tbl_equipment
			SET pd_image = '', pd_thumbnail = ''
			WHERE pd_id = $productId";
	dbQuery($sql);		

	header("Location: index.php?view=modify&productId=$productId");
}

function _deleteImage($productId)
{
	// we will return the status
	// whether the image deleted successfully
	$deleted = false;
	
	$sql = "SELECT pd_image, pd_thumbnail 
	        FROM tbl_equipment
			WHERE pd_id = $productId";
	$result = dbQuery($sql) or die('Cannot delete product image. ' . mysql_error());
	
	if (dbNumRows($result)) {
		$row = dbFetchAssoc($result);
		extract($row);
		
		if ($pd_image && $pd_thumbnail) {
			// remove the image file
			$deleted = @unlink(SRV_ROOT . "images/product/$pd_image");
			$deleted = @unlink(SRV_ROOT . "images/product/$pd_thumbnail");
		}
	}
	
	return $deleted;
}




?>