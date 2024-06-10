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
                    unset($_SESSION['cart'][$productId]);
                }
            }
        } elseif (strpos($action, 'remove_') === 0) {
            // Remove item from cart
            $productId = substr($action, 7);
            unset($_SESSION['cart'][$productId]);
        }
    }
}
header('Location: ../views/cart.php');
exit();
