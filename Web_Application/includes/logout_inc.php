<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// If there's a session cookie, remove it by setting its expiration time to the past
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Expire all other cookies related to the login
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/');
}
if (isset($_COOKIE['password'])) {
    setcookie('password', '', time() - 3600, '/');
}

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Redirect to the login page
header("Location: ../pages/login.php");
exit();
?>
