<?php
// File: models/Product.php

class Product_Class {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function createProduct($name, $description, $price, $imageUrl, $stock) {
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, image_url, stock) VALUES (:name, :description, :price, :image_url, :stock)");
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl,
            ':stock' => $stock
        ]);
        return $this->db->lastInsertId(); // Return the ID of the newly created product
    }

    // READ
    public function getAllProducts() {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function updateProduct($id, $name, $description, $price, $imageUrl, $stock) {
        $stmt = $this->db->prepare("UPDATE products SET name = :name, description = :description, price = :price, image_url = :image_url, stock = :stock WHERE id = :id");
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl,
            ':stock' => $stock,
            ':id' => $id
        ]);
        return $stmt->rowCount(); // Returns the number of rows affected (should be 1)
    }

    // DELETE
    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount(); // Returns the number of rows affected (should be 1)
    }
}
