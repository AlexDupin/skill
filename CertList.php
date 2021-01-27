<!doctype html>
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
	include('Navbar/Cert.html'); ?>
	<br><br>
	<div class="container">
		<div class = row>
			<div class = col-9>
				<h2>Liste der Zertifikate </h2>
				<p>Auswählen eines Zertifikats durch Klicken oder Suchen mit der Such-Box<p> 
			</div>
			<div class = col-3>
				<button class = "btn btn-secondary" onclick = "document.getElementById('createCert').style.display='block'" style="width:auto;">Neues Zertifikat</button>
			</div>
		</div>	
		<br>

		<div class=row>
			<div class=col-4>
				<p><b> Suchen: </b></p>
				<input class = form-control type = "text" id = "certSearch" placeholder = "Nach Zertifikat suchen">
			</div>
			<div class = col-1>
			</div>
			<div class = col-3>
				<br><br>
				<input type = checkbox class = form-check-input id = 'filterRetired' onclick = "filterTable()"> Zeige Zertifikate ohne aktive Mitarbeiter </input>
			</sdiv>
			<div class = col-1>
			</div>
		</div>
		<br><br>

		<?php
			// Project List

			include("inc.php");
			include("functions.php");
			$sql=mysqli_query($con,"SELECT * FROM crt ORDER BY crt_name;"); 
			CertList($sql,'displayCert.php?');
		?>
	</div>

	<div class = modal id = "createCert">
		<form class = "modal-content animate">
			<span onclick="document.getElementById('createCert').style.display='none'" class="close" title="Close Modal" style="cursor: pointer">×</span>
			<div class = "modalContainer">
				<h3> Zertifikat anlegen </h3>
				<br>
				<?php
					echo "
					<div class='form-group'>
						<label for='NameFormInput'> Name des Zertifikats </label>
						<input type='text' class='form-control' id='id_crt_name'>
					</div>
					<div class='form-group'>
						<label form='skill_desc'> Beschreibung des Zertifikats </label>
						<textarea class='form-control' id='id_crt_desc' rows='6'></textarea>
					</div>
					<div class='form-group'>
						<label for='NameFormInput'> Herausgeber des Zertifikats </label>
						<input type='text' class='form-control' id='id_crt_issuer'>
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
	<script src = 'FilterCertList.js'></script>
	<script src = "CreateCert.js"></script>

	<script>
		//	Modal
		var modal = document.getElementById('createCert');
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
		var modal = document.getElementById('createCert');

	
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
				}
			}
	</script>
			
</body>
</html>