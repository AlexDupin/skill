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
		error_reporting(1);
		include('Alert.html');
		include('jumbotron.html');
		include('Navbar/Employees.html'); 
		include('inc.php');
	?>
	<br>
	<br>
	<div class="container">
		<?php
//		<div class=row>
// 				<div class=col></div>
// 				<div class=col>
// 						// <input type=checkbox class=form-check-input id='filterRetired' onchange="filterRetired()" style="margin-left: 15%"> <span style="margin-left: 25%;">Show retired </span></input>
// 				</div>
// 				<br>
// 				<br>
// 				<br>
//		</div>
		?> 
		<div class=row>
			<div class=col>
				<?php
					include("my_date_functions.php");
					// Fetch employee data based on specified emp_id
					$UID = $_COOKIE['userid'];
					$ACC = $_COOKIE['acclvl'];
					$EID = $_GET['emp_id'];
					setcookie('EmployeeId', $EID);
					$Asql = mysqli_query($con, "SELECT * FROM emp WHERE Id='$EID'");
					$row = mysqli_fetch_assoc($Asql);
					$EFirstname = $row['gname'];
					$ELastname = $row['sname'];
					$EUsername = $row['uname'];
					$Status = $row['retired'];
					$DateOfEntry = date_etog($row['d_of_entry']);
					$DateOfExit = date_etog($row['d_of_exit']);
					$EOrganization = $row['company'];
					echo " 
						<h3><u> $EFirstname $ELastname </u></h3>
						<br>
						<h5> Skill-Übersicht </h5>
						<br>
						<br>
						";
				?>
			</div>
			<div class=col>
				<?php
					if (($UID==$EID) || ($ACC=='2')) {
						echo "
							<button onclick='document.getElementById(\"editEmployee\").style.display=\"block\"' class='btn btn-primary btn-sm'>Stammdaten ändern</button>
							<div class='btn-group btn-group-sm' role='group' aria-label='AddPersSkill'>
								<a class='btn btn-info' role='button' href='HandlePersSkill.php?emp_id=$EID&e_type=p&ps_id=0'>+ Projekt</a>
								<a class='btn btn-info' role='button' href='HandlePersSkill.php?emp_id=$EID&e_type=t&ps_id=0'>+ Schulung</a>
								<a class='btn btn-info' role='button' href='HandlePersSkill.php?emp_id=$EID&e_type=c&ps_id=0'>+ Zertifikat</a>
								<a class='btn btn-info' role='button' href='HandlePersSkill.php?emp_id=$EID&e_type=i&ps_id=0'>+ Interesse</a>
							</div>
							";
						}
					?>
			</div>
		</div>
		<div class=row>
			<div class=col-3>
				<?php
					echo "<b> Organization: </b> $EOrganization <br>
							<b> Benutzername: </b> $EUsername <br>
							<b> Status: </b>
						"; 
					if ($Status == 1) 
						echo "ausgeschieden <br>";
						else
							echo "aktiv <br>";
					echo "<b> Eingestiegen: </b> $DateOfEntry<br>
						<b> Ausgestiegen: </b> $DateOfExit<br>";
				?>
			</div>
		</div>
		<div class=row>
			<div class=col>
				<br><br>
				<?php
					$Asql = mysqli_query($con, "SELECT * FROM pers_skill ps JOIN skill s2 on s2.s_id=ps.skill_id WHERE ps.emp_id = '$EID' ORDER BY name;");
					$Arows = mysqli_num_rows($Asql);			
					if ($Arows > 0) {

						echo " 
							<h4> Skills-Übersicht </h4>
							<table class='table table-hover'>
								<thead>
									<TR>
									<TH>Skill-Name</TH>
									<TH>Level</TH>
									<TH>Art</TH>
									<TH>Details</TH>
									<TH>Aktion</TH>
									</TR>
								</thead>
								<tbody>";
						while ($AArow = mysqli_fetch_array($Asql)) {
							// jetzt für jede Zeile die Details holen
							$Project=$AArow['pr_proj_id'];
							$PS_ID=$AArow['id'];
							//echo $Project."<br>";
							if ((int)$Project>0) { // es ist ein Projekt
								$Bsql = mysqli_query($con, "SELECT * FROM proj WHERE pr_id='$Project' ORDER BY p_name;");
								$numrows = mysqli_num_rows($Bsql);
								if ($numrows > 0) {
									while ($row = mysqli_fetch_array($Bsql)) {
										// <tr data-href='EmployeeLink.php?showproject'>
										echo "
											<tr data-href='displayProject.php?id=". $row['pr_id'] ."&emp_id=".$EID."'>
											<td>" . $AArow['name'] . "</td>
											<td>" . $AArow['pr_exp_lvl'] . "</td>
											<td>Projekt&nbsp;</td>
											<td>" . $row['p_name'] . "&nbsp;</td>";
										if (($UID==$EID) || ($ACC=='2')) {
											echo "
											<td><a href='HandlePersSkill.php?emp_id=".$EID."&ps_id=".$PS_ID."' title='Edit Record'><img src='pencil.gif' alt='ändern'></a>   
											<a href='delete_pskill.php?ps_id=".$PS_ID."' title='Delete Record'><img src='trash.gif' alt='löschen'></a></td>
											</tr>";
											}
										}
									}
								}
							$Training=$AArow['th_trg_id'];
							if ((int)$Training>0) { // es ist eine Schulung
								$Bsql = mysqli_query($con, "SELECT * FROM trg WHERE trg_id='$Training' ORDER BY trg_name;");
								$Brows = mysqli_num_rows($Bsql);
								if ($Brows > 0) {
									while ($Brow = mysqli_fetch_array($Bsql)) {
										echo "
											<tr data-href='displayTraining.php?"."id=" . $Brow['trg_id'] . "&emp_id=".$EID."'>
											<td>" . $AArow['name'] . "</td>
											<td>" . $AArow['th_exp_lvl'] . "</td>
											<td>Schulung&nbsp;</td>
											<td>" . $Brow['trg_name'] . "&nbsp;</td>";
										if (($UID==$EID) || ($ACC=='2')) {
											echo "
											<td><a href='HandlePersSkill.php?emp_id=".$EID."&ps_id=".$PS_ID."' title='Edit Record'><img src='pencil.gif' alt='ändern'></a>   
											<a href='delete_pskill.php?ps_id=".$PS_ID."' title='Delete Record'><img src='trash.gif' alt='löschen'></a></td>
											</tr>";
											}
										}
									}
								}
							$Cert=$AArow['th_crt_id'];
							if ((int)$Cert>0) { // es ist ein Zertifikat
								$Bsql = mysqli_query($con, "SELECT * FROM crt WHERE crt_id='$Cert' ORDER BY crt_name;");
								$Brows = mysqli_num_rows($Bsql);
								if ($Brows > 0) {
									while ($Brow = mysqli_fetch_array($Bsql)) {
										echo "
											<tr data-href='displayCert.php?"."id=" . $Brow['crt_id'] . "&emp_id=".$EID."'>
											<td>" . $AArow['name'] . "</td>
											<td>" . $AArow['th_exp_lvl'] . "</td>
											<td>Zertifikat&nbsp;</td>
											<td>" . $Brow['crt_name'] . "&nbsp;</td>";
										if (($UID==$EID) || ($ACC=='2')) {
											echo "
											<td><a href='HandlePersSkill.php?emp_id=".$EID."&ps_id=".$PS_ID."' title='Edit Record'><img src='pencil.gif' alt='ändern'></a>   
											<a href='delete_pskill.php?ps_id=".$PS_ID."' title='Delete Record'><img src='trash.gif' alt='löschen'></a></td>
											</tr>";
											}
										}
									}
								}

							}
						echo "</tbody></table><br><br>";					
						}
						
					// Dann die Liste der Interest-Levels
					$Asql = mysqli_query($con, "SELECT ps.id, name name, ps.skill_id, ps.interest_lvl FROM pers_skill ps JOIN skill s2 on s2.s_id = ps.skill_id WHERE ps.emp_id = '$EID' and e_type='i';");
					$Arows = mysqli_num_rows($Asql);			
					if ($Arows > 0) {
						echo " 
							<h4>Interessegrade an Skills</h4>
							<table class='table table-hover'>
								<thead>
									<TR>
									<TH>Name des Skills</TH>
									<TH>Interessegrad</TH>
									<TH>Aktion</TH>									
									</TR>
								</thead>
								<tbody>";
						while ($row = mysqli_fetch_array($Asql)) {
							// Fetch name of skill
							echo "
								<td>" . $row['name'] . "</td>
								<td>" . $row['interest_lvl'] . "</td>";
								if (($UID==$EID) || ($ACC=='2')) {
									echo "
										<td><a href='HandlePersSkill.php?emp_id=".$EID."&ps_id=".$row['id']."' title='Edit Record'><img src='pencil.gif' alt='ändern'></a>  
									<a href='delete_pskill.php?ps_id=".$row['id']."' title='Delete Record'><img src='trash.gif' alt='löschen'></a></td>
									</tr>";
									}
							}
						echo "</tbody></table><br><br>";
						}
					
				?>
			</div>
		</div>
	</div>
		
	<div class=modal id="editEmployee">
		<form class="modal-content animate">
			<span onclick="document.getElementById('editEmployee').style.display='none'" class="close" title="Close Modal">×</span>
			<div class="modalContainer">
				<h2> Mitarbeiterstammdaten ändern </h2>
				<br>
				<?php
					echo "<input type = text class = 'form-control' placeholder = 'Vorname' value = '$EFirstname' id = firstname><br>";
					echo "<input type = text class = 'form-control' placeholder = 'Nachname' value = '$ELastname' id = lastname><br>";
					echo "
					<select id = 'organization' class = 'custom-select'>
							<option ";
					if ($EOrganization == "NOC") {
						echo "selected";
					}
					echo " value = 'NOC'>NOC</option>
							<option ";
					if ($EOrganization == "SoSy") {
						echo "selected";
					}
					echo " value = 'SoSy'>SoSy</option>
							<option ";
					if ($EOrganization == "retired") {
						echo "selected";
					}
					echo " value = 'retired'>retired</option>
					</select>
					<br><br>";
					echo "<input type = date class = 'form-control' placeholder = 'Eintrittsdatum' value = '$DateOfEntry' id = entrydate><br>";
					echo "<input type = date class = 'form-control' placeholder = 'Austritssdatum' value = '$DateOfExit' id = exitdate><br>";
					echo "<input type='password' class='form-control' placeholder='Password' id='password'><br>";
					echo "<input type='password' class='form-control' placeholder='Confirm Password' id='confirmpassword'><br>";
					?>
				<button type=button role=button class='btn btn-primary' id="btn-submit">Submit</button>
			</div>
		</form>
	</div>
	
	<div class=modal id="showProject">
		<div class="modal-content animate">
			<span onclick="document.getElementById('showProject').style.display='none'" class="close" title="Close Modal">×</span>
			<div class = "modalContainer">
				<?php
					$PrID = $_COOKIE['ProjectID'];
					//echo $_COOKIE['ProjectID'];
					$Csql = mysqli_query($con, "SELECT * FROM proj WHERE pr_id='$PrID';");
					$Crows = mysqli_num_rows($Csql);
					echo "Der Cookie ist: " . $PrID . "<br>";
					if ($Crows > 0) {
						$Crow = mysqli_fetch_array($Csql);
						echo "<h2> ". $Crow['pr_name'] . "</h2>	<br><br>
						Kunde: " . $Crow['cust'] . "<br>
						Inhalt: " . $Crow['descript'] . "<br>
						Branche: " . $Crow['industry'] . "<br>
						Beschreibung:<br> " . $Crow['descript'] . "<br>";
						}
						else
							echo "Kein Projekt gefunden!<br>";
				?>	
				<br>
				<div class="modal-footer">
					<button type="button" role=button class="btn btn-primary" id="btn-close_2" data-dismiss="modal">Schließen</button>
				</div>
			</div>
		</div>
	</div>

	<script src="sortTable.js"></script>
	<script src="EditEmployee.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", () => {

			const rows = document.querySelectorAll("tr[data-href]");

			rows.forEach(row => {
				row.addEventListener("click", () => {
					window.location.href = row.dataset.href;

				})
			})
		})
		var modal_edit = document.getElementById('editEmployee');

		window.onclick = function(event) {
			if (event.target == modal_edit)
				modal_edit.style.display = "none";
				else
					console.log("fehler in modal")
			}
	</script>
</body>

</html>