<?php
// File: views/cart.php

// Start session and include necessary files
global $link;
session_start();
include 'head.php';
include 'navbar.php';
include 'header.php';

require '../connect_db.php';
require '../models/Product_Class.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php'); // Redirect to login if not logged in
    exit();
}

// Initialize total and Product Model
$total = 0;
$productModel = new Product_Class($link); // Instantiate outside the loop

?>
<!DOCTYPE html>
<html lang="en">

<body>
<div class="container mt-5">
    <h2 class="fw-bolder mb-4 text-center">Your Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="card mt-3">
            <div class="card-body">
                <form action="update_cart.php" method="post">
                    <table class="table table-bordered">
                        <tbody>
                        <?php foreach ($_SESSION['cart'] as $productId => $item):
                            $product = $productModel->getProductById($productId); // Now use the existing model

                            // Check if product exists
                            if ($product) {
                                $subtotal = $item['quantity'] * $product['price']; // Use the database price
                                $total += $subtotal;
                                ?>
                                <tr>
                                    <td><?= $product['name'] ?></td>
                                    <td>
                                        <input type="number" class="form-control" name="qty[<?= $productId ?>]" value="<?= $item['quantity'] ?>" min="1">
                                    </td>
                                    <td>$<?= $product['price'] ?></td>
                                    <td>$<?= number_format($subtotal, 2) ?></td>
                                    <td>
                                        <button type="submit" class="btn btn-danger" name="action" value="remove_<?= $productId ?>">Remove</button>
                                    </td>
                                </tr>
                            <?php } // End if product exists
                        endforeach; ?>
                        </tbody>
                    </table>

                    <p class="text-right font-weight-bold">Total: $<?= number_format($total, 2) ?></p>

                    <div class="text-center">
                        <button type="submit" name="action" value="update" class="btn btn-primary">Update Cart</button>
                        <a href="../views/checkout.php?total=<?= $total ?>" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <p class="lead text-center">Your cart is empty.</p>
    <?php endif; ?>

</div>
</body>
<?php include 'footer.php'; ?>
</html>
