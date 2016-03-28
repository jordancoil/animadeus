<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	$methodType = $_SERVER['REQUEST_METHOD'];
	$data = array("status" => "fail", "msg" => "$methodType");

	if ($methodType === 'POST') {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			session_unset();
			session_destroy();
			$data = array("status" => "success", "msg" => "You were successfully logged out.");
		} else {
			$data = array("status" => "fail", "msg" => "Has to be an AJAX call.");
		}
	} else {
		$data = array("status" => "fail", "msg" => "Error: only POST allowed.");
	}

	echo json_encode($data, JSON_FORCE_OBJECT);

?>