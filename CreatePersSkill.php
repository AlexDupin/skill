<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php

	if ($_COOKIE['username'] == NULL) {

		echo "<meta http-equiv='refresh' content='0 url=../index.html'>";
	}

	?>
</head>

<body>
	<?php
		include('Alert.html');
		include('jumbotron.html');
		include('Navbar/Employees.html'); 
	?>
	<div class=container>
		<div class=row>
			<div class=col>
				<br> <br> 
				<?php
					include('inc.php');
					include('functions.php');
					// first, get name of employee and print it
					//$EID = $_COOKIE['EmployeeID'];
					$EID = $_GET['emp_id'];
					setcookie('EmployeeId',$EID);
					$sql = mysqli_query($con, "SELECT id, gname, sname FROM emp WHERE id='$EID'");
					$row = mysqli_fetch_assoc($sql);
					echo "<h4>".$row['gname']." ".$row['sname'].": praktischen Skill anlegen </h4><br>";
				?>
			</div>
			<div class=col>
				<br> <br> 
				<button type=button role=button class='btn btn-primary' onclick="myFunction()" id="btn-submit">Speichern</button>
			</div>
		</div>
		<hr>
		<div class=row>
			<div class=col>
				<div class="form-group">
					<label for="selSkill">Skill auswählen:</label>
					<select name="SkillType" class="custom-select" label="Skill" id="id_skill">
						<option selected>Skill</option>
						<?php
							$sql = mysqli_query($con,"SELECT s_id, name FROM skill ORDER BY name");
							$rows = mysqli_num_rows($sql);
							for ($i = 0; $i < $rows; $i++){
								$row = mysqli_fetch_assoc($sql);
								echo "<option value='".$row['s_id']."'>".$row['name']."</option>";
								}
						?>
					</select>
				</div>
				<br>
				<div class="form-group">
					<label for="skill_lvl">Skill Level (1:kein bis 5:Experte)</label>
					<select class="form-control" id="id_skill_lvl">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<div class="form-group">
					<label for="sdesc">Persönlicher Kommentar zu den im Projekt gemachten, fachlichen Erfahrungen:</label>
					<textarea class="form-control" rows="4" id="id_comment"></textarea>
				</div>
				<br>
				<div class="form-group">
					<label for="sdate">Startdatum im Projekt:</label>
					<input type="date" class="form-control" id="id_pr_sdate">
				</div>
				<div class="form-group">
					<label for="edate">Enddatum im Projekt:</label>
					<input type="date" class="form-control" id="id_pr_edate">
				</div>
			</div>
			<div class=col>
				Relevantes Projekt wählen:
				<hr>
<!-- 
				<input class=form-control type="text" id="projSearch" placeholder="Suche Projekt">
 -->
				<?php
					error_reporting(0);
					$sql = mysqli_query($con, "SELECT * FROM proj ORDER BY p_name");
					ProjectRadioList($sql, 'AssignProjectRadio.php?');
					error_reporting(1);
				?>
			</div>
<!-- 			<script src="SelectProject.js"></script> -->
		</div>
	</div>
	<script>
		var ps = {
		s_id: document.getElementById('id_skill'),  
		s_lvl: document.getElementById('id_skill_lvl'),
		s_comm: document.getElementById('id_comment'),
		s_sdate: document.getElementById('id_pr_sdate'),
		s_edate: document.getElementById('id_pr_sdate'),
		s_project: document.getElementById('id_pr_radio'),
		submit: document.getElementById('btn-submit')
		}
		var proj;
		var ele = document.getElementsByName('projradio'); 
		var EID = "<?php echo $EID; ?>";
		var MY_LINK = "./EmployeeLink.php?emp_id="
		var DEST
		
		function myFunction() {
			console.log('Knopf gedrückt');
		}
		
		ps.submit.addEventListener("click", () => {
			const request = new XMLHttpRequest();

			request.onload = () => {
				let responseObject = null;

				try {  
					responseObject = JSON.parse (request.responseText);
				}
				catch (error) {
					console.error('JSON could not be parsed');
					}
				if (responseObject){
					handleResponse(responseObject);
				}
				
				document.location.href = MY_LINK+EID;
			}

			for (i = 0; i < ele.length; i++) { 
				if (ele[i].checked) 
					proj = ele[i].value;
					}  

			const requestData = `skill_id=${ps.s_id.value}&level=${ps.s_lvl.value}&comment=${ps.s_comm.value}&sdate=${ps.s_sdate.value}&edate=${ps.s_edate.value}&project=${proj}`;

			console.log(requestData);

			request.open("POST", "SavePersSkill.php");
			request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			request.send(requestData);
		})
		
		function handleResponse(object) {
			console.log(object)
			}		
	</script>
</body>
</html>)