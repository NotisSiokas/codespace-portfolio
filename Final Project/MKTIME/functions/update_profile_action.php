<?php
// Start or resume the session
global $link;
session_start();

// Checking if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirecting to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include necessary files
require_once '../models/User_Class.php';
require_once '../connect_db.php';

// Initialize User object
$user = new User_Class($link);

// Get user input
$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';

// Update user details
$userId = $_SESSION['user_id'];
$updateResult = $user->updateUser($userId, $firstName, $lastName, $email);

// Checking if update was successful
if ($updateResult === 1) {
    // Redirecting to profile page with success message
    $_SESSION['success_message'] = "Your profile has been updated successfully.";
    header("Location: /views/profile.php");
} else {
    // Redirecting to profile page with error message
    $_SESSION['error_message'] = "An error occurred while updating your profile. Please try again.";
    header("Location: /views/profile.php");
}
