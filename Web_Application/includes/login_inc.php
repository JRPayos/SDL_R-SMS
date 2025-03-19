<?php

if (isset($_POST["submit"])) {

    $username = $_POST["aduser"];
    $password = $_POST["adpass"];
    
    require_once 'db_inc.php';
    require_once 'functions_inc.php';

    if (emptyInputLogin($username, $password) !== false ) {
        header("location: ../pages/login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $password);
}
else {
    header("location: ../pages/login.php");
    exit();;
}