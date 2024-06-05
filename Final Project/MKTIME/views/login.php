<?php
include_once 'navbar.php';
include_once 'header.php';
include_once('../functions/login_tools.php');

// Start the session at the beginning (IMPORTANT for handling session data)
start_session_function();

// Display any error messages if present
if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    echo '<p id="err_msg">Oops! There was a problem:<br>';
    foreach ($_SESSION['errors'] as $msg) {
        echo " - $msg<br>";
    }
    echo 'Please try again or <a href="register.php">Register</a></p>';
    unset($_SESSION['errors']); // Clear errors after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center">Login</h2>

    <form action="../functions/login_action.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>

<?php include_once('footer.php'); ?>
