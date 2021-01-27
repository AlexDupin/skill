<!doctype html>

<!-- PRODUKIONSVERSION -->

<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<?php
		if ($_COOKIE['uname']==NULL){	
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
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.4);
		}

		.modal-content {
			background-color: #fefefe;
			margin: 10% auto 15% auto;
			border: 1px solid #888;
			width: 50%;
		}
		.modalContainer {
			padding: 16px;
			}

		.animate {
			-webkit-animation: animatezoom 0.6s;
			animation: animatezoom 0.6s
			}

		@-webkit-keyframes animatezoom {
			from {-webkit-transform: scale(0)} 
			to {-webkit-transform: scale(1)}
			}
			
		@keyframes animatezoom {
			from {transform: scale(0)} 
			to {transform: scale(1)}
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
		include('Navbar/Projects.html'); ?>
	<br><br>
	<div class="container">
		<div class = row>
			<div class = col-9>
				<h2>Liste der Projekte </h2>
				<p>Auswählen eines Projektes durch Klicken oder Suchen mit der Such-Box<p> 
			</div>
			<div class = col-3>
				<button class = "btn btn-secondary" onclick = "document.getElementById('createProject').style.display='block'" style="width:auto;">Neues Projekt</button>
			</div>
		</div>	
		<br>

		<div class=row>
			<div class=col-4>
				<p><b> Suchen: </b></p>
				<input class = form-control type = "text" id = "projectSearch" placeholder = "Nach Projekt suchen">
			</div>
			<div class = col-1>
			</div>
			<div class = col-3>
				<br><br>
				<input type = checkbox class = form-check-input id = 'showDesc' onclick = "myFunction()"> Zeige Beschreibung </input>
			</sdiv>
			<div class = col-1>
			</div>
		</div>
		<br><br>

		<?php
			// Project List

			include("inc.php");
			include("my_date_functions.php");
			include("functions.php");
			$sql=mysqli_query($con,"SELECT * FROM proj ORDER BY p_name;"); 
			ProjectList($sql,'displayProject.php?');
		?>
	</div>

	<div class = modal id = "createProject">
		<form class = "modal-content animate">
			<span onclick="document.getElementById('createProject').style.display='none'" class="close" title="Close Modal" style="cursor: pointer">×</span>
			<div class = "modalContainer">
				<h3> Projekt anlegen </h3>
				<br>
				<?php
					$tmp = "Projektziele:\nProjektbestandteile:\nProjektvorgehen (in groben Stichpunkten):\nWas wurde wirklich erreicht:";
					echo "
					<div class='form-group'>
						<label for='NameFormInput'> Name des Projekts </label>
						<input type='text' class='form-control' id='id_proj_name'>
					</div>
					<div class=row>
						<div class=col>
							<div class='form-group'>
								<placeholder for='CustFormInput'>Kunde</placeholder>
								<input type='text' class='form-control' id='id_proj_cust'>
							</div>
						</div>
						<div class=col>
							<div class='form-group'>
								<placeholder for='IndustryFormInput'>Branche</placeholder>
								<input type='text' class='form-control' id='id_proj_industry'>
							</div>
						</div>
					</div>
					<div class=row>
						<div class=col>
							<div class='form-group'>
								<placeholder for=''>Beginn des Projektes für NOVEDAS</placeholder>
								<input type='text' class='form-control' id='id_proj_sdate' placeholder='TT.MM.JJJJ'>
							</div>
						</div>
						<div class=col>
							<div class='form-group'>
								<placeholder for='SDateFormInput'>Ende des Projektes für NOVEDAS</placeholder>
								<input type='text' class='form-control' id='id_proj_edate' placeholder='TT.MM.JJJJ'>
							</div>
						</div>
					</div>
					<div class='form-group'>
						<label form='skill_desc'>Ausführliche Beschreibung des Projektes</label>
						<textarea class='form-control' id='id_proj_desc' rows='6'>$tmp</textarea>
					</div>
					<div class='form-check'>
					</div>
					";
				?>
				<button type=button role=button class='btn btn-primary' id="btn-submit">Speichern</button>
			</div>
		</form>
	</div>


	<script src = 'sortTable.js'></script>
	<script src = 'FilterProjectList.js'></script>
	<script src = "CreateProject.js"></script>

	<script>
		//	Modal
		var modal = document.getElementById('createProject');
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", () =>{

			const rows = document.querySelectorAll("tr[data-href]");

			rows.forEach( row => {
				row.addEventListener("click", () => {
					window.location.href = row.dataset.href;

					})
				})
			})
		var modal = document.getElementById('createProject');

	
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
				}
			}
	</script>
			
</body>
</html>