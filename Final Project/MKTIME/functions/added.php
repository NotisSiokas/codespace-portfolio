<?php
// File: functions/added.php

global $link;
session_start();
include 'session-cart.php';
require '../connect_db.php';
require '../models/Product_Class.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch product information
    $q = "SELECT * FROM products WHERE id = $id";
    $r = mysqli_query($link, $q);

    if (mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

        // Checking if cart already contains this product id
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            // Add product to the session cart
            $_SESSION['cart'][$id] = array(
                'quantity' => 1,
                'price' => $row['price'],
                'name' => $row['name']
            );
        }

        // Redirect to the success page with the product name
        header("Location: ../views/added_success.php?product_name=".urlencode($row['name']));
        exit();
    } else {
        // Handle case where product was not found
        echo "Product not found.";
    }

}

// Close the database connection
mysqli_close($link);
?>
