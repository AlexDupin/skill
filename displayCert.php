<!doctype html>

<!-- PRODUKTIONSVERSION -->

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php

	if ($_COOKIE['uname'] == NULL) {

		echo "<meta http-equiv='refresh' content='0 url=../index.html'>";
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
			width: 70%;
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

		th {
			cursor: pointer;
		}
	</style>
</head>

<body>
	<?php 
		error_reporting(0);
		include('Alert.html');
		include('jumbotron.html');
		include('Navbar/Cert.html');
	?>
	<br>
	<br>
	<div class="container">
		<div class=row>
			<div class=col-2></div>
			<div class=col>
				<button onclick="document.getElementById('editCert').style.display='block'" class='btn btn-primary btn-sm'>Zertifikat ändern</button>
			</div>
			<div class=col-2></div>
			<div class=col>
				<?php

					include('inc.php');
					include('functions.php');

					$CrtID = $_GET['id'];
					$EmpID = $_GET['emp_id'];
					setcookie('CertID', $CrtID);
					$Asql = mysqli_query($con, "SELECT * FROM crt WHERE crt_id='$CrtID'");
					$row = mysqli_fetch_assoc($Asql);
					$CrtName = $row['crt_name'];
					$CrtIssuer = $row['crt_issuer'];
					$Description = $row['crt_desc'];

					//<input type=checkbox class=form-check-input id='filterRetired' onchange="filterRetired()" style="margin-left: 15%"> <span style="margin-left: 25%;">Show retired </span></input>
					if ($EmpID>0) 
						echo "<a href='EmployeeLink.php?emp_id=".$EmpID."' class='btn btn-info btn-sm' role='button'>Zum Mitarbeiter</a>";				?>
			</div>
			<br>
			<br>
			<br>
		</div>
		<div class=row>
			<br>
			<div class=col>
				<?php
					//		Certificate Description
					echo " <br>
							<h4> Zertifikat: $CrtName </h4>
							<hr>
							<b>Herausgeber: </b> ".$CrtIssuer." 
							<hr>
							<b> Beschreibung: </b> <br>";
							print(nl2br($Description));
					echo "<br>"; 
				?>
			</div>
			<div class=col>
				<?php
					//		Certification Skill Employee
					if ($EmpID > 0) {
						$sql = mysqli_query($con, "SELECT * FROM pers_skill, emp WHERE emp_id='$EmpID' AND emp_id=emp.id AND th_crt_id='$CrtID'");
						$row = mysqli_fetch_assoc($sql);
						if (mysqli_num_rows($sql)>0) {
							echo " <br>
								<h4> ".$row['gname']." ".$row['sname']."</h4>
								<hr>
								<u> Definierter Skill Level in Zertifikat:</u> --> <b>".$row['th_exp_lvl']."</b><br>
								<u> Persönliche Kommentare zum Zertifikat: </u><br>";
								print (nl2br($row['th_exp_com']));
								echo "<br>"; 
							};
						};
				?>
			</div>
		</div>			
		<div class=row>
			<br>
			<div class=col>
				<hr>
				<?php
					$sql = mysqli_query($con, "SELECT e.id as id, e.sname as sname, e.gname as gname, e.company as company, CASE e.retired WHEN 1 THEN 'ausgeschieden' ELSE 'aktiv' END AS ret FROM emp as e, pers_skill as p where p.emp_id=e.id AND p.th_crt_id='$CrtID' ORDER BY e.sname;");
					$NumEmp = mysqli_num_rows($sql);
					if ($NumEmp>0) {
						echo "<br><h5>Liste der NOVEDAS-Mitarbeiter mit diesem Zertifikat: $NumEmp</h5><br>";
						EmployeeList($sql, 'EmployeeLink.php?');
						echo "<br>";
						}
					else {
						echo "<b>Kein Mitarbeiter hat dieses Zertifikat erworben.</b><br>";
						}
				?>
			</div>
		</div>
	</div>

	<div class = modal id = "editCert">
		<form class = "modal-content animate">
			<span onclick="document.getElementById('editCert').style.display='none'" class="close" title="Close Modal" style="cursor: pointer">×</span>
			<div class = "modalContainer">
				<h3> Zertifikat ändern </h3>
				<br>
				<?php
					echo "
					<div class='form-group'>
						<label for='NameFormInput'> Name des Zertifikats </label>
						<input type='text' class='form-control' id='id_crt_name' value='$CrtName'>
					</div>
					<div class='form-group'>
						<label for='NameFormInput'> Herausgeber des Zertifikats </label>
						<input type='text' class='form-control' id='id_crt_issuer' value='$CrtIssuer'>
					</div>
					<div class='form-group'>
						<label form='crt_desc'>Ausführliche Beschreibung des Zertifikats</label>
						<textarea class='form-control' id='id_crt_desc' rows='6'>$Description</textarea>
					</div>
					<div class='form-check'>
					</div>
					";
				?>
				<button type=button role=button class='btn btn-primary' id="btn-submit">Speichern</button>
			</div>
		</form>
	</div>
	<script src="EditCert.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", () => {

			const rows = document.querySelectorAll("tr[data-href]");

			rows.forEach(row => {
				row.addEventListener("click", () => {
					window.location.href = row.dataset.href;

				})
			})
		})
		var modal_edit = document.getElementById('editCert');
		var modal_show = document.getElementById('showProject');

		window.onclick = function(event) {
			if (event.target == modal_edit)
				modal_edit.style.display = "none";
				else
					if (event.target == modal_show)
						modal_show.style.display = "none";
			}
	</script>
</body>

</html>