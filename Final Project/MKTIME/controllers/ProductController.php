<?php
// File: controllers/ProductsController.php

require_once '../connect_db.php';
require_once '../models/Product_Class.php';

class ProductController {
    private $productModel;

    public function __construct() { // No need for $db parameter
        global $link; // Get the MySQLi connection from connect_db.php
        $this->productModel = new Product_Class($link);
    }

    public function displayAllProducts() {
        $products = $this->productModel->getAllProducts();
        include '../views/allproducts.php';
    }

    public function displaySingleProduct($id) {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            http_response_code(404);
            echo "Product not found";
            exit;
        }
        include '../views/singleproduct.php';
    }
}

// Instantiate the controller (no need to pass $db)
$controller = new ProductController();

// Routing Logic (same as before)
$action = $_GET['action'] ?? 'displayAll';

if ($action == 'displayAll') {
    $controller->displayAllProducts();
} elseif ($action == 'displaySingle' && isset($_GET['id'])) {
    $controller->displaySingleProduct((int)$_GET['id']); // Cast to int for security
}
