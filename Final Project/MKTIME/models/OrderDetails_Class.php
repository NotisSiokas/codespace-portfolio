<?php

// File: models/OrderDetails_Class.php

class OrderDetails_Class
{
    private $link;

    public function __construct($link)
    {
        $this->link = $link;
    }

    // CREATE
    public function createOrderDetail($orderId, $productId, $userId, $quantity, $price)
    {
        $stmt = $this->link->prepare("INSERT INTO order_details (order_id, product_id, user_id, quantity, price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiid", $orderId, $productId, $userId, $quantity, $price);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // READ
    public function getOrderDetailsByOrderId($orderId)
    {
        $stmt = $this->link->prepare("SELECT * FROM order_details WHERE order_id = ?");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function getOrderDetailById($orderDetailId)
    {
        $stmt = $this->link->prepare("SELECT * FROM order_details WHERE id = ?");
        $stmt->bind_param("i", $orderDetailId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE
    public function updateOrderDetail($orderDetailId, $quantity, $price)
    {
        $stmt = $this->link->prepare("UPDATE order_details SET quantity = ?, price = ? WHERE id = ?");
        $stmt->bind_param("idi", $quantity, $price, $orderDetailId);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    // DELETE
    public function deleteOrderDetail($orderDetailId)
    {
        $stmt = $this->link->prepare("DELETE FROM order_details WHERE id = ?");
        $stmt->bind_param("i", $orderDetailId);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}
