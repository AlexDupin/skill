<?php
	include('inc.php');
	include('my_date_functions.php');
	include('functions.php');
	$EID = $_COOKIE['EmployeeId'];
	$SkillID = $_POST['skill_id'];
	$SkillLevel = $_POST['level'];
	$SkillComm = $_POST['comment'];
	$SkillSDate = date_gtoe($_POST['sdate']);
	$SkillEDate = date_gtoe($_POST['edate']);
	$SkillProject = $_POST['project'];
	$SkillTraining = $_POST['training'];
	$SkillCrt = $_POST['crt'];
	$PSID = $_POST['PSID'];
	$SkillInterest = $_POST['interest'];
	$SkillType = $_POST['ETYPE'];

	if ((int)$PSID == 0) {
		$command = "INSERT";
		$appendix = '';
		}
	else {
		$command = "UPDATE";
		$appendix = "WHERE id='$PSID'";
		}

	switch ($SkillType) {
		case 'p':
			$pr_exp_com = $SkillComm;
			$pr_exp_lvl = $SkillLevel;
			$th_exp_com = '';
			$th_exp_lvl = 0;
			$Interest_lvl = 0;
			$SkillCrt = 0;		
			break;
		case 't':
			$th_exp_com = $SkillComm;
			$th_exp_lvl = $SkillLevel;
			$pr_exp_com = '';
			$pr_exp_lvl = 0;
			$Interest_lvl = 0;
			$SkillSDate = "1998-02-01";
			$SkillEDate = "1998-02-01";
			break;
		case 'c':
			$th_exp_com = $SkillComm;
			$th_exp_lvl = $SkillLevel;
			$pr_exp_com = '';
			$pr_exp_lvl = 0;
			$Interest_lvl = 0;
			$SkillSDate = "1998-02-01";
			$SkillEDate = "1998-02-01";
			break;
		case 'i':
			$th_exp_com = '';
			$th_exp_lvl = 0;
			$SkillCrt = 0;
			$pr_exp_com = '';
			$pr_exp_lvl = 0;
			$SkillSDate = "1998-02-01";
			$SkillEDate = "1998-02-01";
			$Interest_lvl = $SkillInterest;
			break;
		default:
			echo "fehler in Skill-Typ!";
		}

	$SQLCOMMAND = $command . " pers_skill SET emp_id='$EID',
							skill_id = '$SkillID' , 
							e_type='$SkillType' , 
							pr_exp_lvl='$pr_exp_lvl',
							pr_exp_com='$pr_exp_com',
							pr_proj_id='$SkillProject',
							pr_start='$SkillSDate',
							pr_end='$SkillEDate',
							th_exp_lvl='$th_exp_lvl',
							th_exp_com='$th_exp_com',
							th_trg_id='$SkillTraining',
							interest_lvl='$Interest_lvl',
							th_crt_id='$SkillCrt' ".
					$appendix.";";

	$msg = "<strong>ERFOLG!</strong>Das Projekt wurde angelegt.";
	$ok = true;

	if (mysqli_query($con,$SQLCOMMAND)){
		$msg = "<strong>ERFOLG!</strong>Die Erfahrung wurde angelegt.";
		$ok = true;
		$txt = date("Y-m-d h:i:sa") . " User '".$_COOKIE['uname']."' created personal skill $SkillID \n".$PSID." - ".$SQLCOMMAND;
		file_put_contents("$file", $txt, FILE_APPEND | LOCK_EX);
	}
	else{
		$msg = "<strong>FEHLER!</strong> Der persoenliche Skill konnte nicht angelegt werden.\n".$PSID." - ".$SQLCOMMAND;
		$ok = false;
	}
	echo json_encode(
		array (
			'msg' => $msg,
			'ok' => $ok
		)
		);
?>