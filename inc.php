<?php
$host = "localhost";
$user = "skill";
$passwd ="skill";
$datenbank = "skill";
$con=mysqli_connect($host,$user,$passwd,$datenbank) or die("<h5>Error:Die Datenbank ist momentan nicht erreichbar</h5>");
mysqli_set_charset($con, "utf8");
?>
