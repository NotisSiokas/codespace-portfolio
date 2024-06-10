<?php
// File: models/Order_Class.php

class Order_Class {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    // CREATE
    public function createOrder($userId, $total, $orderStatus = 'pending') {
        $orderDate = date('Y-m-d H:i:s'); // Current timestamp for order date
        $stmt = $this->link->prepare("INSERT INTO orders (user_id, total, order_date, order_status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("idss", $userId, $total, $orderDate, $orderStatus);
        $stmt->execute();

        // Check for successful insertion
        if ($stmt->affected_rows > 0) {
            return $stmt->insert_id; // Return the ID of the new order
        } else {
            error_log("Error creating order: " . $stmt->error); // Log the error if any
            return false;
        }
    }

    // READ
    public function getOrdersByUserId($userId) {
        $stmt = $this->link->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Return all orders for the user
    }

    public function getOrderById($orderId) {
        $stmt = $this->link->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return a single order
    }

    // UPDATE
    public function updateOrderStatus($orderId, $newStatus) {
        $stmt = $this->link->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
        $stmt->bind_param("si", $newStatus, $orderId);
        $stmt->execute();
        return $stmt->affected_rows; // Returns the number of rows affected (should be 1)
    }

    // DELETE
    public function deleteOrder($orderId) {
        // Start a transaction to ensure consistency (optional but recommended)
        $this->link->begin_transaction();

        try {
            // 1. Delete from order_details table
            $deleteDetailsStmt = $this->link->prepare("DELETE FROM order_details WHERE order_id = ?");
            $deleteDetailsStmt->bind_param("i", $orderId);
            $deleteDetailsStmt->execute();

            // 2. Delete from orders table
            $deleteOrderStmt = $this->link->prepare("DELETE FROM orders WHERE id = ?");
            $deleteOrderStmt->bind_param("i", $orderId);
            $deleteOrderStmt->execute();

            // Commit transaction if both deletes are successful
            $this->link->commit();
            return true; // Indicate successful deletion
        } catch (Exception $e) {
            $this->link->rollback();
            error_log("Error deleting order: " . $e->getMessage()); // Log the error
            return false; // Indicate failed deletion
        }
    }
}
