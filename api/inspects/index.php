<?php
	
	include_once './InspectController.php';
	header('Content-Type: application/json');
	$InspectController = new InspectController($_GET);

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		echo $InspectController->index();
	}

?>