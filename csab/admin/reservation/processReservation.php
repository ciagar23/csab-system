<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'addProduct' :
		addProduct();
		break;
		
	case 'addBorrowed' :
		addBorrowed();
		break;
	case 'deleteBorrowed' :
		deleteBorrowed();
		break;
		
	case 'Reserve' :
		Reserve();
		break;
		
	case 'deleteProduct' :
		deleteProduct();
		break;
	
	case 'deleteImage' :
		deleteImage();
		break;
    

	default :
	    // if action is not defined or unknown
		// move to main product page
		header('Location: index.php');
}


function addProduct()
{
    $catId       = $_POST['cboCategory'];
    $name        = $_POST['txtName'];
    $code        = $_POST['txtCode'];
	$description = $_POST['mtxDescription'];
	
	$images = uploadProductImage('fleImage', SRV_ROOT . 'images/product/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];
	
	$sql   = "INSERT INTO tbl_equipment (cat_id, pd_name, pd_code, pd_description, pd_image, pd_thumbnail, pd_date)
	          VALUES ('$catId', '$name', '$code', '$description', '$mainImage', '$thumbnail', NOW())";

	$result = dbQuery($sql);
	
	header("Location: index.php?catId=$catId");	
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
    $Position        = $_POST['txtPosition'];
    $dept        = $_POST['txtDepartment'];
    $RoomNo        = $_POST['txtRoomNo'];
    $Class        = $_POST['txtClass'];
    $Subject        = $_POST['txtSubject'];
    $By        = $_POST['txtBy'];
    $Bm        = $_POST['txtBm'];
    $Bd        = $_POST['txtBd'];
    $Ry        = $_POST['txtRy'];
    $Rm        = $_POST['txtRm'];
    $Rd        = $_POST['txtRd'];
    $Bh        = $_POST['txtBh'];
    $Bmi        = $_POST['txtBmi'];
    $Rh        = $_POST['txtRh'];
    $Rmi        = $_POST['txtRmi'];
	$session = $_SESSION["username"];
	
	

if($Position =='Dean')
	{
	
	$dean=1;
	$imc=0;
	
	if ($productId==33)
	{
	$president=0;
	}
	else
	{
	$president=1;
	}
	$gso=0;
	
	}
else if($Position =='IMC')
	{
	
	$dean=1;
	$imc=1;
	
	
	if ($productId==33)
	{
	$president=0;
	}
	else
	{
	$president=1;
	}
	
	$gso=0;
	
	}
else if($Position =='President')
	{
	
	$dean=1;
	$imc=0;
	$president=1;
	$gso=0;
	
	}
else if($Position =='GSO')
	{
	
	$dean=1;
	$imc=0;
	
	
	if ($productId==33)
	{
	$president=0;
	}
	else
	{
	$president=1;
	}
	
	$gso=1;
	
	}
else

	{
	
	$dean=0;
	$imc=0;
	
	
	if ($productId==33)
	{
	$president=0;
	}
	else
	{
	$president=1;
	}
	
	$gso=0;
	
	}
					
			
	$sql   = "INSERT INTO tbl_borrowed ( b_borrower, b_roomno, b_department, b_class, b_subject, b_by, b_bm, b_bd, b_ry, b_rm, b_rd, b_bh, b_bmi, b_rh, b_rmi, b_purpose, b_datereg, b_dean, b_imc, b_president, b_gso)
	          
			  VALUES ('$Borrower', '$RoomNo', '$dept','$Class',  '$Subject', '$By', '$Bm', '$Bd', '$Ry', '$Rm', '$Rd', '$Bh', '$Bmi', '$Rh', '$Rmi','$Purpose', NOW(), '$dean', '$imc', '$president', '$gso')";
	
	
	$result = dbQuery($sql);
		
$sql = "SELECT *
        FROM tbl_borrowed where b_borrower='$session' order by b_datereg desc";
		$result = mysql_query($sql);
		$show = mysql_fetch_array($result);	
		$bId= $show['b_id'];
	
	
	header('Location: index.php?productId='.$bId);	
	
			  
}

/*
	Remove a product
*/
function deleteProduct()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
			
	// get the image name and thumbnail
	$sql = "SELECT pd_image, pd_thumbnail
	        FROM tbl_equipment
			WHERE pd_id = $productId";
			
	$result = dbQuery($sql);
	$row    = dbFetchAssoc($result);
	
	// remove the product image and thumbnail
	if ($row['pd_image']) {
		unlink(SRV_ROOT . 'images/product/' . $row['pd_image']);
		unlink(SRV_ROOT . 'images/product/' . $row['pd_thumbnail']);
	}
	
	// remove the product from database;
	$sql = "DELETE FROM tbl_equipment 
	        WHERE pd_id = $productId";
	dbQuery($sql);
	
	header('Location: index.php?catId=' . $_GET['catId']);
}

function deleteBorrowed()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
		$equipId = (int)$_GET['equipId'];
	} else {
		header('Location: index.php');
	}
	
	
	// remove the product from database;
	$sql = "DELETE FROM tbl_equipborrowed 
	        WHERE e_id = $equipId";
	dbQuery($sql);
	
	header('Location: index.php?productId='.$productId);
}


function addBorrowed()
{
	
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
		$equipId = (int)$_GET['equipId'];
	} else {
		header('Location: index.php');
	}
    $By        = $_GET['by'];
    $Bm        = $_GET['bm'];
    $Bd        = $_GET['bd'];
	
	$sql   = "INSERT INTO tbl_equipborrowed ( e_bid, e_eid, e_by, e_bd, e_bm)  
			  VALUES ( $productId, $equipId, $By, $Bd, $Bm)";
	
	$result = dbQuery($sql);
	
	if($equipId==33)
	{
	$sql = "UPDATE tbl_borrowed
			SET b_eid = 1, b_president = 0
			WHERE b_id = $productId";
	dbQuery($sql);
	}
	else
	{
	}	
	header('Location: index.php?productId='.$productId.'&success=hhfhf');
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