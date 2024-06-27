<?php
require_once '../models/Product_Class.php';
require_once '../connect_db.php';

class ProductApiController {
    private $product;

    public function __construct() {
        global $link;
        $this->product = new Product_Class($link);
    }

    public function getAllProducts() {
        header('Content-Type: application/json');

        try {
            $products = $this->product->getAllProducts();

            if (empty($products)) {
                echo json_encode(['message' => 'No products found']); // Handle the case where no products exist
            } else {
                echo json_encode(['products' => $products]);
            }

        } catch (Exception $e) {
            // Log the error for debugging
            error_log("Error fetching products: " . $e->getMessage()); 

            // Send a user-friendly error message
            echo json_encode(['error' => 'Error fetching products. Please try again later.']);
        }
    }

    // Add methods for createProduct, updateProduct, and deleteProduct as needed
}
