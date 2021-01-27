<?php
include('inc.php');
include('functions.php');
$TrgID = $_COOKIE['TrainingID'];
$TrgName = $_POST['trg_name'];
$Description = $_POST['trg_desc'];

$update="INSERT trg SET trg_name = '$TrgName' , 
						trg_desc = '$Description'";

$msg = "<strong>ERFOLG!</strong>Die Schulung wurde angelegt.";
$ok = true;

if (mysqli_query($con,$update)){
    $msg = "<strong>ERFOLG!</strong>Die Schulung wurde angelegt.";
    $ok = true;
    $txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['UserID']."' created project $TrgID \n";
    file_put_contents("$file", $txt, FILE_APPEND | LOCK_EX);

}
else{
    $msg = "<strong>FEHLER!</strong> Die Schulung konnte nicht angelegt werden.\n".$TrgID." - ".$update;
    $ok = false;
}
echo json_encode(
    array (
        'msg' => $msg,
        'ok' => $ok
    )
    );

?>