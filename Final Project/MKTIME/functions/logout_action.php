<?php

// Start or resume the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destroy the session
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Redirect to login page
header("Location: ../views/login.php");
exit();

