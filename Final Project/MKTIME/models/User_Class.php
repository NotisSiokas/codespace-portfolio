<?php
// File: models/User_Class.php

class User_Class {
    private $link; // MySQLi database connection

    public function __construct($db) {
        $this->link = $db;
    }

    // CREATE
    public function createUser($firstName, $lastName, $email, $passwordHash) {
        $stmt = $this->link->prepare("INSERT INTO users (first_name, last_name, email, password_hash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $passwordHash); // Bind parameters
        $stmt->execute();

        return $stmt->insert_id; // Get the ID of the newly inserted user
    }

    // READ
    public function getUserById($userId) {
        $stmt = $this->link->prepare("SELECT * FROM users WHERE id = ?"); // Query the users table
        $stmt->bind_param("i", $userId); // Bind parameter as integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return user details as an associative array
    }


    public function getUserByEmail($email) {
        $stmt = $this->link->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email); // Bind parameter as string
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE
    public function updateUser($id, $firstName, $lastName, $email) {
        $stmt = $this->link->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $firstName, $lastName, $email, $id); // Bind parameters (string, string, string, integer)
        $stmt->execute();
        return $stmt->affected_rows; // Returns the number of rows affected
    }

    // DELETE
    public function deleteUser($id) {
        $stmt = $this->link->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id); // Bind parameter as integer
        $stmt->execute();
        return $stmt->affected_rows; // Returns the number of rows affected
    }
}
