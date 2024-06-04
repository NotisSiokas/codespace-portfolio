<?php
require_once '../connect_db.php';
require_once '../models/Product_Class.php';

class ProductController {
    private $productModel;

    public function __construct($db) {
        $this->productModel = new Product_Class($db);
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
$db = new PDO('mysql:host=localhost:2306;dbname=mktime_db', 'root', ''); // Adjust the connection parameters
$controller = new ProductController($db);

// Routing Logic
$action = $_GET['action'] ?? 'displayAll';

if ($action == 'displayAll') {
    $controller->displayAllProducts(); // Call the method on the controller object
} elseif ($action == 'displaySingle' && isset($_GET['id'])) {
    $controller->displaySingleProduct((int)$_GET['id']);
}