<?php
// home.php


include 'head.php';
include 'navbar.php';
include 'header.php';

// Checking if an API request
if (strpos($_SERVER['REQUEST_URI'], '/api/') !== false) { 
    //  API requests
    require_once '../api/index.php';
    exit(); 
} else {
    // ...  main  content  here ...
}

include 'footer.php';
?>
