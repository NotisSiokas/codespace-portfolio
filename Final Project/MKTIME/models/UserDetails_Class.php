<?php
// File: models/UserDetails.php

class UserDetails_Class {
    private $link;

    public function __construct($db) {
        $this->link = $db;
    }

    // CREATE

    public function createUserDetails($userId, $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber) {
        $stmt = $this->link->prepare("INSERT INTO user_details (user_id, street_address, address_line_2, city, postal_code, phone_number) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $userId, $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber);
        $stmt->execute();
        return $stmt->affected_rows; // Returns 1 if successful
    }

    // READ
    public function getUserDetailsByUserId($userId) {
        $stmt = $this->link->prepare("SELECT * FROM user_details WHERE user_id = ?");
        $stmt->bind_param("i", $userId); // "i" indicates integer type
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return user details as an associative array
    }


    // UPDATE
    public function updateUserDetails($userId, $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber) {
        $stmt = $this->link->prepare("UPDATE user_details 
                               SET street_address = ?, address_line_2 = ?, 
                                   city = ?, postal_code = ?, phone_number = ? 
                               WHERE user_id = ?");
        $stmt->bind_param("sssssi", $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber, $userId);
        $stmt->execute();

        return $stmt->affected_rows; // Returns the number of rows affected (should be 1)
    }

    // DELETE (rarely needed since it's linked to the user)
    public function deleteUserDetails($userId) {
        $stmt = $this->link->prepare("DELETE FROM user_details WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->rowCount(); // Returns the number of rows affected (should be 1)
    }
}
