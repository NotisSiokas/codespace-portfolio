<?php
// File: controllers/UserController.php

require_once '../models/User_Class.php';
require_once '../models/UserDetails_Class.php';
require_once '../connect_db.php'; // Include the database connection file

class UserController {
    private $user;
    private $userDetails;

    public function __construct() {
        global $link; // Get the MySQLi connection from connect_db.php
        $this->user = new User_Class($link);
        $this->userDetails = new UserDetails_Class($link);
    }

    public function registerAction() {
        // Get form data
        $firstName = $_POST['first_name'] ?? '';
        $lastName = $_POST['last_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Input validation (You'll likely add more robust validation)
        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || $password !== $confirmPassword) {
            // Pass error message as query parameter
            header("Location: ../views/register.php?error=" . urlencode("Please fill in all fields correctly and ensure passwords match."));
            return;
        }

        // Check if email already exists
        if ($this->user->getUserByEmail($email)) {
            // Pass error message as query parameter
            header("Location: ../views/register.php?error=" . urlencode("Email already exists. Please choose a different one."));
            return;
        }

        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Create user
            $userId = $this->user->createUser($firstName, $lastName, $email, $passwordHash);

            // Create user details
            try {
                $this->userDetails->createUserDetails($userId, $_POST['street_address'] ?? '', $_POST['address_line_2'] ?? '', $_POST['city'] ?? '', $_POST['postal_code'] ?? '', $_POST['phone_number'] ?? '');
            } catch (Exception $e) {
                // Handle user details creation error (e.g., log the error)
                // You might decide to still show the registration success message
                // but inform the user that details could not be saved
                error_log("User details creation failed: " . $e->getMessage());
            }

            // Redirect to success page
            header("Location: ../views/register.php?success=" . urlencode("Registration successful!"));

        } catch (Exception $e) {
            // Handle user creation error (e.g., log the error)
            error_log("User creation failed: " . $e->getMessage());
            // Redirect to error page
            header("Location: ../views/register.php?error=" . urlencode("Registration failed. Please try again."));
            // Redirect to success page (you might want a dedicated success page later)
            header("Location: ../views/register.php?success=" . urlencode("Registration successful!"));

        } catch (Exception $e) { // Catch any exceptions (including potential database errors)
            // Pass error message as query parameter
            header("Location: ../views/register.php?error=" . urlencode("Registration failed. Please try again."));
        }
    }
}

// Handle the action parameter
$userController = new UserController();
$action = $_GET['action'] ?? '';

if ($action == 'register') {
    $userController->registerAction();
}
