<?php
include('inc.php');
include('my_date_functions.php');
include('functions.php');
//$PrID = $_COOKIE['ProjectID'];
$ProjName = $_POST['proj_name'];
$Customer = $_POST['proj_cust'];
$SDate = date_gtoe($_POST['proj_sdate']);
$EDate = date_gtoe($_POST['proj_edate']);
$Industry = $_POST['proj_ind'];
$Description = $_POST['proj_desc'];

$update="INSERT proj SET p_name = '$ProjName', cust = '$Customer' , 
						s_date = '$SDate', 
						e_date = '$EDate' , 
						industry = '$Industry' , 
						descript = '$Description'";

$msg = "<strong>ERFOLG!</strong>Das Projekt " . $ProjName . " wurde angelegt.";
$ok = true;

if (mysqli_query($con,$update)){
    $msg = "<strong>ERFOLG!</strong> Das Projekt wurde angelegt.";
    $ok = true;
    $txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['userid']."' created project $PrID \n";
    file_put_contents("$file", $txt, FILE_APPEND | LOCK_EX);

}
else{
    $msg = "<strong>FEHLER!</strong> Das Projekt konnte nicht angelegt werden.\n ProjectID=".$ProjName." \n SQL=".$update."\n Error=".mysqli_error($con);
    $ok = false;
}
echo json_encode(
    array (
        'msg' => $msg,
        'ok' => $ok
    )
    );

?>