<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php

	if ($_COOKIE['uname'] == NULL) {

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
					include('my_date_functions.php');
					include('functions.php');
					// first, get name of employee and print it
					//$EID = $_COOKIE['EmployeeID'];
					$EID = $_GET['emp_id'];
					$PSID = $_GET['ps_id'];
					setcookie('EmployeeId',$EID);
					if ($PSID == '0') { // keine ps-id angegeben, deshalb PersSkill anlegen
						$e_type=$_GET['e_type']; // holen, was fuer ein Typ angelegt werden muss.
						$skill_id='';
						$pr_exp_lvl='';
						$pr_exp_com='';
						$pr_proj_id='';
						$pr_start=date_etog('1998-02-01');
						$pr_end=date_etog('1998-02-01');
						$th_exp_lvl='';
						$th_exp_com='';
						$th_trg_id='';
						$interest_lvl='';
						$th_crt_id='';
						$tmp_exp_lvl=0;
						$tmp_exp_com='';
						switch ($e_type) {
							case 'p':
								$title_action='Projekt als praktischen Skill anlegen';
								break;
							case 't':
								$title_action='Schulung als theoretischen Skill anlegen';
								break;
							case 'c':
								$title_action='Zertifikat als theoretischen Skill anlegen';
								break;
							case 'i':
								$title_action='Interesse anlegen';	
								break;
								}
						}
					else { 	// eine ID ist angegeben, deshalb ist es ein update eines PersSkill
						$sql = mysqli_query($con, "SELECT * FROM pers_skill WHERE id='$PSID'");
						$row = mysqli_fetch_assoc($sql);
						$e_type=$row['e_type'];
						$skill_id=$row['skill_id'];
						$pr_exp_lvl=$row['pr_exp_lvl'];
						$pr_exp_com=$row['pr_exp_com'];
						$pr_proj_id=$row['pr_proj_id'];
						$pr_start=date_etog($row['pr_start']);
						$pr_end=date_etog($row['pr_end']);
						$th_exp_lvl=$row['th_exp_lvl'];
						$th_exp_com=$row['th_exp_com'];
						$th_trg_id=$row['th_trg_id'];
						$interest_lvl=$row['interest_lvl'];
						$th_crt_id=$row['th_crt_id'];
						switch ($e_type) {
						case 'p':
							$tmp_exp_lvl=$pr_exp_lvl;
							$tmp_exp_com=$pr_exp_com;
							$title_action='praktischen Skill ändern';
							break;
						case 't':
						case 'c':
							$tmp_exp_lvl=$th_exp_lvl;
							$tmp_exp_com=$th_exp_com;
							$title_action='theoretischen Skill ändern';
							break;
						case 'i':
							$title_action='Interesse an Skill ändern';
							$tmp_exp_lvl=$interest_lvl;
							break;
						}
					}
					$sql = mysqli_query($con, "SELECT id, gname, sname FROM emp WHERE id='$EID'");
					$row = mysqli_fetch_assoc($sql);
					echo "<h4>".$row['gname']." ".$row['sname'].": ".$title_action." </h4><br>";
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
								$sid=$row['s_id'];
								if ($skill_id == $sid) {
									echo "<option title='Skill' value='".$sid."' selected='selected'>".$row['name']."</option>";}
								else {
									echo "<option title='Skill' value='".$sid."'>".$row['name']."</option>";}
								}
						?>
					</select>
				</div>
				<br>
				<div class="form-group">
					<?php 
						if ($e_type=='i')
							echo "<label for='skill_lvl'>Interesse an diesem Skill (1:kein/geringes bis 5:hohes)</label>";
						else
							echo "<label for='skill_lvl'>Skill Level (1:kein bis 5:Experte)</label>";
					?>						
					<select class="form-control" id="id_skill_lvl">
						<?php
							for ($i=1; $i<=5; $i++) {
								if ($i == $tmp_exp_lvl) 
									echo "<option selected='selected'>".$i."</option>";
								else
									echo "<option>".$i."</option>";
								}
						?>
					</select>
				</div>
				<?php 
					switch ($e_type) {
						case 'p':
							echo "
								<div class='form-group'>
									<label for='sdesc'>Aufgaben im Projekt und persönlicher Kommentar:</label>
									<textarea class='form-control' rows='4' id='id_comment' value='".$tmp_exp_com."'>".$tmp_exp_com."</textarea>
								</div>
								<br>
								<div class='form-group'>
									<label for='sdate'>Startdatum im Projekt:</label>
									<input type='date' class='form-control' id='id_pr_sdate' value='" . $pr_start . "'>
								</div>
								<div class='form-group'>
									<label for='edate'>Enddatum im Projekt:</label>
									<input type='date' class='form-control' id='id_pr_edate' value='". $pr_end ."'>
								</div>";
							break;
					case 't':
					case 'c':
						echo "
							<div class='form-group'>
								<label for='sdesc'>Persönlicher Kommentar zu den der Schulung / der Zertifizierung gemachten, fachlichen Erfahrungen:</label>
								<textarea class='form-control' rows='4' id='id_comment' value='".$tmp_exp_com."'>".$tmp_exp_com."</textarea>
							</div>";
						break;
					}
				?>
			</div>
			<div class=col>
				<?php
					error_reporting(0);
					switch ($e_type) {
 						case 'p':
							echo "Relevantes Projekt wählen:<hr>";
							$sql = mysqli_query($con, "SELECT * FROM proj ORDER BY p_name");
							ProjectRadioList($sql, $pr_proj_id);
							break;
						case 't':
							echo "Relevante Schulung wählen:<hr>";
							$sql = mysqli_query($con, "SELECT * FROM trg ORDER BY trg_name");
							TrainingRadioList($sql, $th_trg_id);
							break;
						case 'c':
							echo "Relevantes Zertifikat wählen:<hr>";
							$sql = mysqli_query($con, "SELECT * FROM crt ORDER BY crt_name");
							CertRadioList($sql, $th_crt_id);
							break;
						default:
							echo "<hr>./.<br>";
						}
					error_reporting(1);
				?>
			</div>
		</div>
	</div>
	<script>
		var ps = {
		s_id: document.getElementById('id_skill'),  
		s_lvl: document.getElementById('id_skill_lvl'),
		s_comm: document.getElementById('id_comment'),
		s_sdate: "0000-00-00",
		s_edate: "0000-00-00",
		s_interest: 0,
		s_project: document.getElementById('id_proj_radio'),
		s_training: document.getElementById('id_trg_radio'),
		s_cert: document.getElementById('id_crt_radio'),
		s_crt_id: 0,
		s_trg_id: 0,
		submit: document.getElementById('btn-submit')
		}
		var proj=0;
		var trg=0;
		var crt=0;
		var p_ele = document.getElementsByName('projradio'); 
		var t_ele = document.getElementsByName('trgradio'); 
		var c_ele = document.getElementsByName('crtradio'); 
		var EID = "<?php Print($EID); ?>";
		var ETYPE = "<?php Print($e_type); ?>";
		var PSID = "<?php Print($PSID); ?>";
		var MY_LINK = "./EmployeeLink.php?emp_id=";
		var DEST;
		var tmp_str='';
		var OK=true;
		var msg='';
		
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

			// check, if skill level and skill are set
			if (ps.s_id.value=='Skill') {
				OK=false;
				msg=msg+"Skill ist nicht ausgewählt!";
				}

			// get the inputs from the radio buttons
			
			if (p_ele != null) {
				for (i = 0; i < p_ele.length; i++) { 
					if (p_ele[i].checked) 
						proj = p_ele[i].value;
						}
				}
					
			if (t_ele != null) {
				for (i = 0; i < t_ele.length; i++) { 
					if (t_ele[i].checked) 
						trg = t_ele[i].value;
						};
				}
			if (c_ele != null) {
				for (i = 0; i < c_ele.length; i++) { 
					if (c_ele[i].checked) 
						crt = c_ele[i].value;
						};
				};

			// check if proj, trg or crt is chosen, when not interest
			if (((proj+trg+crt)==0) && ETYPE!='i') {
				OK = false;
				msg = msg + " Projekt, Schulung oder Zertifikat fehlt!";
				}

			switch (ETYPE) {
				case "p":
					ps.s_sdate=document.getElementById('id_pr_sdate');
					ps.s_edate=document.getElementById('id_pr_edate');
					trg=0;
					crt=0;
					ps.s_interest=0;
					break;
				case "t":
					ps.s_sdate="01.02.1998";
					ps.s_edate="01.02.1998";
					proj=0;
					crt=0;
					ps.s_interest=0;
					if (trg==0)	{
						console.log("Fehler: keine TrainingID bei e_type=t");
						}
					break;
				case "c":
					ps.s_interest=0;
					ps.s_sdate="01.02.1998";
					ps.s_edate="01.02.1998";
					trg=0;
					proj=0;
					ps.s_interest=0;
					if (crt==0)	{
						console.log("Fehler: keine CertID bei e_type=c");
						}
					break;
				case "i":
					ps.s_interest=ps.s_lvl;
					ps.s_sdate="01.02.1998";
					ps.s_edate="01.02.1998";
					trg=0;
					proj=0;
					crt=0;
					ps.s_comm='';
					break;
				default:
					console.log("Error: wrong experience type".ETYPE);
				}
			
			const requestData = `EID=${EID}&PSID=${PSID}&ETYPE=${ETYPE}&skill_id=${ps.s_id.value}&level=${ps.s_lvl.value}&comment=${ps.s_comm.value}&sdate=${ps.s_sdate.value}&edate=${ps.s_edate.value}&project=${proj}&interest=${ps.s_interest.value}&training=${trg}&crt=${crt}`;
//			console.log(requestData);

			if (OK==true) {
				request.open("POST", "SavePersSkill.php");
				request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request.send(requestData);
				}
			else {
				console.log(`Fehler: Angaben fehlen. ${ps.s_id.value} ${ps.s_lvl.value}`);
				alert.text.innerHTML = msg;
				alert.show.style.display = 'block';
				}
		})
		
		function handleResponse(object) {
			alert.text.innerHTML = object.msg;
			alert.show.style.display = 'block';
			}		
	</script>
</body>
</html>