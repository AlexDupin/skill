<?php
include ("inc.php");

$UserID = $_COOKIE["uname"];

$sql = mysqli_query($con, "SELECT acclvl FROM emp WHERE uname = '$UserID'");
$row = mysqli_fetch_assoc($sql);

$AccessLevel = $row['acclvl'];

echo "$AccessLevel";

?>