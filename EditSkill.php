<?php

include('inc.php');
include('functions.php');

$Id = $_COOKIE['skill_id'];
$Name = $_POST['skill_name'];
$S_Desc = $_POST['skill_sdesc'];
$L_Desc = $_POST['skill_ldesc'];

$select = mysqli_query($con,"SELECT * FROM skill WHERE id = '$Id'");

$update = "UPDATE skill SET Name='$Name' , s_desc='$S_Desc' , l_desc='$L_Desc'  WHERE s_id = '$Id';";

$message = "<strong>ERFOLG!</strong> Die Änderung wurde durchgeführt";
$ok = true;

if (mysqli_query($con,$update)){
	$txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['uname']."' edited Skill $Name \n";
	file_put_contents("../$file", $txt, FILE_APPEND | LOCK_EX);
	$message = "<strong>ERFOLG!</strong> Diese Änderung war erfolgreich.";
	$ok = true;
	}			
	else 
		{
		$message = "<strong>FEHLER!</strong> Die Änderung war nicht erfolgreich";
		$ok = false;
	}

echo json_encode(
	array (
		'ok' => $ok,
		'msg' => $message
	)
);
?>