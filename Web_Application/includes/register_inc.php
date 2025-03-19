<?php

if (isset($_POST["submit"])) {
    
    $fname = $_POST["admin_fname"];
    $lname = $_POST["admin_lname"];
    $email = $_POST["admin_email"];
    $username = $_POST["admin_username"];
    $password = $_POST["admin_password"];
    $passwordRpt = $_POST["admin_password_rpt"];

    require_once 'db_inc.php';
    require_once 'functions_inc.php';

    if (emptyInputRegister($fname, $lname, $email, $username, $password, $passwordRpt) !==false) {
        header("location: ../pages/account_manager.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !==false) {
        header("location: ../pages/account_manager.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($password, $passwordRpt) !==false) {
        header("location: ../pages/account_manager.php?error=passunmatched");
        exit();
    }

    if (usernameExists($conn, $username) !==false) {
        header("location: ../pages/account_manager.php?error=usernametaken");
        exit();
    }

    createUser($conn, $fname, $lname, $email, $username, $password);

}   
else {
    header("location: ../pages/account_manager.php");
}