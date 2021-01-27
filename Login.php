<?php
	include('inc.php');
	$username = isset($_POST['username']) ? $_POST['username']:'';
	$password = isset($_POST['password']) ? $_POST['password']:'';
	setcookie("username",$username);
	setcookie("password",$password);

	$con = mysqli_connect($host,$user,$passwd,$datenbank) or die("<h5>Error:Die Datenbank ist momentan nicht erreichbar</h5>");
	$row = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM emp WHERE uname='$username';"));
	$PW = $row['password'];
	$valid = TRUE;

	if (password_verify($password,$PW)){
		$valid = TRUE;
		setcookie("acclvl",$row['acclvl']);
		setcookie("uname",$row['uname']);
		setcookie("NewLogin","True");
		setcookie("userid",$row[id]);
			}
	else{
			$valid = FALSE;
// 			setcookie("username","", time()-3600);
// 			setcookie("password","", time()-3600);
		}

	echo $valid;
?>