<!doctype html>
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
		include('Navbar/Projects.html'); 
	?>
	<br>
	<br>
	<div class="container">
		<div class=row>
			<div class=col-2></div>
			<div class=col>
				<button onclick="document.getElementById('editProject').style.display='block'" class='btn btn-primary btn-sm'>Projekt ändern</button>
			</div>
			<div class=col-2></div>
			<div class=col>
				<?php

					include('inc.php');
					include("my_date_functions.php");
					include('functions.php');
					$PrID = $_GET['id'];
					$EmpID = $_GET['emp_id'];
					setcookie('ProjectID', $PrID);
					$Asql = mysqli_query($con, "SELECT * FROM proj WHERE pr_id='$PrID'");
					$row = mysqli_fetch_assoc($Asql);
					$ProjName = $row['p_name'];
					$Customer = $row['cust'];
					$SDate = date_etog($row['s_date']);
					$EDate = date_etog($row['e_date']);
					$Industry = $row['industry'];
					$Area = $row['area'];
					$Description = $row['descript'];

					//<input type=checkbox class=form-check-input id='filterRetired' onchange="filterRetired()" style="margin-left: 15%"> <span style="margin-left: 25%;">Show retired </span></input>
					if ($EmpID>0) 
						echo "<a href='EmployeeLink.php?emp_id=".$EmpID."' class='btn btn-info btn-sm' role='button'>Zum Mitarbeiter</a>";
				?>
			</div>
			<br>
			<br>
			<br>
		</div>
		<div class=row>
			<div class=col>
				<?php
					//		Project Description

					echo " 
							<h4> Projekt: $ProjName </h4>
							<hr>
							<b> Kunde: </b> $Customer <br>
							<b> Branche: </b> $Industry <br>
							<b> Area: </b> $Area
							<hr>
							<b> Start des Projektes für NOVEDAS: </b> $SDate <br>
							<b> Ende des Projektes für NOVEDAS: </b> $EDate <br>
							<hr>
							<b> Beschreibung </b> <br>";
							print (nl2br($Description));
							echo "<br>";
				?>
			</div>
			<div class=col>
					<?php
					//		Project Skill Of Employee
					if ($EmpID > 0) {
						$sql = mysqli_query($con, "SELECT * FROM pers_skill, emp WHERE emp_id='$EmpID' AND emp_id=emp.id AND pr_proj_id='$PrID'");
						$row = mysqli_fetch_assoc($sql);
						if (mysqli_num_rows($sql)>0) {
						echo " 
							<h4> ".$row['gname']." ".$row['sname']."</h4>
							<hr>
							<b> Skill Level in diesem Projekt: </b>".$row['pr_exp_lvl']."<br>
							<b> Startdatum in diesem Projekt: </b>".date_etog($row['pr_start'])."<br>
							<b> Enddatum in diesem Projekt:  </b>".date_etog($row['pr_end'])."<hr>
							<b> Aufgaben / Persönliche Kommentare zum Projekt: </b><br>";
							print (nl2br($row['pr_exp_com']));
							echo "<br>"; 
						};
					};
				?>
			</div>
		</div>
		<div class=row>
			<div class=col>
				<hr>
				<?php
					$sql = mysqli_query($con, "SELECT e.id as id, e.sname as sname, e.gname as gname, e.company as company, p.pr_proj_id as pr_id, p.emp_id as emp_id, p.skill_id, s.name as skillname FROM emp as e, pers_skill as p, skill as s where emp_id=e.id AND p.pr_proj_id='$PrID' AND p.skill_id=s.s_id ORDER BY e.sname;");
					$NumEmp = mysqli_num_rows($sql);
					if ($NumEmp>0) {
						echo "<h5>Liste der mitwirkenden NOVEDAS-Mitarbeiter: $NumEmp</h5><br>";
						// Zeige die Skills an statt der Firma
						EmployeeList($sql, 'EmployeeLink.php?', '1');
						}
					else {
						echo "<b>Keine Mitarbeiter haben an diesem Projekt mitgewirkt.</b><br>";
						// echo "Abfrage-Fehler:".mysqli_error($con).".....<br>";
						}

				?>
			</div>
		</div>
	</div>
	<div class = modal id = "editProject">
		<form class = "modal-content animate">
			<span onclick="document.getElementById('editProject').style.display='none'" class="close" title="Close Modal" style="cursor: pointer">×</span>
			<div class = "modalContainer">
				<h3> Projekteintrag ändern </h3>
				<br>
				<?php
					echo "
					<div class='form-group'>
						<label for='NameFormInput'> Name des Projekts </label>
						<input type='text' class='form-control' id='id_proj_name' value='$ProjName'>
					</div>
					<div class=row>
						<div class=col>
							<div class='form-group'>
								<placeholder for='CustFormInput'>Kunde</placeholder>
								<input type='text' class='form-control' id='id_proj_cust' value='$Customer'>
							</div>
						</div>
						<div class=col>
							<div class='form-group'>
								<placeholder for='IndustryFormInput'>Branche</placeholder>
								<input type='text' class='form-control' id='id_proj_industry' value='$Industry'>
							</div>
						</div>
					</div>
					<div class=row>
						<div class=col>
							<div class='form-group'>
								<placeholder for=''>Beginn des Projektes für NOVEDAS</placeholder>
								<input type='text' class='form-control' id='id_proj_sdate' value='$SDate'>
							</div>
						</div>
						<div class=col>
							<div class='form-group'>
								<placeholder for='SDateFormInput'>Ende des Projektes für NOVEDAS</placeholder>
								<input type='text' class='form-control' id='id_proj_edate' value='$EDate'>
							</div>
						</div>
					</div>
					<div class='form-group'>
						<label form='skill_desc'>Ausführliche Beschreibung des Projektes</label>
						<textarea class='form-control' id='id_proj_desc' rows='6'>$Description</textarea>
					</div>
					<div class='form-check'></div>";
				?>
				<button type=button role=button class='btn btn-primary' id="btn-submit">Speichern</button>
			</div>
		</form>
	</div>
	<script src="EditProject.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", () => {

			const rows = document.querySelectorAll("tr[data-href]");

			rows.forEach(row => {
				row.addEventListener("click", () => {
					window.location.href = row.dataset.href;

				})
			})
		})
		var modal_edit = document.getElementById('editProject');
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