<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/Customstyles.css">

    <?php
    if ($_COOKIE['uname'] == NULL or $_COOKIE['acclvl'] == 1) {

        echo "<meta http-equiv='refresh' content='0 url=index.html'>";
    }
    ?>
</head>

<body>
    <?php include('jumbotron.html'); ?>

    <?php include('Navbar/ManageUsers.html'); ?>

    <br>
    <br>

    <div class='container'>

        <?php

        include('inc.php');
        include('functions.php');

        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $givenname = $_POST['givenname'];
		$organization = $_POST['org'];
   		$date_of_entry = $_POST['entrydate'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $accesslevel = $_POST['accesslevel'];

        $passwordhashed = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO emp SET uname = '$username' , sname = '$surname' , gname = '$givenname' , d_of_entry=STR_TO_DATE('$date_of_entry',\"%d.%m.%Y\") , d_of_exit = '2040-12-31', company = '$organization', password = '$passwordhashed' , acclvl = '$accesslevel';";

        if ($password == $confirmpassword) {
            if ($accesslevel == "Access Level") {
                echo "<div class='alert alert-danger'> <strong>ERROR!</strong> You need to select an access level</div>";
            } else {
                if (mysqli_query($con, $sql)) {
                    echo "<div class='alert alert-success'> <strong>SUCCESS!</strong> The User was successfully created</div>";
					// Logfile-String zusammenbauen und speichern
                    $txt = date("Y-m-d h:i:sa") . " User '" . $_COOKIE['uname'] . "' created User $username \n";
                    file_put_contents($file, $txt, FILE_APPEND | LOCK_EX);
                } else {
                    echo "<div class='alert alert-danger'> <strong>ERROR!</strong> Something went wrong while inserting</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger'> <strong>ERROR!</strong> The passwords don't match</div>";
        }
        ?>
    </div>
</body>

</html>