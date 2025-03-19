<?php

session_start();
if(isset($_SESSION['admin_username'])) {
    header("location: pages/home.php");
}
else {
    header("location: pages/login.php");
}
?>