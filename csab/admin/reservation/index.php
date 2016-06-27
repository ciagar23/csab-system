<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		break;

	case 'add' :
		$content 	= 'add.php';		
		break;

	case 'reserve' :
		$content 	= 'reserve.php';		
		break;

	case 'detail' :
		$content    = 'detail.php';
		break;
		
	default :
		$content 	= 'list.php';		
}




$script    = array('reservation.js');

		$pageTitle 	= 'CSAB - Reservation';
require_once '../include/template.php';
?>
