<?php

// File: login_action.php

global $link;
require_once('../connect_db.php');
require_once('login_tools.php');

start_session_function();

// Form submission check
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Getting submitted email and password
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

        // Set a success message for the login page (optional)
        $_SESSION['success_msg'] = 'Login successful! Welcome back!';

        // Load the home page or protected area with success message preserved
        load('allproducts.php');
    } else {
        // Invalid credentials
        $_SESSION['errors'] = array('Invalid email or password.');
        load('login.php');
    }

    // Close the database connection
    mysqli_close($link);
} else {
    load('login.php');
}
?>
