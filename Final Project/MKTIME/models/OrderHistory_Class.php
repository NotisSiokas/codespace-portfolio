<?php
// File: models/OrderHistory_Class.php

class OrderHistory_Class {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    // CREATE
    public function createOrderHistoryEntry($orderId, $userId, $total) {
        $orderDate = date('Y-m-d H:i:s');
        $stmt = $this->link->prepare("INSERT INTO order_history (order_id, user_id, total, order_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iids", $orderId, $userId, $total, $orderDate);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // READ
    public function getOrderHistoryByUserId($userId) {
        $stmt = $this->link->prepare("SELECT * FROM order_history WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrderHistoryByOrderId($orderId) {
        $stmt = $this->link->prepare("SELECT * FROM order_history WHERE order_id = ?");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
