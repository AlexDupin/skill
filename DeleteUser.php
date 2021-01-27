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
	<?php include('jumbotron.html'); ?>

	<?php 
	
		include('Navbar/ManageUsers.html'); ?>

		<br>
		<br>

		<div class='container'>

			<?php

			include('inc.php');
			include('functions.php');

			$deleteuserid = $_COOKIE['deleteuserid'];

			// first delete all the personal skills from the database
			$sql = "DELETE FROM pers_skill WHERE emp_id = $deleteuserid";
			if (mysqli_query($con, $sql)) {
				// then delete the user entry itself
				$sql = "DELETE FROM emp WHERE id = $deleteuserid";
				if (mysqli_query($con, $sql)) {
					echo "<div class='alert alert-success'> <strong>SUCCESS!</strong> The User was successfully deleted</div>";
					$txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['uname'] . "' deleted User '$deleteuserid' \n";
					file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
					} 
				else {
					echo "<div class='alert alert-danger'> <strong>ERROR!</strong> Something went wrong while deleting the user:". $sql."/".mysqli_error($con)."</div>";
					}
				}
			else {
				echo "<div class='alert alert-danger'> <strong>ERROR!</strong> Something went wrong while deleting the user: ". $sql."/".mysqli_error($con)."</div>";
				}
		?>
	</div>
</body>

</html>