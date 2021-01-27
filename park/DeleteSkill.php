<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php
	if ($_COOKIE['username'] == NULL or $_COOKIE['AccessLevel'] == 1) {

		echo "<meta http-equiv='refresh' content='0 url=index.html'>";
	}
	?>
</head>

<body>
	<?php include('jumbotron.html'); ?>

	<?php include('Navbar/Skills.html'); ?>

	<br>
	<br>

	<div class='container'>

		<?php

		include('inc.php');
		include('functions.php');

		$deleteskillid = $_COOKIE['deleteskill'];

		$sql = "DELETE FROM skill WHERE id = $deleteskillid";

		if (mysqli_query($con, $sql)) {
			echo "<div class='alert alert-success'> <strong>Erfolg!</strong> Der Skill wurde erfolgreich gelöscht</div>";
			$txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['UserID'] . "' deleted Skill '$deleteskillid' \n";
			file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
		} else {
			echo "<div class='alert alert-danger'> <strong>ERROR!</strong> Something went wrong while deleting the skill</div>";
		}
		?>
	</div>
</body>

</html>