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
		include('Navbar/Trainings.html');
	?>
	<br>
	<br>
	<div class="container">
		<div class=row>
			<div class=col-2></div>
			<div class=col>
				<button onclick="document.getElementById('editTraining').style.display='block'" class='btn btn-primary btn-sm'>Schulung ändern</button>
			</div>
			<div class=col-2></div>
			<div class=col>
				<?php

					include('inc.php');

					$TrgID = $_GET['id'];
					$EmpID = $_GET['emp_id'];
					$Asql = mysqli_query($con, "SELECT * FROM trg WHERE trg_id='$TrgID'");
					$row = mysqli_fetch_assoc($Asql);
					$TrgName = $row['trg_name'];
					$Description = $row['trg_desc'];

					//<input type=checkbox class=form-check-input id='filterRetired' onchange="filterRetired()" style="margin-left: 15%"> <span style="margin-left: 25%;">Show retired </span></input>
					if ($EmpID>0) 
						echo "<a href='EmployeeLink.php?emp_id=".$EmpID."' class='btn btn-info btn-sm' role='button'>Zum Mitarbeiter</a>";				?>
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
							<h4> Schulung: $TrgName </h4>
							<hr>
							<b> Beschreibung: </b> <br>";
							print(nl2br($Description));
					echo "<hr><br>"; 
				?>
			</div>
			<div class=col>
				<?php
					//		Training Skill Employee
					if ($EmpID > 0) {
						$sql = mysqli_query($con, "SELECT * FROM pers_skill, emp WHERE emp_id='$EmpID' AND emp_id=emp.id AND th_trg_id='$TrgID'");
						$row = mysqli_fetch_assoc($sql);
						if (mysqli_num_rows($sql)>0) {
						echo " 
							<h4> ".$row['gname']." ".$row['sname']."</h4>
							<hr>
							<u> Vermittelter Skill Level in Schulung:</u> --> <b>".$row['th_exp_lvl']."</b><br>
							<u> Persönliche Kommentare zur Projekt: </u><br>";
							print (nl2br($row['th_exp_com']));
							echo "<hr><br>"; 
						};
					};
				?>
		</div>
	</div>
	<div class = modal id = "editTraining">
		<form class = "modal-content animate">
			<span onclick="document.getElementById('editTraining').style.display='none'" class="close" title="Close Modal" style="cursor: pointer">×</span>
			<div class = "modalContainer">
				<h3> Schulung ändern </h3>
				<br>
				<?php
					echo "
					<div class='form-group'>
						<label for='NameFormInput'> Name der Schulung </label>
						<input type='text' class='form-control' id='id_trg_name' value='$TrgName'>
					</div>
					<div class='form-group'>
						<label form='trg_desc'>Ausführliche Beschreibung der Schulung</label>
						<textarea class='form-control' id='id_trg_desc' rows='6'>$Description</textarea>
					</div>
					<div class='form-check'>
					</div>
					";
				?>
				<button type=button role=button class='btn btn-primary' id="btn-submit">Speichern</button>
			</div>
		</form>
	</div>
	<script src="EditTraining.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", () => {

			const rows = document.querySelectorAll("tr[data-href]");

			rows.forEach(row => {
				row.addEventListener("click", () => {
					window.location.href = row.dataset.href;

				})
			})
		})
		var modal_edit = document.getElementById('editTraining');
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