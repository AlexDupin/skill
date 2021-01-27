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
			<form class = "modal-content animate">
				<span onclick="document.getElementById('CreateSkill').style.display='none'" class="close" title="Close Modal">×</span>
				<div class = "modalContainer">
					<h2> Create Skill </h2>
					<br>
					<input type="text" class="form-control" placeholder="Name des Skills" id="skill_name">
					<br>
					<input type="text" class="form-control" placeholder="Beschreibung" id="skill_name">
					<br>
			</form>
		</div>
		<?php include('jumbotron.html'); ?>

		<?php include('Navbar/Skills.html'); ?>

		<br>
		<br>


		<div class="container">
			<div class = row>
				<div class = col-9>
					<h2>Skill List</h2>
					<p>Select a skill by clicking on it on the list or Search it by using the Search box<p> 
				</div>

				<div class = col-3>
					<button class = 'btn btn-secondary' onclick = "document.getElementById('CreateSkill').style.display='block'" style="width:auto;"> Create Skill</a>
				</div>
			</div>	

			<br>
			
			<div class=row>

				<div class=col-4>
					<p><b> Search: </b></p>
					<input class = form-control type = "text" id = "skillSearch" placeholder = "Search for Skill">
				</div>
				<div class = col-1>
				</div>
				<div class = col-3>
					<br><br>
					<input type = checkbox class = form-check-input id = 'filterRetired' onclick = "filterTable()"> Show retired </input>
				</div>	
				<div class = col-1>
				</div>	
				<div class = "col-3">
					<p> <b> Filter by type: </b> </p>
					
					<form action="Search/skillSearch.php" Method=Post>
						<select name="Type" class="custom-select"name="SCategory" id = 'FilterByType' onchange = "filterTable()" placeholder = "Type">
							<option selected></option>
						
							<?php
								// Type Dropdown

								include('inc.php');
								$con = mysqli_connect($host,$user,$passwd,$datenbank) or die("<h5>Error:Die Datenbank ist momentan nicht erreichbar</h5>");
								$sql = mysqli_query($con,"SELECT * FROM skill ORDER BY name");
								$rows = mysqli_num_rows($sql);
								
								for ($i = 0; $i < $rows; $i++){
										$record=mysqli_fetch_row($sql);
									for ($j = 0; $j < mysqli_num_fields($sql); $j++){
										echo "<option value='$record[$j]' id = '$record[$j]' > $record[$j] </option>";
										}		
									}    

							?>
						</select>
						<br><br>
					</form>
				</div>
			</div>
			<?php
				// Skill List

				include("inc.php");
				include("functions.php");

				$sql=mysqli_query($con,"SELECT name , s_desc FROM skill ORDER BY name");
				SkillList($sql,'SkillLink.php');

			?>
		</div>
		<script src = 'sortTable.js'></script>
		<script src = 'FilterSkillList.js'></script>
		<script src = 'CreateSkill.js'></script>


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
