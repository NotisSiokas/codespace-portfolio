<?php
// Start or resume the session
global $link;
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include the navbar and header
include_once 'navbar.php';
include_once 'header.php';

// Include necessary files
require_once '../models/User_Class.php';
require_once '../models/UserDetails_Class.php';
require_once '../connect_db.php'; // Include the database connection file

// Initialize User and UserDetails objects
$user = new User_Class($link);
$userDetails = new UserDetails_Class($link);

// Get user details
$userData = $user->getUserById($_SESSION['user_id']);
$userDetailsData = $userDetails->getUserDetailsByUserId($_SESSION['user_id']);

// Fetch user's order history with product names
$orderHistory = [];
$orderHistoryQuery = $link->prepare("
    SELECT orders.id AS order_id, orders.total, orders.order_date, orders.order_status, 
           order_details.product_id, order_details.quantity, products.name AS product_name
    FROM orders
    JOIN order_details ON orders.id = order_details.order_id
    JOIN products ON order_details.product_id = products.id
    WHERE orders.user_id = ?
    ORDER BY orders.order_date DESC
");
$orderHistoryQuery->bind_param("i", $_SESSION['user_id']);
$orderHistoryQuery->execute();
$orderHistoryResult = $orderHistoryQuery->get_result();

if ($orderHistoryResult) {
    while ($order = $orderHistoryResult->fetch_assoc()) {
        $orderHistory[] = $order;
    }
}

// Display user details and user details
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo htmlspecialchars($userData['first_name']); ?>!</h2>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Your Details</h5>
            <p class="card-text">
                <strong>First Name:</strong> <?php echo htmlspecialchars($userData['first_name']); ?><br>
                <strong>Last Name:</strong> <?php echo htmlspecialchars($userData['last_name']); ?><br>
                <strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?><br>
            </p>
            <a href="update_profile.php" class="btn btn-primary">Edit Details</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Your Address Details</h5>
            <p class="card-text">
                <strong>Street Address:</strong> <?php echo isset($userDetailsData['street_address']) ? htmlspecialchars($userDetailsData['street_address']) : 'N/A'; ?><br>
                <strong>Address Line 2:</strong> <?php echo isset($userDetailsData['address_line_2']) ? htmlspecialchars($userDetailsData['address_line_2']) : 'N/A'; ?><br>
                <strong>City:</strong> <?php echo isset($userDetailsData['city']) ? htmlspecialchars($userDetailsData['city']) : 'N/A'; ?><br>
                <strong>Postal Code:</strong> <?php echo isset($userDetailsData['postal_code']) ? htmlspecialchars($userDetailsData['postal_code']) : 'N/A'; ?><br>
                <strong>Phone Number:</strong> <?php echo isset($userDetailsData['phone_number']) ? htmlspecialchars($userDetailsData['phone_number']) : 'N/A'; ?><br>
            </p>
            <a href="update_address_details.php" class="btn btn-primary">Edit Address Details</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Order History</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($orderHistory)): ?>
                        <?php foreach ($orderHistory as $order): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['total']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No order history found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
<?php include_once 'footer.php'; ?>
