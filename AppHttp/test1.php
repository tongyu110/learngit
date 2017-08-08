<?php


	header("Content-type: application/json");

	$data = array('name'=>'xue','age'=>20);
	if(isset($_GET['id']) || isset($_POST['id'])) {
		$data['id'] = 1;
	}
	echo json_encode($data);


?>