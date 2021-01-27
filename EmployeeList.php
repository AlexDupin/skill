<!doctype html>
<html>

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
	<?php include('Alert.html'); ?>
	<div class=modal id="createEmployee">
	<form class="modal-content animate">
		<span onclick="document.getElementById('createEmployee').style.display='none'" class="close" title="Close Modal">×</span>
		<div class="modalContainer">
		<h2> Create Employee </h2>
		<br>
		<input type="text" class="form-control" placeholder="Vorname" id="firstname">
		<br>
		<input type="text" class="form-control" placeholder="Nachname" id="lastname">
		<br>
		<input type="text" class="form-control" placeholder="User Name" id="username">
		<br>
		<select id="organization" class="custom-select">
			<option value=''>Firma</option>
			<option>NOC</option>
			<option>SoSy</option>
		</select>
		<br>
		<br>
		<select id="accesslevel" class="custom-select">
			<option value=''>Zugriffsrechte</option>
			<option>Administrator</option>
			<option>Benutzer</option>
		</select>
		<br>
		<br>
		<input type="text" class="form-control" placeholder="Kennwort" id="password">
		<br>
		<button type='button' id="btn-submit" class="btn btn-primary"> Mitarbeiter anlegen </button>
		</div>
	</form>
	</div>


	<?php include('jumbotron.html'); ?>


	<?php include('Navbar/Employees.html'); ?>
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
<!-- 
		<button class='btn btn-secondary' onclick="document.getElementById('createEmployee').style.display='block'"> Mitarbeiter anlegen </button>
 -->
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
	EmployeeList($sql, 'EmployeeLink.php?');
	?>
	</div>
	<script src='FilterEmployeeList.js'></script>
	<script src='sortTable.js'></script>
	<script src="CreateEmployee.js"></script>
	<script>
	var modal = document.getElementById('createEmployee');


	window.onclick = function(event) {
		if (event.target == modal) {
		modal.style.display = "none";
		}
	}
	</script>
</body>

</html>