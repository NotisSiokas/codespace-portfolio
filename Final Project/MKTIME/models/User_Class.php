<?php
// File: models/User_Class.php

class User_Class {
    private $link;

    public function __construct($db) {
        $this->link = $db;
    }

    // CREATE
    public function createUser($firstName, $lastName, $email, $passwordHash) {
        $stmt = $this->link->prepare("INSERT INTO users (first_name, last_name, email, password_hash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $passwordHash);
        $stmt->execute();

        return $stmt->insert_id;
    }

    // READ
    public function getUserById($userId) {
        $stmt = $this->link->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public function getUserByEmail($email) {
        $stmt = $this->link->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE
    public function updateUser($id, $firstName, $lastName, $email) {
        $stmt = $this->link->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $firstName, $lastName, $email, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    // DELETE
    public function deleteUser($id) {
        $stmt = $this->link->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}
