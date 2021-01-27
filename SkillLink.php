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
		<?php //include('Alert.html');?>

		<?php include('jumbotron.html');?>

		<?php include('Navbar/Skills.html');?>

		<br>
		<br>
		<div class="container">
			<div class="row">
				<div class="col-8">
					<?php
						include('inc.php');
						include('functions.php');

						//	  Variables

						$skill_id = $_GET['skill_id'];
						setcookie("skill_id",$skill_id);
						$Asql = mysqli_query($con,"SELECT * FROM skill WHERE s_id = '$skill_id';");
						$row = mysqli_fetch_assoc($Asql);
						$skill_name = $row['name'];
						setcookie("skill_name",$skill_name);

						if (mysqli_num_rows($Asql)==0){
							echo "<div class='alert alert-danger'> <strong>ERROR!</strong> Diesen Skill gibt es nicht. </div>";
							}
						else {
							//	  Variables
							$skill_sdesc = $row['s_desc'];
							$skill_ldesc =  $row['l_desc'];

							setcookie("uname",0);

							//		 Skill Description

							echo " <h3> $skill_name </h3><br>
								<b> Kurzbeschreibung: </b> <br>$skill_sdesc <br><br>
								<b> Detaillierte Beschreibung: </b> <br> ".nl2br($skill_ldesc)." <br>
								<br>";
						}		
					?>
				</div>
				<div class = "col-2">
					<button onclick = "document.getElementById('editSkill').style.display='block'" class='btn btn-secondary' >Skill editieren</button>
				</div>
				<div class="col-2">
					<input type = checkbox class = form-check-input id = 'filterRetired' onchange = "filterTable()" style="margin-left: 10%" checked> <span style="margin-left: 30%;">Show retired </span></input>
				</div>

			</div>
			<div class="row">
				<div class = col>
					<hr>
					<?php
						$Csql = mysqli_query($con,"
							select s.s_id, e.id as e_id, p.id as p_id, e.sname, e.gname, p.e_type, p.pr_exp_lvl, proj.pr_id, proj.p_name, proj.cust
							from skill as s, emp as e, pers_skill as p, proj 
							where p.skill_id=s.s_id AND p.e_type ='p' AND s.s_id='$skill_id' AND p.emp_id = e.Id AND p.pr_proj_id =proj.pr_id AND e.sname is not NULL;");
						$rows = mysqli_num_rows($Csql);
						if ($rows>0){
							echo "<h5>Projekterfahrungen in $skill_name</h5>
							<p style='color:grey'>(Zeile anklicken zum Anzeigen des Projektes)</p>";
							SkillEmpList($Csql, 'p'); // display all employees who have this skill
							$notavailable=FALSE;
							echo"<br><br>";
							}
						else {
							echo"<h5> Kein Mitarbeiter hat praktische Erfahrungen in $skill_name </h5>";
							}

						$Csql = mysqli_query($con,"
							select s.s_id, e.id as e_id, p.id as p_id, e.sname, e.gname, p.e_type, p.th_exp_lvl, trg.trg_id, trg.trg_name
							from skill as s, emp as e, pers_skill as p, trg
							where p.skill_id=s.s_id AND p.e_type='t' AND s.s_id='$skill_id' AND p.emp_id = e.Id AND p.th_trg_id=trg.trg_id AND e.sname is not NULL;");
						$rows = mysqli_num_rows($Csql);
						if ($rows>0){
							echo "<h5>Schulungen in $skill_name</h5>
							<p style='color:grey'>(Zeile anklicken zum Anzeigen der Schulung)</p>";
							SkillEmpList($Csql, 't'); // display all employees who have this skill
							$notavailable=FALSE;
							echo"<br><br>";
							}
						else {
							echo"<h5> Kein Mitarbeiter hat Schulungen in $skill_name absolviert</h5>";
							}
						$Csql = mysqli_query($con,"
							select s.s_id, e.id as e_id, p.id as p_id, e.sname, e.gname, p.e_type, p.th_exp_lvl, crt.crt_id, crt.crt_name 
							from skill as s, emp as e, pers_skill as p, crt
							where p.skill_id=s.s_id AND p.e_type='c' AND s.s_id='$skill_id' AND p.emp_id = e.Id AND p.th_crt_id=crt.crt_id AND e.sname is not NULL;");
						$rows = mysqli_num_rows($Csql);
						if ($rows>0){
							echo "<h5>Zertifikate in $skill_name</h5>
							<p style='color:grey'>(Zeile anklicken zum Anzeigen des Zertifikats)</p>";
							SkillEmpList($Csql, 'c'); // display all employees who have this skill
							$notavailable=FALSE;
							echo"<br><br>";
							}
						else {
							echo"<h5> Kein Mitarbeiter hat Zertifikate in $skill_name</h5>";
							}
						$Bsql = mysqli_query($con,"    
							select s.s_id, e.id as e_id, p.id as p_id e.sname, e.gname, p.e_type, p.pr_exp_lvl, p.th_exp_lvl, p.interest_lvl  
							from skill as s, emp as e, pers_skill as p 
							where p.skill_id=s.s_id and s.s_id='$skill_id' AND p.emp_id = e.Id AND e.sname is not NULL and p.e_type='i';
							");

						$rows = mysqli_num_rows($Bsql);
						if ($rows != 0){
							SkillIntList($Bsql);
							}	
										
						else{
							if ($notavailable == True){
								echo"<h5> Kein Mitarbeiter hat diesen Skill. </h5>";
							}
						}	
					?>
				</div>
			</div>
		</div>



        <div class = modal id = "editSkill">
            <form class = "modal-content animate">
				<span onclick="document.getElementById('editSkill').style.display='none'" class="close" title="Close Modal" style="cursor: pointer">×</span>
                <div class = "modalContainer">
                    <h3> Edit Skill </h3>
                    <br>
					<?php
						echo "
						<div class='form-group'>
							<label for='skillNameFormInput'> Name des Skills </label>
							<input type='text' class='form-control' id='id_skill_name' value='$skill_name'>
						</div>
						<br>
						<div class='form-group'>
							<placeholder for='skill_sdesc'>Kurzbeschreibung des Skills</placeholder>
							<textarea class='form-control' id='id_skill_sdesc' rows='3'>$skill_sdesc</textarea>
						</div>
						<br>
						<div class='form-group'>
							<label for='skill_desc'>Ausführliche Beschreibung des Skills</label>
							<textarea class='form-control' id='id_skill_ldesc' rows='6'>$skill_ldesc</textarea>
						</div>
						<br>
						<div class='form-check'>
						</div>
						";
					?>
					<button type=button role=button class='btn btn-primary' id="btn-submit_2">Speichern</button>
				</div>
			</form>
		</div>
		<script src="sortTable.js"></script>
		<script src="EditSkill.js"></script>
		<script src="HideRetiredEmployees.js"></script>
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
