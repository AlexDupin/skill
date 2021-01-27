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
		
		echo "<br><br>";

		include('inc.php');
		include('functions.php');

		$userid = $_GET['id'];
		setcookie('deleteuserid', $userid);

		$sql = mysqli_query($con, "SELECT * FROM emp WHERE id = $userid");
		$row = mysqli_fetch_assoc($sql);

		$username = $row['uname'];
		$surname = $row['sname'];
		$givenname = $row['gname'];
		$date_of_entry = new DateTime($row['d_of_entry']);
		$d1 = $date_of_entry->format('d.m.Y');
		$date_of_exit = new DateTime($row['d_of_exit']);
		$d2 = $date_of_exit->format('d.m.Y');
		$accesslevel = $row['acclvl'];

	?>

	<div class='container'>
		<div class='row'>
			<div class='col'>
			</div>

			<div class='col'>
				<h2> Benutzer bearbeiten </h2>
				<p> Bearbeite Benutzername oder Zugriffsrechte </p>
				<br>
				<form action='EditUserInsert.php' method=POST>
					<?php
						echo "
							<input type='text' class='form-control' placeholder='Benutzername' value='" . $username . "' name='username'>
							<br>
							<input type='text' class='form-control' label='Nachname' placeholder='Nachname' value='" . $surname . "' name='surname'>
							<br>
							<input type='text' class='form-control' label='Vorname' placeholder='Vorname' value='" . $givenname . "' name='givenname'>
							<br>					
							<input type='date' class='form-control' label='Benutzername'placeholder='Eintrittsdatum' value='" . $d1 . "'name='entrydate'>
							<br>
							<input type='date' class='form-control' label='Benutzername'placeholder='Austrittsdatum' value='" . $d2 . "' name='exitdate'>
							<br>
							<input type='password' class='form-control' placeholder='Password' name='password'>
							<br>
							<input type='password' class='form-control' placeholder='Confirm Password' name='confirmpassword'>
							<br>

							<select name='accesslevel' class='custom-select'>
							";
						if ($accesslevel == 1) {
							echo "
								<option selected value = '1'> 1 </option>
								<option value = '2'> 2 </option>
									";
							}
						else {
							echo "
								<option value = '1'> 1 </option>
								<option selected value = '2'> 2 </option>";
							}
					?>
					</select>
					<br>
					<br>
					<button type='submit' class="btn btn-primary"> Aktualisiere Benutzer </button>
					<a href='DeleteUser.php' role='button' class='btn btn-secondary'> Lösche Benutzer </a>
				</form>
			</div>
			<div class='col'>
			</div>
		</div>
	</div>
</body>

</html>