<?php
// File: models/UserDetails.php

class UserDetails_Class {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function createUserDetails($userId, $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber) {
        $stmt = $this->db->prepare("INSERT INTO user_details (user_id, street_address, address_line_2, city, postal_code, phone_number) VALUES (:user_id, :street_address, :address_line_2, :city, :postal_code, :phone_number)");
        $stmt->execute([
            ':user_id' => $userId,
            ':street_address' => $streetAddress,
            ':address_line_2' => $addressLine2,
            ':city' => $city,
            ':postal_code' => $postalCode,
            ':phone_number' => $phoneNumber
        ]);
        return $stmt->rowCount(); // Returns 1 if successful
    }

    // READ
    public function getUserDetailsByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM user_details WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return user details as an associative array
    }

    // UPDATE
    public function updateUserDetails($userId, $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber) {
        $stmt = $this->db->prepare("UPDATE user_details 
                                   SET street_address = :street_address, address_line_2 = :address_line_2, 
                                       city = :city, postal_code = :postal_code, phone_number = :phone_number 
                                   WHERE user_id = :user_id");
        $stmt->execute([
            ':user_id' => $userId,
            ':street_address' => $streetAddress,
            ':address_line_2' => $addressLine2,
            ':city' => $city,
            ':postal_code' => $postalCode,
            ':phone_number' => $phoneNumber
        ]);

        return $stmt->rowCount(); // Returns the number of rows affected (should be 1)
    }

    // DELETE (rarely needed since it's linked to the user)
    public function deleteUserDetails($userId) {
        $stmt = $this->db->prepare("DELETE FROM user_details WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->rowCount(); // Returns the number of rows affected (should be 1)
    }
}
