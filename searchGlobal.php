<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/bootstrap.css">
		
		<?php
			if ($_COOKIE['uname'] == NULL){
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
				background-color: rgb(0,0,0);
				background-color: rgba(0,0,0,0.4);
			}

			.modal-content {
				background-color: #fefefe;
				margin: 3% auto;
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
			include('Navbar/Dashboard.html');
			include("my_date_functions.php");
		?>

		<br>
		<br>
		<div class="container">
			<div class="row">
				<div class="col">
					<?php
						include('inc.php');
						include('functions.php');

						//	  Variables

						$STEXT = strtoupper($_GET['sText']);

						$sql = mysqli_query($con,"SELECT * FROM skill WHERE UPPER(name) LIKE '%$STEXT%' OR UPPER(s_desc) LIKE '%$STEXT%' OR UPPER(l_desc) LIKE '%$STEXT%';");
						$numrows=mysqli_num_rows($sql);
						if ($numrows==0){
							echo"<h5><kbd> Suchbegriff in Skills nicht gefunden </kbd></h5>";
							}
						else {
							echo "<h5><kbd> Gefundene Skills: $numrows </kbd></h5>";
							SkillLongList($sql,"SkillLink.php?");
							}

						echo "<hr>";

						$sql = mysqli_query($con,"SELECT * FROM proj WHERE UPPER(p_name) LIKE '%$STEXT%' OR UPPER(cust) LIKE '%$STEXT%' OR UPPER(industry) LIKE '%$STEXT%' OR UPPER(descript) LIKE '%$STEXT%';");
						$numrows=mysqli_num_rows($sql);
						if ($numrows==0){
							echo"<h5><kbd> Suchbegriff in den Projekten nicht gefunden </kbd></h5>";
							}
						else {
							echo "<h5><kbd> Gefundene Projekte: $numrows </kbd></h5>";
							ProjectLongList($sql,"displayProject.php?");
							}

						echo "<hr>";

						$sql = mysqli_query($con,"SELECT * FROM trg WHERE UPPER(trg_name) LIKE '%$STEXT%' OR UPPER(trg_desc) LIKE '%$STEXT%';");
						$numrows=mysqli_num_rows($sql);
						if ($numrows==0){
							echo"<h5><kbd> Suchbegriff in den Schulungen nicht gefunden </kbd></h5>";
							}
						else {
							echo "<h5> Gefundene Schulungen: $numrows </kbd></h5>";
							TrainingList($sql,"displayTraining.php?");
							}

						echo "<hr>";

						$sql = mysqli_query($con,"SELECT * FROM crt WHERE UPPER(crt_name) LIKE '%$STEXT%' OR UPPER(crt_desc) LIKE '%$STEXT%' OR UPPER(crt_issuer) LIKE '%$STEXT%';");
						$numrows=mysqli_num_rows($sql);
						if ($numrows==0){
							echo"<h5><kbd> Suchbegriff in den Zertifikaten nicht gefunden </kbd></h5>";
							}
						else {
							echo "<h5><kbd> Gefundene Zertifikate: $numrows </kbd></h5>";
							CertList($sql,"displayCert.php?");
							}

					?>
				</div>
			</div>
		</div>



		<script src="sortTable.js"></script>
		<script>
			document.addEventListener("DOMContentLoaded", () =>{

				const rows = document.querySelectorAll("tr[data-href]");

				rows.forEach( row => {
					row.addEventListener("click", () => {
						window.location.href = row.dataset.href;

						})
					})
				})
			var modal = document.getElementById('editSkill');

		
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
					}
				}
		</script>
	</body>
</html>
