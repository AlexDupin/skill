<?php
include('inc.php');
include('functions.php');
include('my_date_functions.php');
$PrID = $_COOKIE['ProjectID'];
$ProjName = $_POST['proj_name'];
$Customer = $_POST['proj_cust'];
$SDate = date_gtoe($_POST['proj_sdate']);
$EDate = date_gtoe($_POST['proj_edate']);
$Industry = $_POST['proj_ind'];
$Description = $_POST['proj_desc'];



$update="UPDATE proj SET p_name = '$ProjName' , 
						cust = '$Customer' , 
						s_date = '$SDate', 
						e_date = '$EDate' , 
						industry = '$Industry' , 
						descript = '$Description'
					WHERE pr_id='$PrID'";

$msg = "<strong>SUCCESS!</strong> The update was successfull";
$ok = true;

if (mysqli_query($con,$update)){
    $msg = "<strong>SUCCESS!</strong> The update was successfull";
    $ok = true;
    $txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['userid']."' edited project $PrID \n";
    file_put_contents("$file", $txt, FILE_APPEND | LOCK_EX);

}
else{
	$err = mysqli_error($con);
    $msg = "<strong>ERROR!</strong> The update was not successfull. ProjectID=".$PrID." - SQL=".$update." - MYSQL Error:".$err;
    $ok = false;
}
echo json_encode(
    array (
        'msg' => $msg,
        'ok' => $ok
    )
    );

?>