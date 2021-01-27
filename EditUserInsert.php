<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/css/Customstyles.css">

	<?php
	if ($_COOKIE['uname'] == NULL or $_COOKIE['acclvl'] == 1) {

		echo "<meta http-equiv='refresh' content='0 url=index.html'>";
	}
	?>
</head>

<body>
	<?php 
		include('jumbotron.html');
		include('Navbar/ManageUsers.html');
		
		echo "
			<br><br>
			<div class='container'>";

		include('inc.php');
		include('functions.php');

		$username = $_POST['username'];
		$givenname = $_POST['givenname'];
		$surname = $_POST['surname'];
		$entrydate = $_POST['entrydate']; // formatted in d.m.y
		$exitdate = $_POST['exitdate'];	// formatted in d.m.y
		$accesslevel = $_POST['accesslevel'];
		$userid = $_COOKIE['deleteuserid'];
		$pwd1 = $_POST['password'];
		$pwd2 = $_POST['confirmpassword'];

		if ($pwd1==$pwd2) {
			if ($pwd1 != '') { // Update with PW change
				$passwordhashed = password_hash($pwd1, PASSWORD_BCRYPT);
				$sql = "UPDATE emp SET uname = '$username' , gname='$givenname' , sname='$surname' , d_of_entry=STR_TO_DATE('$entrydate',\"%d.%m.%Y\") , d_of_exit=STR_TO_DATE('$exitdate',\"%d.%m.%Y\") , acclvl = '$accesslevel' , password='$passwordhashed' WHERE Id = '$userid';";
				}
			else // update without PW change
				$sql = "UPDATE emp SET uname = '$username' , gname='$givenname' , sname='$surname' , d_of_entry=STR_TO_DATE('$entrydate',\"%d.%m.%Y\") , d_of_exit=STR_TO_DATE('$exitdate',\"%d.%m.%Y\") , acclvl = '$accesslevel' WHERE Id = '$userid';";

			if (mysqli_query($con, $sql)) {
				echo "<div class='alert alert-success'> <strong>ERFOLG!</strong> Der Benutzereintrag wurde aktualisiert</div>";
				$txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['uname'] . "' edited User $userid \n";
				file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
				} 
			else
				echo "<div class='alert alert-danger'> <strong>FEHLER!</strong> Irgendwas ist beim Update schiefgegangen</div>";
			}
		else
			echo "<div class='alert alert-danger'> <strong>FEHLER!</strong> Die Passwörter stimmen nicht überein.</div>";

	?>
	</div>
</body>

</html>