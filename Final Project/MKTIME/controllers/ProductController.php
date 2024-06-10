<?php
// File: controllers/ProductsController.php

require_once '../connect_db.php';
require_once '../models/Product_Class.php';

class ProductController {
    private $productModel;

    public function __construct() {
        global $link;
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

// Instantiate the controller
$controller = new ProductController();

// Routing Logic
$action = $_GET['action'] ?? 'displayAll';

if ($action == 'displayAll') {
    $controller->displayAllProducts();
} elseif ($action == 'displaySingle' && isset($_GET['id'])) {
    $controller->displaySingleProduct((int)$_GET['id']);
}
