<?php
// File: connect_db.php

// Database Configuration (Replace with your actual credentials)
$dbHost = 'localhost:2306';     // Or your database server address
$dbUser = 'root';         // Your MySQL username
$dbPass = '';             // Your MySQL password (likely empty if using XAMPP/MAMP)
$dbName = 'mktime_db';     // Your database name

// Create a MySQLi connection (use 'mysql' for MySQL)
$link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName); // Use $link for consistency

// Check connection
if (!$link) {
    error_log("Connection failed: " . mysqli_connect_error()); // Log the error
    die("Error connecting to database. Please try again later."); // Generic message for user
}

// Optional: Set character encoding for UTF-8 support
mysqli_set_charset($link, "utf8"); // Use $link
