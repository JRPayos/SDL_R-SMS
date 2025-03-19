<?php
session_start();

require_once 'db_inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aduser = $_POST['aduser'];
    $adpass = $_POST['adpass'];

    $sql = "SELECT * FROM `admin` WHERE `admin_username`= '$aduser' AND `admin_password` ='$adpass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['admin_password'];
        
        // Verify the password
        if (password_verify($adpass, $hashed_password)) {
            // Password is correct, start a new session
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $aduser;
            header("location: ../pages/home.html"); // Redirect to dashboard or welcome page
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password";
        }
    } else {
        // User not found
        echo "User not found";
    }
}

mysqli_close($conn);