<?php

//session it up BRAH
if(session_status() == PHP_SESSION_NONE){
	session_start();
};

$usersavedbg = $_POST['bgurl'];
$usersavedfg = $_POST['fgurl'];
$usersavedtxt = $_POST['opt-text'];

$username = $_SESSION['username'];
$sid = session_id();

$uniqURL = uniqid($username).".html";                    

                $tpl_file = "save-template.html";
				$tpl_path = "../";
				$usersavedpath = "../user-pages/";

				$savedata['saved-backdrop'] = $usersavedbg;

				$savedata['saved-foreground'] = $usersavedfg;

				$savedata['saved-text'] = $usersavedtxt;

				$placeholders = array("{save-bg}", "{save-fg}", "{optotexto}");

				$tpl = file_get_contents($tpl_path.$tpl_file);

				$newpage_file = str_replace($placeholders, $savedata, $tpl);

				$html_file_name = $uniqURL;

				$fp = fopen($usersavedpath.$html_file_name, "w");
				fwrite($fp, $newpage_file);
				fclose($fp);

				header("Location: ../user-pages/".$html_file_name);

?>
