<!doctype html>
<html>
<?php
// Datum: 24.2.2021
// Änderung: 
// 	Elemente von CreateEmployee entfernt - sind jetzt in Archiv
//  Button "Eigenen Eintrag" hinzugefügt
?>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php

	if ($_COOKIE['uname'] == NULL) {

	echo "<meta http-equiv='refresh' content='0 url=index.html'>";
	}

	?>
	<style>
	.modal {
		display: none;
		position: fixed;
		z-index: 2;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgb(0, 0, 0);
		background-color: rgba(0, 0, 0, 0.4);
	}

	.modal-content {
		background-color: #fefefe;
		margin: 10% auto 15% auto;
		border: 1px solid #888;
		width: 30%;
	}

	.modalContainer {
		padding: 16px;
	}

	.animate {
		-webkit-animation: animatezoom 0.6s;
		animation: animatezoom 0.6s
	}

	@-webkit-keyframes animatezoom {
		from {
		-webkit-transform: scale(0)
		}

		to {
		-webkit-transform: scale(1)
		}
	}

	@keyframes animatezoom {
		from {
		transform: scale(0)
		}

		to {
		transform: scale(1)
		}
	}

	.second-layer {
		z-index: 1;
	}

	th {
		cursor: pointer;
	}
	</style>
</head>

<body>
	<?php 
		include('Alert.html');
		include('jumbotron.html');
		include('Navbar/Employees.html'); ?>

	<div class=container>
	<br>
	<br>
	<div class='row'>
		<div class='col-9'>
		<h2>Mitarbeiterliste</h2>
		<p>Klicke auf den Mitarbeiter für mehr Informationen</p>
		<br>
		</div>
		<div class='col-3'>
			<?php
				echo "<a href='EmployeeLink.php?emp_id=".$_COOKIE['userid']."' class='btn btn-info' role='button'>Zeige eigenen Eintrag</a>";
			?>
		</div>
	</div>

	<div class=row>
		<div class=col-4>
		<p><b> Search: </b></p>
		<input class=form-control type="text" id="employeeSearch" placeholder="Suche nach Mitarbeiter">
		</div>
		<div class=col-1>
		</div>
		<div class=col-2>
		<br><br>
		<input type="checkbox" class="form-check-input" id='filterRetired' onclick="filterTable()"> Zeige ausgeschiedene </input>
		</div>
	</div>
	<br>
	<?php
	include("inc.php");
	include("functions.php");
	$sql = mysqli_query($con, "SELECT id, sname , gname , uname, company, password, CASE retired WHEN 1 THEN 'ausgeschieden' ELSE 'aktiv' END AS ret FROM emp ORDER BY sname");
	EmployeeList($sql, 'EmployeeLink.php?', "0");
	?>
	</div>
	<script src='FilterEmployeeList.js'></script>
	<script src='sortTable.js'></script>
</body>

</html>