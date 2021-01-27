<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Skill Database @ NOVEDAS</title>
		<?php include "head.php"; ?>
 
			<script type="text/javascript">
				$(document).ready(function(){
					$('[data-toggle="tooltip"]').tooltip();   
				});
			</script>
 
	</head>
	<body>
		<link href="css/style.css" rel='stylesheet' type='text/css'>
		<div class="jumbotron text-center">
			<h1>Skill Database @ NOVEDAS</h1>
			<h2>Messergebnisse ortsveränderlicher elektrischer Geräte</h2>
		</div>

		<div class="container">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active" href="#">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="messungen.php">Messungen</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="create.php">Eingabe Messung</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="report.php">Report</a>
				</li>			
			</ul>
		</div>
		<div class="container">
			<div class="alert alert-success" role="alert">
			  <h4 class="alert-heading">Information</h4>
			  <p>
			  <p>Messung der ortsveränderlichen elektrischen Geräte bei NOVEDAS. Hier werden die Messergebnisse 
			  dokumentiert.</p>
			  <hr>
			  <p class="mb-0"></p>
			</div>        
		</div>
 
	</body>
</html>