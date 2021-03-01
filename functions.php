<?php

// VersionInfo
// v1.1.1	Made EmployeeList configurable to display either skills or company
// v1.1		ProjectRadioList now with table
// v1.0.2 	fixed bugs in EmployeeList, UserList (missing </table>)

//	Log File 
$file = 'log.txt';


function EmployeeList($sql, $Link, $skill)
{
	echo "
		<table class='table table-hover' id = 'EmployeeList'>
			<thead>
				<tr>
					<th>Vorname</th>
					<th>Nachname</th>";
	if ($skill=="1") {
		echo "
					<th>Skill im Projekt</th>";
		}
	else {
		echo"
					<th>Firma</th>
					<th>Status</th>";
		}
	echo "					
				</tr>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
		<tr data-href = '$Link" . "emp_id=" . $row['id']."'>
			<td>" . $row['gname'] . "&nbsp;</td>
			<td>" . $row['sname'] . "&nbsp;</td>";
		if ($skill=="1") {
			echo "
			<td>" . $row['skillname'] . "&nbsp;</td>
			</tr>";
			}
		else {
			echo "
			<td>" . $row['company'] . "&nbsp;</td>
			<td>" . $row['ret'] . "&nbsp;</td>
			</tr>";
			}
	}
	echo "</tbody> </table>";
}


function SelectEmployee($sql, $Link)
{

	echo "
		<table class='table table-hover' id = 'EmployeeList'>
			<thead>
				<tr>
					<th>Vorname</th>
					<th>Nachname</th>
					<th>Firma</th>
				</tr>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
		<tr data-id ='" . $row['id'] . "'>
			<td>" . $row['gname'] . "&nbsp;</td>
			<td>" . $row['sname'] . "&nbsp;</td>
			<td>" . $row['company'] . "&nbsp;</td>
		</tr>";
	}
	echo "</tbody>";
}


function SkillEmpList($sql, $e_type)
{

	echo " 
		<table class='table table-hover'>
			<thead>		
				<tr>
				<th>Vorname</th>
				<th>Nachname</th>
				<th>Level</th>";
	switch ($e_type) {
		case 'p':
			echo "
				<th>Kunde</th>
				<th>Projekt</th>";
			break;
		case 't':
			echo "
				<th>Schulung</th>";
			break;
		case 'c':
			echo "
				<th>Zertifikat</th>";
			break;
		default:
			echo "Fehler in Datenstruktur";
		}
		
	echo "
		<th> Aktion </th>
			</tr>
			</thead>
		<tbody>";

	while ($row = mysqli_fetch_assoc($sql)) {
		$e_type = $row['e_type'];
		switch ($e_type) {
			case 'p':
				echo "
					<tr data-href = 'displayProject.php?id=".$row['pr_id']."&emp_id=".$row['e_id']."'>
					<td>" . $row['gname'] . "&nbsp;</td>
					<td>" . $row['sname'] . "&nbsp;</td>
					<td>" . $row['pr_exp_lvl'] . "&nbsp;</td>
					<td>" . $row['cust'] . "&nbsp;</td>
					<td>" . $row['p_name'] . "&nbsp;</td>
					<td><a href='EmployeeLink.php?emp_id=".$row['e_id']."'><img alt='Mitarbeiter' src='pict/avatar.gif'></a>";
				break;
			case 't':
				echo "
					<tr data-href = 'displayTraining.php?id=".$row['trg_id']."'>
					<td>" . $row['gname'] . "&nbsp;</td>
					<td>" . $row['sname'] . "&nbsp;</td>
					<td>" . $row['th_exp_lvl'] . "&nbsp;</td>
					<td>" . $row['trg_name'] . "&nbsp;</td>
					<td><a href='EmployeeLink.php?emp_id=".$row['e_id']."'><img alt='Mitarbeiter' src='pict/avatar.gif'></a>";
				break;
			case 'c':
				echo "
					<tr data-href = 'displayCert.php?id=".$row['crt_id']."'>
					<td>" . $row['gname'] . "&nbsp;</td>
					<td>" . $row['sname'] . "&nbsp;</td>
					<td>" . $row['th_exp_lvl'] . "&nbsp;</td>
					<td>" . $row['crt_name'] . "&nbsp;</td>
					<td><a href='EmployeeLink.php?emp_id=".$row['e_id']."'><img alt='Mitarbeiter' src='pict/avatar.gif'></a>";
				break;
			default:
				echo "
					<td> Fehler in type of experience &nbsp;</td>";
			};
		echo "</tr>";
	}
	echo "</tbody></table>";
}


function SkillIntList($sql)
{

	echo "<h5>Interessierte Mitarbeiter</h5>";
	echo " 
	<table class='table table-hover'>
		<thead>		
			<tr>
			<th>Vorname</th>
			<th>Nachname</th>
			<th>Level</th>
			</tr>
		</thead>
		<tbody>";
	while ($row = mysqli_fetch_assoc($sql)) {
		echo "
	<tr data-href = 'EmployeeLink.php?id=" . $row['p_id'] . "&emp_id=".$row['e_id']."'>
		<td>" . $row['gname'] . "&nbsp;</td>
		<td>" . $row['sname'] . "&nbsp;</td>
		<td>" . $row['interest_lvl'] . "&nbsp;</td>";
	}
	echo "</tbody></table>";
}


function UserList($sql, $Link)
{
	echo "
		<table class='table table-hover'>
			<thead>
				<tr>
					<th scope='col'> Benutzer </th>
					<th scope='col'> Access Level </th>
					<th scope='col'> Nachname </th>
					<th scope='col'> Vorname </th>
				</tr>
			</thead>
			<tbody>";

	while ($row = mysqli_fetch_array($sql)) {
		echo "
				<tr data-href = '$Link"."id=" . $row['id'] . "'>
					<td>" . $row['uname'] . "</td>
					<td>" . $row['acclvl'] . "</td>
					<td>" . $row['sname'] . "</td>
					<td>" . $row['gname'] . "</td>	
				</tr>";
	}
	echo "</tbody> </table>";
}


function SkillList($sql, $Link)
{
	echo "
		<table class='table table-hover' id='SkillList'>
			<thead>
				<tr>
					<th scope='col' id='skill_name'> Bezeichnung </th>
					<th scope='col' id='skill_sdesc'> Kurzbeschreibung </th>
				</tr>
				<br><br>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
				<tr data-href = '$Link" . "skill_id=" . $row['s_id']."'>
					<td>" . $row['name'] . "</td>
					<td>" . $row['s_desc'] . "</td>
				</tr>";
		}
	echo "</tbody>";
	echo "</table>";
}

function SkillLongList($sql, $Link)
{
	echo "
		<table class='table table-hover table-sm' id='SkillList'>
			<thead>
				<tr>
					<th scope='col' id='skill_name'> Bezeichnung </th>
					<th scope='col' id='skill_sdesc'> Kurzbeschreibung </th>
					<th scope='col' id='skill_ldesc'> Langbeschreibung </th>
				</tr>
				<br><br>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
				<tr data-href = '$Link" . "skill_id=" . $row['s_id']."'>
					<td>" . $row['name'] . "</td>
					<td>" . $row['s_desc'] . "</td>
					<td><small>" . $row['l_desc'] . "</small></td>
				</tr>";
		}
	echo "</tbody>";
	echo "</table>";
}

function ProjectList($sql, $Link)
{
	echo "
		<table class='table table-hover' id='ProjectList'>
			<thead>
				<tr>
					<th scope='col' id='proj_name'> Bezeichnung </th>
					<th scope='col' id='proj_cust'> Kunde </th>
					<th scope='col' id='proj_industry'> Branche </th>
					<th scope='col' id='proj_sdate'> Beginn </th>
					<th scope='col' id='proj_edate'> Ende </th>
				</tr>
				<br><br>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
				<tr data-href = '$Link" . "id=" . $row['pr_id']."&emp_id=0'>
					<td>" . $row['p_name'] . "</td>
					<td>" . $row['cust'] . "</td>
					<td>" . $row['industry'] . "</td>
					<td>" . date_etog($row['s_date']) . "</td>
					<td>" . date_etog($row['e_date']) . "</td>
				</tr>";
		}
	echo "</tbody>";
	echo "</table>";
}

function ProjectLongList($sql, $Link)
{
	echo "
		<table class='table table-hover table-sm' id='ProjectList'>
			<thead>
				<tr>
					<th scope='col' id='proj_name'> Bezeichnung </th>
					<th scope='col' id='proj_cust'> Kunde </th>
					<th scope='col' id='proj_industry'> Branche </th>
					<th scope='col' id='descript'> Beschreibung </th>
				</tr>
				<br><br>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
				<tr data-href = '$Link" . "id=" . $row['pr_id']."&emp_id=0'>
					<td>" . $row['p_name'] . "</td>
					<td>" . $row['cust'] . "</td>
					<td>" . $row['industry'] . "</td>
					<td><small>" . $row['descript'] . "</small></td>
				</tr>";
		}
	echo "</tbody>";
	echo "</table>";
}


function TrainingList($sql, $Link)
{
	echo "
		<table class='table table-hover' id='TrainingList'>
			<thead>
				<tr>
					<th scope='col' id='trg_name'> Bezeichnung </th>
					<th scope='col' id='trg_cust'> Beschreibung </th>
				</tr>
				<br><br>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
				<tr data-href = '$Link" . "id=" . $row['trg_id']."&emp_id=0'>
					<td>" . $row['trg_name'] . "</td>
					<td>" . $row['trg_desc'] . "</td>
				</tr>";
		}
	echo "</tbody>";
	echo "</table>";
}


function CertList($sql, $Link)
{
	echo "
		<table class='table table-hover' id='CertList'>
			<thead>
				<tr>
					<th scope='col' id='crt_name'> Bezeichnung </th>
					<th scope='col' id='crt_desc'> Beschreibung </th>
					<th scope='col' id='crt_issuer'> Herausgeber </th>
				</tr>
				<br><br>
			</thead>
			<tbody>";
	while ($row = mysqli_fetch_array($sql)) {
		echo "
				<tr data-href = '$Link" . "id=" . $row['crt_id']."&emp_id=0'>
					<td>" . $row['crt_name'] . "</td>
					<td>" . $row['crt_desc'] . "</td>
					<td>" . $row['crt_issuer'] . "</td>
				</tr>";
		}
	echo "</tbody>";
	echo "</table>";
}


function ProjectRadioList($sql, $pr_proj_id)
{
	echo "
		<table class='table table-striped table-sm'>
		<thead class='thead-dark'>
			<tr>
				<th> </th>
				<th scope='col' style='text-align:left'>Kunde</th>
				<th scope='col' style='text-align:left'>Projekt</th>
			</tr>
		</thead>
		<tbody>
			<form>";
	while ($row = mysqli_fetch_array($sql)) {
		if ((int)$pr_proj_id == (int)$row['pr_id']) {
			echo "		
				<tr>
					<td>
						<div class='radio'>
							<label><input type='radio' id='id_pr_radio' name='projradio' checked='checked' value=".$row['pr_id']." data-toggle='buttons'> </label>
						</div>
					</td>
					<td>".$row['cust'].".</td>
					<td>".$row['p_name']."</td>
				</tr>";
			}
		else {
			echo "		
				<tr>
					<td>
						<div class='radio'>
							<label><input type='radio' id='id_pr_radio' name='projradio' value=".$row['pr_id']." data-toggle='buttons'> </label>
						</div>
					</td>
					<td>".$row['cust']."</td>
					<td>".$row['p_name']."</td>
				</tr>";
			}
		}
	echo "
			</form>
		</tbody>
		</table>";
}

function TrainingRadioList($sql, $th_trg_id)
{
	echo "<div class='form-check' id='id_trg_radio' data-toggle='buttons'>";
	while ($row = mysqli_fetch_array($sql)) {
		if ((int)$th_trg_id == (int)$row['trg_id']) {
			echo "	<label class='form-check-label' active>
					<input class='form-check-input' type='radio' name='trgradio' checked='checked' value=".$row['trg_id'].">".$row['trg_name']."</label><hr>";
			}
		else {
			echo "	<label class='form-check-label'>
					<input class='form-check-input' type='radio' name='trgradio' value=".$row['trg_id'].">".$row['trg_name']."</label><hr>";
			}
		}
	echo "</div>";
}


function CertRadioList($sql, $th_crt_id)
{
	echo "<div class='form-check' id='id_crt_radio' data-toggle='buttons'>";
	while ($row = mysqli_fetch_array($sql)) {
		if ((int)$th_crt_id == (int)$row['crt_id']) {
			echo "	<label class='form-check-label' active>
					<input class='form-check-input' type='radio' name='crtradio' checked='checked' value=".$row['crt_id'].">".$row['crt_name']."</label><hr>";
			}
		else {
			echo "	<label class='form-check-label'>
					<input class='form-check-input' type='radio' name='crtradio' value=".$row['crt_id'].">".$row['crt_name']."</label><hr>";
			}
		}
	echo "</div>";
}

?>


