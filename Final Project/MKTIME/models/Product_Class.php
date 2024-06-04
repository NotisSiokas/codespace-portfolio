<?php
// File: models/Product_Class.php

class Product_Class {
    private $link; // MySQLi database connection

    public function __construct($link) {
        $this->link = $link;
    }

    // CREATE
    public function createProduct($name, $description, $price, $imageUrl, $stock) {
        $stmt = $this->link->prepare("INSERT INTO products (name, description, price, image_url, stock) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsi", $name, $description, $price, $imageUrl, $stock);  // Bind parameters
        $stmt->execute();

        return $stmt->insert_id; // Get the ID of the newly created product
    }

    // READ
    public function getAllProducts() {
        $result = $this->link->query("SELECT * FROM products");

        if (!$result) {
            error_log("Error in getAllProducts: " . mysqli_error($this->link));
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->link->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id); // Bind parameter as integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE
    public function updateProduct($id, $name, $description, $price, $imageUrl, $stock) {
        $stmt = $this->link->prepare("UPDATE products SET name = ?, description = ?, price = ?, image_url = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("ssdssi", $name, $description, $price, $imageUrl, $stock, $id); // Bind parameters
        $stmt->execute();
        return $stmt->affected_rows; // Returns the number of rows affected
    }

    // DELETE
    public function deleteProduct($id) {
        $stmt = $this->link->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id); // Bind parameter as integer
        $stmt->execute();
        return $stmt->affected_rows; // Returns the number of rows affected
    }
}
