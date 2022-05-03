<?php

if (isset($_POST['submit'])) {
   //echo "Clicked";

   //Connect to database
    require "conn.php";

    $uName = $_POST['uName'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //Error handles
    if (empty($uName) || empty($mail) || empty($password) || empty($confirm_password)) {
       header("Location:../pages/create-account.php?error=emptyfields&username=".$username);
       exit();

       //check for invalid fields
       
    }elseif (!preg_match("/^[a-zA-Z0-9]*/", $uName)) {
        header("Location:../pages/create-account.php?error=invalidfields&username".$username);
        exit();
        //check if the password match
    }elseif ($password !== $confirm_password) {
        header("Location:../create-account.php?error=passworddonotmatch&username".$usename);
        exit();   
        //check if the username i taken or not
    }else {
        $sql = "SELECT uName FROM staff WHERE uName = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
           header("Location:../create-account.php?error=sqlerror1");
           exit();
        }else {
            mysqli_stmt_bind_param($stmt, "ss", $uName, $mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);
            if ($rowCount > 0) {
                header("Location:../create-account.php?error=usernametaken&username".$username);
                exit();
                // insert data into the database
            }else {
                $sql = " INSERT INTO staff (uName,mail, pass) values (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
               if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location:../create-account.php?error=sqlerror2");
                exit();
                //create a hashed password
               }else {
                   $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                   mysqli_stmt_bind_param($stmt, "sss" , $uName,$mail, $hashedPass);
                   mysqli_stmt_execute($stmt);
                    header("Location:../dashboard/dashboard.php?succes=registered");
               }
            }
        }

    }
    
}

?>