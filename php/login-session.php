<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	$DBhost = "localhost:3306";
	$DBuser = "root";
	$DBpass = "johncena";
	$DBname = "anamadeus";

	$methodType = $_SERVER["REQUEST_METHOD"];
	$data = array("status" => "fail", "msg" => "$methodType");

	if($methodType === "POST"){
		//Check AJAX
		if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {

			if(isset($_POST["loginusername"]) && !empty($_POST["loginusername"]) && isset($_POST["loginpassword"]) && !empty($_POST["loginpassword"])){

				// get the data from the post and store in variables
                $username = $_POST["loginusername"];
                $password = $_POST["loginpassword"];

                try {
                	$conn = new PDO("mysql:host=$DBhost;dbname=$DBname", $DBuser, $DBpass);
                	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                	$sql = "SELECT * FROM user_table WHERE username = :log AND password = :pwd";

                	$statement = $conn->prepare($sql);
                	$statement->execute(array(":log" => $username, ":pwd" => $password));

                	// this should be one if there"s a user by that user value and password value
                    $count = $statement->rowCount();

                    if($count > 0){
                    	$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                    	$returnedUsername = $rows[0]["username"];
                    	$returnedPassword = $rows[0]["password"];

                    	$_SESSION["username"] = $returnedUsername;
                    	$_SESSION["loggedin"] = true;

                    	$sid=session_id();
                    	$data = array("status" => "success", "sid" => $sid);
                    } else {
                    	$data = array("status" => "fail", "msg" => "User name and/or password not correct.");
                    }
                } catch(PDOException $e) {
                	$data = array("status" => "fail", "msg" => $e->getMessage());
                }

			} else {
				$data = array("status" => "fail", "msg" => "Either login or password were absent.");
			}

		} else {
			// not AJAX
            $data = array("status" => "fail", "msg" => "Has to be an AJAX call.");
		}
	} else {
		// simple error message, only taking POST requests
        $data = array("status" => "fail", "msg" => "Error: only POST allowed.");
	}

	echo json_encode($data, JSON_FORCE_OBJECT);

?>
