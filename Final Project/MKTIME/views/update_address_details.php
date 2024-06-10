<?php
// Start or resume the session
global $link;
session_start();

// Include the navbar and header
include_once 'navbar.php';
include_once 'header.php';

// Include necessary files
require_once '../models/UserDetails_Class.php';
require_once '../connect_db.php';

// Initialize UserDetails object
$userDetails = new UserDetails_Class($link);

// Get user details
$userDetailsData = $userDetails->getUserDetailsByUserId($_SESSION['user_id']);

// Display user details and user details for updating
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Address Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Update Address Details</h2>
    <div class="card mt-3">
        <div class="card-body">
            <form action="../functions/update_address_details_action.php" method="post">
                <div class="mb-3">
                    <label for="street_address" class="form-label">Street Address</label>
                    <input type="text" class="form-control" id="street_address" name="street_address" value="<?php echo isset($userDetailsData['street_address']) ? htmlspecialchars($userDetailsData['street_address']) : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address_line_2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="<?php echo isset($userDetailsData['address_line_2']) ? htmlspecialchars($userDetailsData['address_line_2']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo isset($userDetailsData['city']) ? htmlspecialchars($userDetailsData['city']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo isset($userDetailsData['postal_code']) ? htmlspecialchars($userDetailsData['postal_code']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo isset($userDetailsData['phone_number']) ? htmlspecialchars($userDetailsData['phone_number']) : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
