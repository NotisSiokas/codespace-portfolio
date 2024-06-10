<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'update') {
            // Update cart quantities
            foreach ($_POST['qty'] as $productId => $quantity) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$productId]['quantity'] = $quantity;
                } else {
                    unset($_SESSION['cart'][$productId]); // Remove if quantity is 0
                }
            }
        } elseif (strpos($action, 'remove_') === 0) {
            // Remove item from cart
            $productId = substr($action, 7); // Get product ID from button value
            unset($_SESSION['cart'][$productId]);
        }
    }
}
header('Location: ../views/cart.php'); // Redirect back to the cart after update
exit();
