<?php
// File: place_order.php

global $link;
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit();
}

// Include necessary files
require '../connect_db.php';
require '../models/Product_Class.php';
require '../models/Order_Class.php';
require '../models/OrderDetails_Class.php';
include '../views/head.php';
include '../views/navbar.php';
include '../views/header.php';

$orderPlaced = false; // Flag to track if order placement is successful

// Check if the form was submitted and the cart is not empty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['cart'])) {
    // Get the total from the form
    $total = $_POST['total'];

    // Create a new order
    $orderModel = new Order_Class($link);
    $orderId = $orderModel->createOrder($_SESSION['user_id'], $total);

    if ($orderId) {
        // Add order details (from the cart)
        $orderDetailsModel = new OrderDetails_Class($link);
        foreach ($_SESSION['cart'] as $productId => $item) {
            $orderDetailsModel->createOrderDetail($orderId, $productId, $_SESSION['user_id'], $item['quantity'], $item['price']);
        }

        // Clear the cart
        unset($_SESSION['cart']);
        $orderPlaced = true; // Order placed successfully

    } else {
        $errorMessage = "Error placing order. Please try again.";
    }
} elseif (empty($_SESSION['cart'])) {
    $errorMessage = "Your cart is empty. Please add items before checking out.";
} else {
    $errorMessage = "Invalid request.";
}
?>


<div class="container mt-5">
    <div class="card">
        <div class="card-body">

            <?php if ($orderPlaced): ?>
                <div class="alert alert-success" role="alert">
                    Your order has been placed successfully!
                </div>
                <a href="../views/allproducts.php" class="btn btn-primary">Continue Shopping</a>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errorMessage ?>
                </div>
                <a href="../views/cart.php" class="btn btn-secondary">Back to Cart</a>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php
// Include footer
include '../views/footer.php';
?>
