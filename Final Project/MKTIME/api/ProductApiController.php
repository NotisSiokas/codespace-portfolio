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

    public function createProduct() {
        header('Content-Type: application/json');

        $requestData = json_decode(file_get_contents('php://input'), true);

        // Input Validation: Check for required fields
        $requiredFields = ['name', 'description', 'price', 'image_url', 'stock'];
        foreach ($requiredFields as $field) {
            if (empty($requestData[$field])) {
                echo json_encode(['error' => 'Missing required field: ' . $field]);
                return;
            }
        }

        // Additional validation (optional)
        if ($requestData['price'] <= 0) {
            echo json_encode(['error' => 'Price must be greater than 0']);
            return;
        }
        if ($requestData['stock'] < 0) {
            echo json_encode(['error' => 'Stock cannot be negative']);
            return;
        }

        try {
            // Create the product using your Product_Class model
            $productId = $this->product->createProduct(
                $requestData['name'],
                $requestData['description'],
                $requestData['price'],
                $requestData['image_url'],
                $requestData['stock']
            );

            // Check if product creation was successful
            if ($productId) {
                echo json_encode(['success' => true, 'message' => 'Product created successfully', 'product_id' => $productId]);
            } else {
                echo json_encode(['error' => 'Product creation failed']);
            }
        } catch (Exception $e) {
            error_log("Error creating product: " . $e->getMessage());
            echo json_encode(['error' => 'Error creating product']);
        }
    }

    //  methods for , updateProduct, and deleteProduct to be added

    public function deleteProduct($id) {
        header('Content-Type: application/json');
    
        try {
            // Check if the product exists
            $existingProduct = $this->product->getProductById($id);
            if (!$existingProduct) {
                echo json_encode(['error' => 'Product not found']);
                return;
            }
    
            // Delete the product
            $affectedRows = $this->product->deleteProduct($id);
    
            if ($affectedRows > 0) {
                echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
            } else {
                echo json_encode(['error' => 'Product deletion failed']);
            }
        } catch (Exception $e) {
            error_log("Error deleting product: " . $e->getMessage());
            echo json_encode(['error' => 'Error deleting product']);
        }
    }
}
