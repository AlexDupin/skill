<?php
	include('inc.php');
	include('functions.php');
	$TypeName=$_POST['NewSkill'];

	$requestSQL=mysqli_query($con,"SELECT * FROM Type WHERE AssetType LIKE '$TypeName'");
	$insertSQL="INSERT INTO Type SET AssetType='$TypeName'";

	$msg =  "<strong>SUCCESS!</strong> The type was created successfully";
	$ok = true;

	if (mysqli_num_rows($requestSQL)==0){
		if (mysqli_query($con,$insertSQL)){
			$txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['UserID']."' created Type $TypeName \n";
			file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
			$msg =  "<strong>SUCCESS!</strong> The type was created successfully";
			$ok = true;
		}
		else{
			$msg = "<strong>ERROR!</strong> Something went wrong";
			$ok = false;
		}

	}
	else{
		$msg = "<strong>ERROR!</strong> The type already exists";
		$ok = false;
	}


	echo json_encode(
		array (
			'ok' => $ok,
			'msg' => $msg
		)
	);
?>
