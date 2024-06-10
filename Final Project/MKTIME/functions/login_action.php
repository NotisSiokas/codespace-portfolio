<?php

// File: login_action.php

global $link;
require_once('../connect_db.php');  // Your database connection file
require_once('login_tools.php');  // Your utility functions for validation and redirection

// Start or resume the session safely
start_session_function();

// Form submission check
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get submitted email and password (sanitize for security)
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validate credentials against database
    require_once '../models/User_Class.php';
    $user = new User_Class($link);
    $userData = $user->getUserByEmail($email);

    if ($userData && password_verify($password, $userData['password_hash'])) {
        // Successful login
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['first_name'] = $userData['first_name'];
        $_SESSION['last_name'] = $userData['last_name'];

        // Load the home page or protected area
        load('allproducts.php'); // or your protected page
    } else {
        // Invalid credentials
        $_SESSION['errors'] = array('Invalid email or password.');
        load('login.php'); // Redirect back to login form with error
    }

    // Close the database connection (important!)
    mysqli_close($link);
} else {
    load('login.php'); // If accessed directly, redirect to login page
}
?>
