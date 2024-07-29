<?php
// File: models/Product_Class.php

class Product_Class {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    // CREATE
    public function createProduct($name, $description, $price, $imageUrl, $stock) {
        $stmt = $this->link->prepare("INSERT INTO products (name, description, price, image_url, stock) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsi", $name, $description, $price, $imageUrl, $stock);
        $stmt->execute();

        return $stmt->insert_id;
    }

    // READ
    public function getAllProducts() {
        $stmt = $this->link->prepare("SELECT * FROM products"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }        
        return $products;
    }

    public function getProductById($id) {
        $stmt = $this->link->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE
    public function updateProduct($id, $name, $description, $price, $imageUrl, $stock) {
        $stmt = $this->link->prepare("UPDATE products SET name = ?, description = ?, price = ?, image_url = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("ssdssi", $name, $description, $price, $imageUrl, $stock, $id); // Bind parameters
        $stmt->execute();
        return $stmt->affected_rows;
    }

    // DELETE
    public function deleteProduct($id) {
        $stmt = $this->link->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    // Manage Relationships

    public function getRelatedProducts($id) {
        $stmt = $this->link->prepare("
            SELECT p.* 
            FROM product_relationships pr
            JOIN products p ON pr.related_product_id = p.id
            WHERE pr.product_id = ?
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $relatedProducts = [];
        while ($row = $result->fetch_assoc()) {
            $relatedProducts[] = $row;
        }        
        return $relatedProducts;
    }    

    public function addProductRelationship($productId, $relatedProductId) {
        $stmt = $this->link->prepare("INSERT INTO product_relationships (product_id, related_product_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $productId, $relatedProductId);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function removeProductRelationship($productId, $relatedProductId) {
        $stmt = $this->link->prepare("DELETE FROM product_relationships WHERE product_id = ? AND related_product_id = ?");
        $stmt->bind_param("ii", $productId, $relatedProductId);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}
