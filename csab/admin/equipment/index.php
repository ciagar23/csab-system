<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'CSAB - View Equipment';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'CSAB - Add Equipment';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'CSAB - Modify Equipment';
		break;

	case 'detail' :
		$content    = 'detail.php';
		$pageTitle  = 'CSAB - View Equipment Detail';
		break;
		
	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'CSAB - View Equipment';
}




$script    = array('equipment.js');

require_once '../include/template.php';
?>
