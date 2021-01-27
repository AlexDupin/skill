<?php
include('inc.php');
include('functions.php');

// Variables

$NewEmployeeID = $_POST['id'];
$OldEmployeeID = $_COOKIE['EmployeeID'];
$AssetID = $_COOKIE['AssetID'];

$time = time();
$select = mysqli_query($con, "SELECT * FROM Assignments WHERE EmployeeId = $NewEmployeeID AND Enddate = 0 AND AssetId = $AssetID");
$update = "UPDATE Assignments SET EndDate = '$time' WHERE EmployeeId = '$OldEmployeeID' AND Assetid = '$AssetID' AND EndDate = 0";
$insert = "INSERT INTO Assignments SET employeeId = '$NewEmployeeID' , assetId='$AssetID' , StartDate = '$time', EndDate = 0";
$getAssetId = mysqli_query($con, "SELECT AssetTag FROM Assets WHERE Id = '$AssetID'");

// Asset Tag
$row = mysqli_fetch_assoc($getAssetId);
$AssetTag = $row['AssetTag'];

// JSON values

$msg = null;
$ok = null;
// $AssetTag

if (mysqli_num_rows($select) == 0) {
  if ($OldEmployeeID == 0) {
    if (mysqli_query($con, $insert)) {
      $msg = "<strong>SUCCESS!</strong> The Assignment was created successfully";
      $ok = true;
      $txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['UserID'] . "' assigned Asset A$Tag to Employee '$NewEmployeeID' \n";
      file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
    } else {
      $msg = "<strong>ERROR!</strong> The Assignment was unsuccessfull";
      $ok = false;
    }
  } else {
    if (mysqli_query($con, $update)) {
      if (mysqli_query($con, $insert)) {
        $msg = "<strong>SUCCESS!</strong> The Assignment was created successfully";
        $ok = true;
        $txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['UserID'] . "' assigned Asset A$AssetTag to Employee '$NewEmployeeID' \n";
        file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
      } else {
        $msg = "<strong>ERROR!</strong> The Assignment was unsuccessfull";
        $ok = false;
      }
    } else {
      $msg = "<strong>ERROR!</strong> The Assignment was unsuccessfull";
      $ok = false;
    }
  }
} else {
  $msg = "<strong>ERROR!</strong> This asset is already assigned to this user";
  $ok = false;
}

echo json_encode(
  array(
    'msg' => $msg,
    'ok' => $ok,
    'tag' => $AssetTag,
  )
);
