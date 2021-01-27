<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">

	<?php
	if ($_COOKIE['uname'] == NULL) {

	   echo "<meta http-equiv='refresh' content='0 url=index.html'>";
	}
	?>
</head>

<body>
	<?php include('jumbotron.html'); ?>

	<?php include('Navbar/Skills.html'); ?>

	<br>
	<br>
	<?php 
		include('inc.php');
		include('functions.php');

		$skillid = $_GET['id'];
		setcookie('deleteskillid', $skillid);

		$sql = mysqli_query($con, "SELECT * FROM skill WHERE Id = $skillid");
		$row = mysqli_fetch_assoc($sql);

		$skillName = $row['name'];
		$skillSDesc = $row['s_desc'];
		$skillDesc = $row['desc'];
	?>

	<div class='container'>
	   <div class='row'>
		  <div class='col'>
		  </div>

		  <div class='col'>
			 <h2> Skills bearbeiten </h2>
			 <p> Bearbeite Skills mit allen Daten </p>
			 <br>
			 <form action='EditSkillInsert.php' method=POST>
				<input type="text" class="form-control" placeholder="Skill" value="<?php echo "$skillname"; ?>" name="skillname">
				<br>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" Kurzbeschreibung </span>
					</div>
					<textarea class="form-control" aria-label="Kurzbeschreibung" value="<?php echo "$skillSDesc"; ?>"></textarea>
				</div>
				<br><br>
				<input type="text" class="form-control" label="Langbeschreibung" placeholder="Langbeschreibung" value="<?php echo "$skillDesc"; ?>" name="skillDesc">
				<br>				
				<br>
				<button type='submit' class="btn btn-primary"> Update Skill </button>
				<a href='DeleteSkill.php' role='button' class='btn btn-secondary'> Delete Skill </a>
			 </form>
		  </div>
		  <div class='col'>
		  </div>
	   </div>
	</div>
</body>

</html>