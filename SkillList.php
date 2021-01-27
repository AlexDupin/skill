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
		<?php include('Alert.html'); ?>
		<div id = "CreateSkill" class = "modal">
			<div class="modal-content animate">
				<span onclick="document.getElementById('CreateSkill').style.display='none'" class="close" title="Close Modal">×</span>
				<div class = "modalContainer">
					<h2> Skill anlegen </h2>
					<br>
					<div class="form-group">
						<label for="skill_desc">Name des Skills</label>
						<input type="text" class="form-control" id="id_skill_name">
					</div>
					<br>
					<div class="form-group">
						<placeholder for="skill_sdesc">Kurzbeschreibung des Skills</placeholder>
						<textarea class="form-control" type="textarea" id="id_skill_sdesc" rows="3"></textarea>
					</div>
					<br><br>
					<div class="form-group">
						<label for="skill_desc">Ausführliche Beschreibung des Skills</label>
						<textarea class="form-control" type="textarea" id="id_skill_ldesc" rows="6"></textarea>
					</div>
					<br>
					<button type="button" role="button" class="btn btn-primary" id="btn-submit_1">Speichern</button>
				</div>
			</div>
		</div>
		<?php include('jumbotron.html'); ?>

		<?php include('Navbar/Skills.html'); ?>
		<br><br>

		<div class="container">
			<div class = row>
				<div class = col-9>
					<h2>Liste der Skills im Unternehmen </h2>
					<p>Auswählen eines Skills durch Klicken oder Suchen mit der Such-Box<p> 
				</div>
				<div class = col-3>
					<button class = "btn btn-secondary" onclick = "document.getElementById('CreateSkill').style.display='block'" style="width:auto;"> Create Skill</button>
				</div>
			</div>	
			<br>

			<div class=row>
				<div class=col-4>
					<p><b> Suchen: </b></p>
					<input class = form-control type = "text" id = "skillSearch" placeholder = "Nach Skill suchen">
				</div>
				<div class = col-1>
				</div>
				<div class = col-3>
					<br><br>
					<input type = checkbox class = form-check-input id = 'filterRetired' onclick = "filterTable()"> Zeige nicht mehr vorhandene Skills </input>
				</sdiv>
				<div class = col-1>
				</div>
			</div>
			<br><br>

			<?php
				// Skill List

				include("inc.php");
				include("functions.php");
				$sql=mysqli_query($con,"SELECT * FROM skill ORDER BY name;"); 
				SkillList($sql,'SkillLink.php?');
			?>
		</div>

		<script src = 'sortTable.js'></script>
		<script src = 'FilterSkillList.js'></script>
		<script src = "CreateSkill.js"></script>

		<script>
			//	Modal
			var modal = document.getElementById('CreateSkill');
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		</script>
	</body>
</html>