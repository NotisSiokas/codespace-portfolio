<?php
// Start or resume the session
global $link;
session_start();

// Include necessary files
require_once '../models/UserDetails_Class.php';
require_once '../connect_db.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $street_address = $_POST['street_address'];
    $address_line_2 = $_POST['address_line_2'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $phone_number = $_POST['phone_number'];

    // Initialize UserDetails object
    $userDetails = new UserDetails_Class($link);

    // Update address details
    $updateResult = $userDetails->updateUserDetails($_SESSION['user_id'], $street_address, $address_line_2, $city, $postal_code, $phone_number);

    // Check if update was successful
    if ($updateResult === 1) {
        // Redirect to profile page with success message
        $_SESSION['success_message'] = "Your address details have been updated successfully.";
        header("Location: /views/profile.php");
    } else {
        // Redirect to profile page with error message
        $_SESSION['error_message'] = "An error occurred while updating your address details. Please try again.";
        header("Location: /views/profile.php");
    }
} else {
    // Redirect to profile page if form data is not submitted
    header("Location: /views/profile.php");
}
?>
