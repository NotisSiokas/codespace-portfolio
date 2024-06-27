<?php
// File: api/UserApiController.php

require_once '../models/User_Class.php';
require_once '../models/UserDetails_Class.php';
require_once '../connect_db.php';

class UserApiController {
    private $user;
    private $userDetails;

    public function __construct() {
        global $link;
        $this->user = new User_Class($link);
        $this->userDetails = new UserDetails_Class($link);
    }

    public function registerAction() {
        header('Content-Type: application/json');

        $requestData = json_decode(file_get_contents('php://input'), true);

        // Input Validation: Check for all required fields and password match
        $requiredFields = ['first_name', 'last_name', 'email', 'password', 'confirm_password', 'street_address', 'address_line_2', 'city', 'postal_code', 'phone_number'];
        foreach ($requiredFields as $field) {
            if (empty($requestData[$field])) {
                echo json_encode(['error' => 'Missing required field: ' . $field]);
                return;
            }
        }
        
        if ($requestData['password'] !== $requestData['confirm_password']) {
            echo json_encode(['error' => 'Passwords do not match']);
            return;
        }

        // Email Uniqueness Check
        if ($this->user->getUserByEmail($requestData['email'])) {
            echo json_encode(['error' => 'Email already exists. Please choose a different one.']);
            return;
        }

        // Hash the password
        $passwordHash = password_hash($requestData['password'], PASSWORD_DEFAULT);

        try {
            // Create user
            $userId = $this->user->createUser($requestData['first_name'], $requestData['last_name'], $requestData['email'], $passwordHash);

            // Create user details
            $this->userDetails->createUserDetails(
                $userId,
                $requestData['street_address'],
                $requestData['address_line_2'],
                $requestData['city'],
                $requestData['postal_code'],
                $requestData['phone_number']
            );

            // Registration success
            echo json_encode(['success' => true, 'message' => 'Registration successful!']);

        } catch (Exception $e) {
            // Handle exceptions
            error_log("User creation failed: " . $e->getMessage());
            echo json_encode(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function getAllUsers() {
        header('Content-Type: application/json');
        
        try {
            // Fetch all users from the database (use your existing User_Class method)
            $users = $this->user->getAllUsers(); // You'll need to add this method to User_Class

            // Return the users as JSON
            echo json_encode(['users' => $users]);

        } catch (Exception $e) {
            // Handle exceptions
            error_log("Error fetching users: " . $e->getMessage());
            echo json_encode(['error' => 'Error fetching users']);
        }
    }

}


