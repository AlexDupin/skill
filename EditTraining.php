<?php
include('inc.php');
include('functions.php');
$TrgID = $_COOKIE['TrainingID'];
$TrgName = $_POST['trg_name'];
$Description = $_POST['trg_desc'];

$update="UPDATE trg SET trg_name = '$TrgName' , 
						trg_desc = '$Description'
						WHERE trg_id='$TrgID'";
						
$msg = "<strong>SUCCESS!</strong> The update was successfull";
$ok = true;

if (mysqli_query($con,$update)){
    $msg = "<strong>SUCCESS!</strong> The update was successfull";
    $ok = true;
    $txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['UserID']."' edited Training $TrgID \n";
    file_put_contents("$file", $txt, FILE_APPEND | LOCK_EX);

}
else{
    $msg = "<strong>ERROR!</strong> The update was not successfull".$TrgID." - ".$update;
    $ok = false;
}
echo json_encode(
    array (
        'msg' => $msg,
        'ok' => $ok
    )
    );

?>