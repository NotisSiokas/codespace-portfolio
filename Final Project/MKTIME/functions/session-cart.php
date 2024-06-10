<?php

// Start a new session or resume the existing one if necessary
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize the shopping cart in the session if it doesn't already exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Create an empty array for the cart items
}