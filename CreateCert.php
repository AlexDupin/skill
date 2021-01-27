<?php
include('inc.php');
include('functions.php');
$CrtID = $_COOKIE['CertID'];
$CrtName = $_POST['crt_name'];
$Description = $_POST['crt_desc'];
$Issuer = $_POST['crt_issuer'];

$update="INSERT crt SET crt_name = '$CrtName' , 
						crt_desc = '$Description',
						crt_issuer = '$Issuer';";

$msg = "<strong>ERFOLG!</strong>Das Zertfikat wurde angelegt.";
$ok = true;

if (mysqli_query($con,$update)){
    $msg = "<strong>ERFOLG!</strong>Das Zertifikat wurde angelegt.";
    $ok = true;
    $txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['UserID']."' created project $TrgID \n";
    file_put_contents("$file", $txt, FILE_APPEND | LOCK_EX);

}
else{
    $msg = "<strong>FEHLER!</strong> Das Zertifikat konnte nicht angelegt werden.\n".$CrtID." - ".$update;
    $ok = false;
}
echo json_encode(
    array (
        'msg' => $msg,
        'ok' => $ok
    )
    );

?>