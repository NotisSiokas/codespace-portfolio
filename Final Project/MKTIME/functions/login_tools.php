<?php
// File: login_tools.php

function load($page = 'login.php') {
    // Get the base URL dynamically
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

    // Define the correct path to your views folder
    $viewsPath = '/views/';

    $url = $baseUrl . $viewsPath . $page;

    header("Location: $url");
    exit();
}

# Function to check email address and password.
function validate($link, $email = '', $pwd = '')
{
    $errors = array();

    # Check email field.
    if (empty($email)) {
        $errors[] = 'Enter your email address.';
    } else {
        $email = mysqli_real_escape_string($link, trim($email));
    }

    # Check password field.
    if (empty($pwd)) {
        $errors[] = 'Enter your password.';
    } else {
        $password = trim($pwd);
    }

    # Validate credentials against the database
    if (empty($errors)) {
        require_once '../models/User_Class.php';
        $userClass = new User_Class($link);
        $user = $userClass->getUserByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            return array(true, $user);
        } else {
            $errors[] = 'Email address and password not found.';
        }
    }

    return array(false, $errors);
}

# Helper function to safely start a session.
function start_session_function() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}
?>
