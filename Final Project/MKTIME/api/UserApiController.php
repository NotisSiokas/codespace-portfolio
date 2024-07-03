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

        // Input Validation
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
            
            // Registration Successfull
            echo json_encode([
                'success' => true,
                'message' => 'Registration successful!',
                'userId' => $userId  // Include the created user ID
            ]);

        } catch (Exception $e) {
            // Handle exceptions
            error_log("User creation failed: " . $e->getMessage());
            echo json_encode(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function getUserById($id) {
        header('Content-Type: application/json');
        try {
            $user = $this->user->getUserById($id);
            if ($user) {
                $userDetails = $this->userDetails->getUserDetailsByUserId($id);
                $user = array_merge($user, $userDetails ?: []); // Merge user and details (using null coalescing operator)
                echo json_encode($user);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'User not found']);
            }
        } catch (Exception $e) {
            error_log("Error fetching user: " . $e->getMessage());
            echo json_encode(['error' => 'Error fetching user']);
        }
    }

    public function getAllUsers() {
        header('Content-Type: application/json');
        
        try {
            // Fetching all users from the database
            $users = $this->user->getAllUsers(); 
    
            $formattedUsers = []; 
            foreach ($users as $user) {
                $userId = $user['id'];
                $userDetails = $this->userDetails->getUserDetailsByUserId($userId);
                
                // Checking if user details exist
                if($userDetails == null){
                    $userDetails = array(
                        'street_address' => null,
                        'address_line_2' => null,
                        'city' => null,
                        'postal_code' => null,
                        'phone_number' => null
                    );
                }
                
                $formattedUsers[] = array_merge($user, $userDetails); // Merge user and details into a single object
            }   
            // Return the users as JSON
            echo json_encode($formattedUsers);
            
        } catch (Exception $e) {
            // Handle exceptions
            error_log("Error fetching users: " . $e->getMessage());
            echo json_encode(['error' => 'Error fetching users']);
        }
    }
    

    public function updateUserDetails($id) {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents('php://input'), true);
    
        // Input Validation (Simplified)
        if (empty($requestData) || !is_array($requestData)) {
            echo json_encode(['error' => 'Invalid input data. Please provide data in JSON format.']);
            return;
        }
    
        // Check for invalid field names
        $validFields = ['first_name', 'last_name', 'email', 'street_address', 'address_line_2', 'city', 'postal_code', 'phone_number'];
        foreach ($requestData as $field => $value) {
            if (!in_array($field, $validFields)) {
                echo json_encode(['error' => 'Invalid field: ' . $field]);
                return;
            }
        }
        
        try {
            $updateUserData = false;
            $updateUserDetailsData = false;
    
            if (!empty(array_intersect(array_keys($requestData), ['first_name', 'last_name', 'email']))) {
                $updateUserData = true;
                $userUpdated = $this->user->updateUser(
                    $id,
                    $requestData['first_name'] ?? null, // Use null for missing fields
                    $requestData['last_name'] ?? null,
                    $requestData['email'] ?? null
                );
            }
    
            if (!empty(array_intersect(array_keys($requestData), ['street_address', 'address_line_2', 'city', 'postal_code', 'phone_number']))) {
                $updateUserDetailsData = true;
                $detailsUpdated = $this->userDetails->updateUserDetails(
                    $id,
                    $requestData['street_address'] ?? null, // Use null for missing fields
                    $requestData['address_line_2'] ?? null,
                    $requestData['city'] ?? null,
                    $requestData['postal_code'] ?? null,
                    $requestData['phone_number'] ?? null
                );
            }
    
            if ($updateUserData || $updateUserDetailsData) {
                // Fetch updated data and return it
                $user = $this->user->getUserById($id);
                $userDetails = $this->userDetails->getUserDetailsByUserId($id);
                $updatedData = array_merge($user, $userDetails ?: []); 
                echo json_encode(['success' => true, 'message' => 'User details updated successfully', 'data' => $updatedData]);
            } else {
                echo json_encode(['error' => 'No fields to update']); // Handle the case where no valid fields are provided
            }
        } catch (Exception $e) {
            error_log("Error updating user details: " . $e->getMessage());
            echo json_encode(['error' => 'Error updating user details']);
        }
    }
    
    
    
    public function deleteUser($id) {
        header('Content-Type: application/json');
        try {
            $affectedRows = $this->user->deleteUser($id);
            if ($affectedRows > 0) {
                echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
            } else {
                echo json_encode(['error' => 'User not found or not deleted']);
            }
        } catch (Exception $e) {
            error_log("Error deleting user: " . $e->getMessage());
            echo json_encode(['error' => 'Error deleting user']);
        }
    }

}


