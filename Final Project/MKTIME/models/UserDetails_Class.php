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
        return $stmt->affected_rows;
    }

    // READ
    public function getUserDetailsByUserId($userId) {
        $stmt = $this->link->prepare("SELECT * FROM user_details WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    // UPDATE
    public function updateUserDetails($userId, $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber) {
        $stmt = $this->link->prepare("UPDATE user_details 
                               SET street_address = ?, address_line_2 = ?, 
                                   city = ?, postal_code = ?, phone_number = ? 
                               WHERE user_id = ?");
        $stmt->bind_param("sssssi", $streetAddress, $addressLine2, $city, $postalCode, $phoneNumber, $userId);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    // DELETE
    public function deleteUserDetails($userId) {
        $stmt = $this->link->prepare("DELETE FROM user_details WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->rowCount();
    }
}
