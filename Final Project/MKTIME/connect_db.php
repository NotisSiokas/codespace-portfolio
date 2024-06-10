<?php
// File: connect_db.php

// Database Configuration
$dbHost = 'localhost:2306';
$dbUser = 'root';
$dbPass = '';
$dbName = 'mktime_db';

// Creating MySQLi connection
$link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Checking connection
if (!$link) {
    error_log("Connection failed: " . mysqli_connect_error());
    die("Error connecting to database. Please try again later.");
}

mysqli_set_charset($link, "utf8");
