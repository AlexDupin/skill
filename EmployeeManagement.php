<!doctype html>
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

	<?php 
		include('jumbotron.html');
		include('Navbar/ManageUsers.html'); 
	?>

	<br>
	<br>

	<div class='container'>
		<div class='row'>
			<div class='col'>
				<h2> Benutzerverwaltung </h2>
				<p> Wählen Sie einen Benutzer zum Bearbeiten aus: </p>
				<br>
			</div>
			<div class='col'>

			</div>
			<div class='col'>
				<br>
				<a href='CreateUser.php' role='button' class='btn btn-secondary'> Create User </a>
			</div>
		</div>

		<br>
		<br>

		<?php

		include('inc.php');
		include('functions.php');

		$sql = mysqli_query($con, "SELECT * FROM emp;");
		UserList($sql, 'EditUser.php?');
		?>
	</div>
	<script>
		document.addEventListener("DOMContentLoaded", () => {

			const rows = document.querySelectorAll("tr[data-href]");

			rows.forEach(row => {
				row.addEventListener("click", () => {
					window.location.href = row.dataset.href;

				})
			})
		})
	</script>
</body>

</html>