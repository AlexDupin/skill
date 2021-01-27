<?php
include('inc.php');
include('functions.php');
$CrtID = $_COOKIE['CertID'];
$CrtName = $_POST['crt_name'];
$CrtIssuer = $_POST['crt_issuer'];
$Description = $_POST['crt_desc'];

$update="UPDATE crt SET crt_name = '$CrtName' , 
						crt_issuer = '$CrtIssuer',
						crt_desc = '$Description'
						WHERE crt_id='$CrtID'";
						
$msg = "<strong>SUCCESS!</strong> The update was successfull";
$ok = true;

if (mysqli_query($con,$update)){
    $msg = "<strong>SUCCESS!</strong> The update was successfull";
    $ok = true;
    $txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['UserID']."' edited Cert $TrgID \n";
    file_put_contents("$file", $txt, FILE_APPEND | LOCK_EX);

}
else{
    $msg = "<strong>ERROR!</strong> The update was not successfull".$CrtID." - ".$update;
    $ok = false;
}
echo json_encode(
    array (
        'msg' => $msg,
        'ok' => $ok
    )
    );

?>