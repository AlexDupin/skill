<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/bootstrap.css">


<?php

if ($_COOKIE['uname']==NULL){
	echo "<meta http-equiv='refresh' content='0 url=index.html'>";
	}

?>
</head>
<body>

							<!--		Jumbotron		-->

<?php include('jumbotron.html'); ?>
							<!--		NavBar		-->
<?php include('Navbar/Dashboard.html'); ?>
<br>


<!--           		New Login		        -->


<div class=container>
	<div class=row>
		<br>
		<h2>Dashboard</h2>
		<br>
	</div>
	<div class=row>
		<div class=col>
			<?php
				include('inc.php');
				$UID = $_COOKIE['userid'];
				$sql = mysqli_query($con,"SELECT * FROM emp WHERE id='$UID';");
				$row = mysqli_fetch_assoc($sql);
				$gname = $row['gname'];
				setcookie('password', '', time() - 3600);

				if ($_COOKIE['NewLogin']=="True") {
					echo "<br><div class='alert alert-success'> <strong>ERFOLG!</strong> Der Login hat funktioniert </div>";
					echo "<br> <p> Willkommen zu Skill-Management-System der NOVEDAS, <b>".$gname." </b></p><hr>";

					setcookie("NewLogin","FALSE");
					};
			?>
		</div>
	</div>
	<div class=row>
		<div class=col>
			<?php
				$sql = mysqli_query($con,"SELECT * FROM emp ;");
				$num=mysqli_num_rows($sql);
				echo "<br>Anzahl der erfassten Mitarbeiter: ". $num;

				$sql = mysqli_query($con,"SELECT * FROM skill ;");
				$num=mysqli_num_rows($sql);
				echo "<br>Anzahl der erfassten Skills: ". $num;

				$sql = mysqli_query($con,"SELECT * FROM pers_skill ;");
				$num=mysqli_num_rows($sql);
				echo "<br>Anzahl der erfassten persönlichen Skills: ". $num;

				$sql = mysqli_query($con,"SELECT * FROM proj ;");
				$num=mysqli_num_rows($sql);
				echo "<br>Anzahl der erfassten Projekte: ". $num;

				$sql = mysqli_query($con,"SELECT * FROM trg ;");
				$num=mysqli_num_rows($sql);
				echo "<br>Anzahl der erfassten Schulungen: ". $num;

				$sql = mysqli_query($con,"SELECT * FROM crt ;");
				$num=mysqli_num_rows($sql);
				echo "<br>Anzahl der erfassten Zertifikate: ". $num;
				echo "<hr>";
				echo nl2br(file_get_contents( "versioninfo.php" ));
			?>
		</div>
		<div class=col>
			<?php
				echo "
					<h4> Hinweise </h4><hr>";
					echo nl2br(file_get_contents( "motd.php" ));
			?>
		</div>
	</div>
</div>";

</body>
</html>