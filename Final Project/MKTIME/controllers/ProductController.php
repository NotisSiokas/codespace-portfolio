<?php
// File: controllers/ProductsController.php

// Include necessary files
require_once '../connect_db.php'; // Database connection script
require_once '../models/Product_Class.php'; // Product model (presumably handles database interaction)

// Product Controller Class
class ProductController {
    // Private property to store the Product model instance
    private $productModel;

    // Constructor: Initializes the controller and creates a Product model instance
    public function __construct() {
        // Get the database connection established in connect_db.php
        global $link;
        $this->productModel = new Product_Class($link);
    }

    // Action: Display all products
    public function displayAllProducts() {
        // Fetch all products from the model
        $products = $this->productModel->getAllProducts();
        // Include the view to render the product list
        include '../views/allproducts.php';
    }

    // Action: Display a single product
    public function displaySingleProduct($id) {
        // Fetch the product by ID from the model
        $product = $this->productModel->getProductById($id);
        // Handle the case where the product is not found
        if (!$product) {
            // Set the HTTP response code to 404 Not Found
            http_response_code(404);
            echo "Product not found";
            exit; // Stop further execution
        }
        // Include the view to render the single product details
        include '../views/singleproduct.php';
    }
}

// Create an instance of the ProductController
$controller = new ProductController();

// Basic Routing Logic
// Determine the action based on the 'action' parameter in the query string
$action = $_GET['action'] ?? 'displayAll'; // Default to 'displayAll' if not provided

// Execute the appropriate action based on the 'action' parameter
if ($action == 'displayAll') {
    $controller->displayAllProducts();
} elseif ($action == 'displaySingle' && isset($_GET['id'])) {
    // Ensure the 'id' parameter is set and cast it to an integer before passing it to the method
    $controller->displaySingleProduct((int)$_GET['id']);
}
