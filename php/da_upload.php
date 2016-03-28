<?php

//session it up BRAH
if(session_status() == PHP_SESSION_NONE){
	session_start();
};

$sid = session_id();

$target_bg_dir = "../user-images/user-bg/";
$target_fg_dir = "../user-images/user-fg/";
$target_fg2_dir = "../user-images/user-fg/";

$target_bg_file = $target_bg_dir . basename($_FILES['file']['name']);
$target_fg_file = $target_fg_dir . basename($_FILES['file2']['name']);
$target_fg2_file = $target_fg2_dir . basename($_FILES['file3']['name']);

$preset_bg_select = $_POST['pre_file'];
$preset_fg_select = $_POST['pre_file2'];
$preset_fg2_select = $_POST['pre_file3'];

$opt_text = $_POST['upload-text'];

$uploadOk = 1;

//store file extensions
$bgFileType = pathinfo($target_bg_file,PATHINFO_EXTENSION);
$fgFileType = pathinfo($target_fg_file,PATHINFO_EXTENSION);
$fg2FileType = pathinfo($target_fg2_file,PATHINFO_EXTENSION);

if(isset($_POST['submit'])) {
	$bgcheck = getimagesize($_FILES['file']['tmp_name']);
	$fgcheck = getimagesize($_FILES['file2']['tmp_name']);
	$fg2check = getimagesize($_FILES['file3']['tmp_name']);

	if($bgcheck !== false && $fgcheck !== false && $fg2check !== false) {
		//ITS OK
	} else {
		//ITS NOT OK
		$uploadOk = 0;
	}
}

if (file_exists($target_bg_file) && file_exists($target_fg_file) && file_exists($target_fg2_file)) {
	//FILE ALREADY EXISTS
	$uploadOk = 0;
}

if ($uploadOk == 0) {
	//ITS NOT OK
} else {
	if (move_uploaded_file($_FILES['file']['tmp_name'], $target_bg_file)) {
		//BG UPLOADED
	} else {
		//BG UPLOAD ERROR
	}

	if (move_uploaded_file($_FILES['file2']['tmp_name'], $target_fg_file)) {
		//FG UPLOADED
	} else {
		//FG UPLOAD ERROR
	}

	if (move_uploaded_file($_FILES['file3']['tmp_name'], $target_fg2_file)) {
		//FG UPLOADED
	} else {
		//FG UPLOAD ERROR
	}
}


//if no files are uploaded
if (basename($_FILES['file']['name']) == "" and basename($_FILES['file2']['name']) == "" and basename($_FILES['file3']['name']) == ""){
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	if ($preset_bg_select == "one"){
		$data['user-backdrop'] = "../assets/preset_images/bg1-bubbles.png";
	} else if ($preset_bg_select == "two"){
		$data['user-backdrop'] = "../assets/preset_images/stars/bg4-stars.png";
	} else if ($preset_bg_select == "three"){
		$data['user-backdrop'] = "../assets/preset_images/rain/bg2-rain.png";
	} else if ($preset_bg_select == "four"){
		$data['user-backdrop'] = "../assets/preset_images/snow/bg3-snow.png";
	} else if ($preset_bg_select == "five"){
		$data['user-backdrop'] = "../assets/preset_images/leaves/bg5-leaves.gif";
	}

	if ($preset_fg_select == "one"){
		$data['user-foreground'] = "../assets/preset_images/bg1-ani1.png";
	} else if ($preset_fg_select == "two"){
		$data['user-foreground'] = "../assets/preset_images/stars/bg4-ani1.png";
	} else if ($preset_fg_select == "three"){
		$data['user-foreground'] = "../assets/preset_images/rain/bg2-ani1.png";
	} else if ($preset_fg_select == "four"){
		$data['user-foreground'] = "../assets/preset_images/snow/bg3-ani1.png";
	} else if ($preset_fg_select == "five"){
		$data['user-foreground'] = "../assets/preset_images/leaves/bg5-ani1.png";
	}

	if ($preset_fg2_select == "one"){
		$data['user-foreground2'] = "../assets/preset_images/bg1-ani2.png";
	} else if ($preset_fg2_select == "two"){
		$data['user-foreground2'] = "../assets/preset_images/stars/bg4-ani2.png";
	} else if ($preset_fg2_select == "three"){
		$data['user-foreground2'] = "../assets/preset_images/rain/bg2-ani2.png";
	} else if ($preset_fg2_select == "four"){
		$data['user-foreground2'] = "../assets/preset_images/snow/bg3-ani2.png";
	} else if ($preset_fg2_select == "five"){
		$data['user-foreground2'] = "../assets/preset_images/leaves/bg5-ani2.png";
	}

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
} /* IF only a second foreground is uploaded */ else if (basename($_FILES['file']['name']) == "" and basename($_FILES['file2']['name']) == ""){
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	if ($preset_bg_select == "one"){
		$data['user-backdrop'] = "../assets/preset_images/bg1-bubbles.png";
	} else if ($preset_bg_select == "two"){
		$data['user-backdrop'] = "../assets/preset_images/stars/bg4-stars.png";
	} else if ($preset_bg_select == "three"){
		$data['user-backdrop'] = "../assets/preset_images/rain/bg2-rain.png";
	} else if ($preset_bg_select == "four"){
		$data['user-backdrop'] = "../assets/preset_images/snow/bg3-snow.png";
	} else if ($preset_bg_select == "five"){
		$data['user-backdrop'] = "../assets/preset_images/leaves/bg5-leaves.gif";
	}

	if ($preset_fg_select == "one"){
		$data['user-foreground'] = "../assets/preset_images/bg1-ani1.png";
	} else if ($preset_fg_select == "two"){
		$data['user-foreground'] = "../assets/preset_images/stars/bg4-ani1.png";
	} else if ($preset_fg_select == "three"){
		$data['user-foreground'] = "../assets/preset_images/rain/bg2-ani1.png";
	} else if ($preset_fg_select == "four"){
		$data['user-foreground'] = "../assets/preset_images/snow/bg3-ani1.png";
	} else if ($preset_fg_select == "five"){
		$data['user-foreground'] = "../assets/preset_images/leaves/bg5-ani1.png";
	}

	$data['user-foreground2'] = $target_fg2_file;

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
}/*if only a first foreground is uploaded */ else if (basename($_FILES['file']['name']) == "" and basename($_FILES['file3']['name']) == ""){
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	if ($preset_bg_select == "one"){
		$data['user-backdrop'] = "../assets/preset_images/bg1-bubbles.png";
	} else if ($preset_bg_select == "two"){
		$data['user-backdrop'] = "../assets/preset_images/stars/bg4-stars.png";
	} else if ($preset_bg_select == "three"){
		$data['user-backdrop'] = "../assets/preset_images/rain/bg2-rain.png";
	} else if ($preset_bg_select == "four"){
		$data['user-backdrop'] = "../assets/preset_images/snow/bg3-snow.png";
	} else if ($preset_bg_select == "five"){
		$data['user-backdrop'] = "../assets/preset_images/leaves/bg5-leaves.gif";
	}

	$data['user-foreground'] = $target_fg_file;

	if ($preset_fg2_select == "one"){
		$data['user-foreground2'] = "../assets/preset_images/bg1-ani2.png";
	} else if ($preset_fg2_select == "two"){
		$data['user-foreground2'] = "../assets/preset_images/stars/bg4-ani2.png";
	} else if ($preset_fg2_select == "three"){
		$data['user-foreground2'] = "../assets/preset_images/rain/bg2-ani2.png";
	} else if ($preset_fg2_select == "four"){
		$data['user-foreground2'] = "../assets/preset_images/snow/bg3-ani2.png";
	} else if ($preset_fg2_select == "five"){
		$data['user-foreground2'] = "../assets/preset_images/leaves/bg5-ani2.png";
	}

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
} /* if only a background isnt uploaded */ else if (basename($_FILES['file']['name']) == ""){
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	if ($preset_bg_select == "one"){
		$data['user-backdrop'] = "../assets/preset_images/bg1-bubbles.png";
	} else if ($preset_bg_select == "two"){
		$data['user-backdrop'] = "../assets/preset_images/stars/bg4-stars.png";
	} else if ($preset_bg_select == "three"){
		$data['user-backdrop'] = "../assets/preset_images/rain/bg2-rain.png";
	} else if ($preset_bg_select == "four"){
		$data['user-backdrop'] = "../assets/preset_images/snow/bg3-snow.png";
	} else if ($preset_bg_select == "five"){
		$data['user-backdrop'] = "../assets/preset_images/leaves/bg5-leaves.gif";
	}

	$data['user-foreground'] = $target_fg_file;

	$data['user-foreground2'] = $target_fg2_file;

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
}  /* just a BG is uploaded */ else if (basename($_FILES['file2']['name']) == "" and basename($_FILES['file3']['name']) == ""){
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	$data['user-backdrop'] = $target_bg_file;

	if ($preset_fg_select == "one"){
		$data['user-foreground'] = "../assets/preset_images/bg1-ani1.png";
	} else if ($preset_fg_select == "two"){
		$data['user-foreground'] = "../assets/preset_images/stars/bg4-ani1.png";
	} else if ($preset_fg_select == "three"){
		$data['user-foreground'] = "../assets/preset_images/rain/bg2-ani1.png";
	} else if ($preset_fg_select == "four"){
		$data['user-foreground'] = "../assets/preset_images/snow/bg3-ani1.png";
	} else if ($preset_fg_select == "five"){
		$data['user-foreground'] = "../assets/preset_images/leaves/bg5-ani1.png";
	}

	if ($preset_fg2_select == "one"){
		$data['user-foreground2'] = "../assets/preset_images/bg1-ani2.png";
	} else if ($preset_fg2_select == "two"){
		$data['user-foreground2'] = "../assets/preset_images/stars/bg4-ani2.png";
	} else if ($preset_fg2_select == "three"){
		$data['user-foreground2'] = "../assets/preset_images/rain/bg2-ani2.png";
	} else if ($preset_fg2_select == "four"){
		$data['user-foreground2'] = "../assets/preset_images/snow/bg3-ani2.png";
	} else if ($preset_fg2_select == "five"){
		$data['user-foreground2'] = "../assets/preset_images/leaves/bg5-ani2.png";
	}

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
} /* background and foreground 2 */ else if (basename($_FILES['file2']['name']) == ""){
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	$data['user-backdrop'] = $target_bg_file;

	if ($preset_fg_select == "one"){
		$data['user-foreground'] = "../assets/preset_images/bg1-ani1.png";
	} else if ($preset_fg_select == "two"){
		$data['user-foreground'] = "../assets/preset_images/stars/bg4-ani1.png";
	} else if ($preset_fg_select == "three"){
		$data['user-foreground'] = "../assets/preset_images/rain/bg2-ani1.png";
	} else if ($preset_fg_select == "four"){
		$data['user-foreground'] = "../assets/preset_images/snow/bg3-ani1.png";
	} else if ($preset_fg_select == "five"){
		$data['user-foreground'] = "../assets/preset_images/leaves/bg5-ani1.png";
	}

	$data['user-foreground2'] = $target_fg2_file;

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
} /* background and forground 1 */ else if (basename($_FILES['file3']['name']) == ""){
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	$data['user-backdrop'] = $target_bg_file;

	$data['user-foreground'] = $target_fg_file;

	if ($preset_fg2_select == "one"){
		$data['user-foreground2'] = "../assets/preset_images/bg1-ani2.png";
	} else if ($preset_fg2_select == "two"){
		$data['user-foreground2'] = "../assets/preset_images/stars/bg4-ani2.png";
	} else if ($preset_fg2_select == "three"){
		$data['user-foreground2'] = "../assets/preset_images/rain/bg2-ani2.png";
	} else if ($preset_fg2_select == "four"){
		$data['user-foreground2'] = "../assets/preset_images/snow/bg3-ani2.png";
	} else if ($preset_fg2_select == "five"){
		$data['user-foreground2'] = "../assets/preset_images/leaves/bg5-ani2.png";
	}

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
} else {
	$tpl_file = "user-template.html";
	$tpl_path = "../";
	$usercreatedpath = "../user-pages/";

	$data['user-backdrop'] = $target_bg_file;

	$data['user-foreground'] = $target_fg_file;

	$data['user-foreground2'] = $target_fg2_file;

	$data['optional-text'] = $opt_text;

	$placeholders = array("{user-backdrop}", "{user-foreground1}", "{user-foreground2}", "{optional-text}");

	$tpl = file_get_contents($tpl_path.$tpl_file);

	$newpage_file = str_replace($placeholders, $data, $tpl);

	$html_file_name = $sid.".html";

	$fp = fopen($usercreatedpath.$html_file_name, "w");
	fwrite($fp, $newpage_file);
	fclose($fp);

	header("Location: ../user-pages/".$html_file_name);
}