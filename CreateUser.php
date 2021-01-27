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

	<?php include('Navbar/ManageUsers.html'); ?>

	<br>
	<br>

	<div class='container'>
		<div class='row'>
			<div class='col'>
			</div>

			<div class='col'>
				<h2> Benutzer einrichten </h2>
				<p> Geben die die Benutzerdaten vollständig ein: </p>
				<br>
				<form action='CreateUserInsert.php' method=POST>
					<input type="text" class="form-control" placeholder="Username" name="username">
					<br>
					<input type="text" class="form-control" placeholder="Nachname" name="surname">
					<br>
					<input type="text" class="form-control" placeholder="Vorname" name="givenname">
					<br>
					<input type="datetime-local" class="form-control" placeholder="Eintrittsdatum" name="entrydate">
					<br>
					<input type="password" class="form-control" placeholder="Password" name="password">
					<br>
					<input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword">
					<br>
					<select name="org" class="custom-select">
						<option selected> Organisation </option>
						<option value='NOC'> NOC </option>
						<option value='SOSY'> SoSy </option>
					</select>
					<br><br>
					<select name="accesslevel" class="custom-select">
						<option selected> Access Level </option>
						<option value='1'> 1 </option>
						<option value='2'> 2 </option>
					</select>
					<br>
					<br>
					<button type='submit' class="btn btn-primary"> Create User </button>
				</form>
			</div>
			<div class='col'>
			</div>
		</div>
	</div>
</body>

</html>