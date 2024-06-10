<?php
// File: checkout.php
global $link;
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include necessary files
require '../connect_db.php';
require '../models/Product_Class.php';
require '../models/Order_Class.php';
require '../models/OrderDetails_Class.php';
require '../models/User_Class.php';
require '../models/UserDetails_Class.php';
include '../views/head.php';
include '../views/navbar.php';
include '../views/header.php';

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');  // Redirect to cart if empty
    exit();
}

// Get user information
$userModel = new User_Class($link);
$user = $userModel->getUserById($_SESSION['user_id']);

// Get user details
$userDetailsModel = new UserDetails_Class($link);
$userDetails = $userDetailsModel->getUserDetailsByUserId($_SESSION['user_id']);

// Calculate total cost
$productModel = new Product_Class($link);
$total = 0;
foreach ($_SESSION['cart'] as $productId => $item) {
    $product = $productModel->getProductById($productId);
    $total += $item['quantity'] * $product['price'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h2 class="fw-bolder mb-4 text-center">Checkout</h2>

    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Order Summary</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['cart'] as $productId => $item):
                    $product = $productModel->getProductById($productId);
                    $subtotal = $item['quantity'] * $product['price'];
                    ?>
                    <tr>
                        <td><?= $product['name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= $product['price'] ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p class="text-right font-weight-bold">Total: $<?= number_format($total, 2) ?></p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Shipping Information</h3>
            <form action="place_order.php" method="post">
                <input type="hidden" name="total" value="<?= $total ?>">

                <div class="mb-3">
                    <label for="address" class="form-label">Street Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($userDetails['street_address']) ? htmlspecialchars($userDetails['street_address']) : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address2" name="address2" value="<?php echo isset($userDetails['address_line_2']) ? htmlspecialchars($userDetails['address_line_2']) : ''; ?>">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo isset($userDetails['city']) ? htmlspecialchars($userDetails['city']) : ''; ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="<?php echo isset($userDetails['postal_code']) ? htmlspecialchars($userDetails['postal_code']) : ''; ?>" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php include 'footer.php'; ?>
</html>
