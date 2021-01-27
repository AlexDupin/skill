<?php

include('inc.php');
include('functions.php');

$SkillName = $_POST['skill_name'];
$SkillShortDescription = $_POST['skill_sdesc'];
$SkillLongDescription = $_POST['skill_ldesc'];

$msg = null;
$ok = null;

$insert = "INSERT INTO skill SET name='$SkillName' , s_desc='$SkillShortDescription' , l_desc='$SkillLongDescription';";

if (mysqli_query($con, $insert)) {
    $msg = "<strong>ERFOLG!</strong> Der Skill <strong> '$SkillName' </strong> wurde angelegt.";
    $ok = true;
    try {
        $txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['uname'] . "' created Skill $SkillName \n";
        file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
    }
    catch(Exception $php_errormsg){
        $msg = "<strong>ERROR! </strong> Der Skill wurde erfolgreich angelegt, aber die Datei: 'log.txt' konnte nicht geöffnet werden. Überprüfen Sie die Konfiguration.";
    }
    }
else {
    $msg = "<strong>ERROR!</strong> The Assignment was unsuccessfull '$insert'. (Hint: Did you use '.' as decimal? ";
    $ok = false;
}

echo json_encode(
    array (
        'msg' => $msg,
        'ok' => $ok,
        'tag' => $SkillName,
    )
    );

?>
