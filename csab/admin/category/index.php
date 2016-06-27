<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'CSAB - View Category';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'CSAB - Add Category';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'CSAB - Modify Category';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'CSAB - View Category';
}


$script    = array('category.js');

require_once '../include/template.php';
?>
