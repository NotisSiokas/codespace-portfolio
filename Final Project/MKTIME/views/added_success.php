<?php
// File: views/added_success.php

include '../views/head.php';
include '../views/navbar.php';
include '../views/header.php';

// Get the product name from the URL parameter
$product_name = $_GET['product_name'] ?? '';

?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                <p>A <?php echo htmlspecialchars($product_name); ?> has been added to your cart</p>
                <a href="../views/allproducts.php" class="btn btn-primary">Continue Shopping</a> |
                <a href="../views/cart.php" class="btn btn-secondary">View Your Cart</a>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>
