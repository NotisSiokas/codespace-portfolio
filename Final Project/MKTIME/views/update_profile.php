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

// Display user details and user details for updating
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo htmlspecialchars($userData['first_name']); ?>!</h2>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Update Your Details</h5>
            <form action="../functions/update_profile_action.php" method="post">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($userData['first_name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($userData['last_name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                </div>
                <!-- Add more fields for user details here if needed -->
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
</body>
<?php include_once 'footer.php'; ?>
