<?php
	include('inc.php');
	include('my_date_functions.php');
	include('functions.php');
	$id = $_COOKIE['EmployeeId'];
	$FirstName=$_POST['firstname'];
	$LastName=$_POST['lastname'];
	$DateOfEntry=date_gtoe($_POST['entrydate']);
	$DateOfExit=date_gtoe($_POST['exitdate']);
	$Organization=$_POST['organization'];
	$pwd1=$_POST['pwd1'];
	$pwd2=$_POST['pwd2'];

	$msg = "<strong>ERFOLG!</strong> Der Benutzereintrag wurde aktualisiert";
	$ok = true;


	if ($pwd1==$pwd2) {
		if ($pwd1 != '') { // Update with PW change
			$passwordhashed = password_hash($pwd1, PASSWORD_BCRYPT);
			$sql = "UPDATE emp SET gname='$FirstName' , sname='$LastName' , d_of_entry='$DateOfEntry' , d_of_exit='$DateOfExit' , password='$passwordhashed' WHERE id = '$id';";
			}
		else {// update without PW change
			$sql = "UPDATE emp SET gname='$FirstName' , sname='$LastName' , d_of_entry='$DateOfEntry' , d_of_exit='$DateOfExit' WHERE Id = '$id';";
			}
		if (mysqli_query($con, $sql)) {
			$msg = "<strong>ERFOLG!</strong> Der Benutzereintrag wurde aktualisiert";
			$ok = true;
			$txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['uname'] . "' edited employee $id \n";
			file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
			} 
		else {
			$msg = "<strong>FEHLER!</strong> Da ist etwas schiefgelaufen:".mysqli_error($con);
			$ok = false;
			}
		}
	else {
		$msg = "<strong>FEHLER!</strong> Die Passwörter sind nicht gleich";
		$ok = false;
		}

	echo json_encode(
		array (
			'msg' => $msg,
			'ok' => $ok
			)
		);

?>