// Rest aus EmployeeLink

					// Zuerst die Liste der praktischen Skills mit Projektnamen
/* 
					$Asql = mysqli_query($con, "select pr_id, name, pr_exp_lvl, p_name, pr_exp_com 
													from pers_skill as ps 
													inner join skill s2 
													on ps.skill_id = s2.id 
													left JOIN proj pr 
													on ps.pr_proj_id = pr.pr_id 
													where ps.emp_id = '$EID' and ps.e_type ='p';");
					$Arows = mysqli_num_rows($Asql);			
					if ($Arows > 0) {
						echo " 
							<h4> Praktische Erfahrungen </h4>
							<table class='table table-hover'>
								<thead>
									<TR>
									<TH>Skill-Name</TH>
									<TH>Level</TH>
									<TH>Projekt</TH>
									<TH>Rolle im Projekt / Persönliche Bemerkung</TH>
									</TR>
								</thead>
								<tbody>";
						while ($row = mysqli_fetch_array($Asql)) {
							// Fetch name of skill
							echo "
								<tr data-href='ProjectLink.php?"."id=" . $row['pr_id'] . "'>
								<td>" . $row['name'] . "</td>
								<td>" . $row['pr_exp_lvl'] . "</td>
								<td>" . $row['p_name'] . "&nbsp;</td>
								<td>" . $row['pr_exp_com'] . "&nbsp;</td>
								</tr>";
							}
						echo "</tbody></table><br><br>";
						}
					// Dann die Liste der Schulungen und Zertifkate
					$Asql = mysqli_query($con, "SELECT trg_id, name, trg_name, th_exp_lvl, th_exp_com, interest_lvl 
													FROM pers_skill ps
													JOIN skill s2 on s2.id = ps.skill_id 
													JOIN trg on ps.th_trg_id = trg.trg_id 
													WHERE ps.emp_id = '$EID' and ps.e_type ='t';");
					$Arows = mysqli_num_rows($Asql);			
					if ($Arows > 0) {
						echo " 
							<h4> Schulungen</h4>
							<table class='table table-hover'>
								<thead>
									<TR>
									<TH>Skill-Name</TH>
									<TH>Level</TH>
									<TH>Schulung</TH>
									<TH>Persönliche Bemerkung</TH>
									</TR>
								</thead>
								<tbody>";
						while ($row = mysqli_fetch_array($Asql)) {
							// Fetch name of skill
							echo "
								<tr data-href='TrainingLink.php?"."id=" . $row['trg_id'] . "'>
								<td>" . $row['name'] . "</td>
								<td>" . $row['th_exp_lvl'] . "</td>
								<td>" . $row['trg_name'] . "&nbsp;</td>
								<td>" . $row['th_exp_com'] . "&nbsp;</td>
								</tr>";
							}
						echo "</tbody></table><br><br>";
						}

					$Asql = mysqli_query($con, "SELECT crt_id, name, crt_name, th_exp_lvl, th_exp_com, interest_lvl 
													FROM pers_skill ps
													JOIN skill s2 on s2.id = ps.skill_id 
													JOIN crt on ps.th_crt_id = crt.crt_id 
													WHERE ps.emp_id = '$EID' and ps.e_type ='t';");
					$Arows = mysqli_num_rows($Asql);			
					if ($Arows > 0) {
						echo " 
							<h4> Zertifikate </h4>
							<table class='table table-hover'>
								<thead>
									<TR>
									<TH>Skill-Name</TH>
									<TH>Level</TH>
									<TH>Zertifikat</TH>
									<TH>Persönliche Bemerkung</TH>
									</TR>
								</thead>
								<tbody>";
						while ($row = mysqli_fetch_array($Asql)) {
							// Fetch name of skill
							echo "
								<tr data-href='TrainingLink.php?"."id=" . $row['crt_id'] . "'>
								<td>" . $row['name'] . "</td>
								<td>" . $row['th_exp_lvl'] . "</td>
								<td>" . $row['crt_name'] . "&nbsp;</td>
								<td>" . $row['th_exp_com'] . "&nbsp;</td>
								</tr>";
							}
						echo "</tbody></table><br><br>";
						}
 */