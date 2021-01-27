<?php
	include('inc.php');
	include('functions.php');
	$EID = $_COOKIE['EmployeeId'];
	$PS_ID=$_GET["ps_id"];
	
	$sql = "DELETE FROM pers_skill WHERE id='" . $PS_ID . "';";
	if (mysqli_query($con, $sql)) {
	   header("location: EmployeeLink.php?emp_id=$EID");
	   exit();
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
	mysqli_close($conn);
?>