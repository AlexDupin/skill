<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php
	if ($_COOKIE['uname'] == NULL or $_COOKIE['acclvl'] == 1) {

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

		$skillid = $_COOKIE['skill_id'];
		$skillname = $_POST['name'];		
		$skillSDesc = $_POST['s_desc'];
		$skillLDesc = $_POST['l_desc'];

		$sql = "UPDATE skill SET name = '$skillname' , s_desc = '$skillSDesc' , l_desc = '$skillLDesc' WHERE Id = '$skillid';";
		if (mysqli_query($con, $sql)) {
			echo "<div class='alert alert-success'> <strong>ERFOLG!</strong> DIESE Änderung war erfolgreich. </div>";
			$txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['uname'] . "' edited Skill $skillid \n";
			file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
		} else {
			echo "<div class='alert alert-danger'> <strong>FEHLER!</strong> Etwas ist beim Ändern schiefgegangen</div>";
		}

		?>
	</div>
</body>

</html>