<?php
session_start();
//check if the submit button was clicked or not

if (isset($_POST['submit'])) {
    //echo "Clicked";
//connect to the database

    require "conn.php";
    //collect data from the form

    $uName = $_POST ['uName'];
    $password = $_POST['password'];

    //check if the fields are empty

    if (empty($uName) || empty($password)) {
        header("Location:../index.php?error=emptyfields");
        exit();
    }
    //check if the password provided matches what we have in the database
    $sql = "SELECT * FROM staff WHERE uName =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    }else {
        mysqli_stmt_bind_param($stmt, "s" , $uName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
           $passCheck = password_verify($password, $row['pass']);
           if ($passCheck == false) {
              header("Location:../index.php?error=wrongpass");
           }elseif ($passCheck == true) {
              session_start();
              $_SESSION['sessionId'] = $row ['id'];
              $_SESSION ['sessionUser'] = $row['uName'];
              header("Location:../dashboard/dashboard.php?success=Loggedin");
           }
        }else {
            header("Location:../index.php?error=nouser");
        }
    }


}else {
    header("Location:../pages/login.php?error=accessforbbiden");
}

?>