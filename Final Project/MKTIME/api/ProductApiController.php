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
                echo json_encode(['message' => 'No products found']);
            } else {
                echo json_encode(['products' => $products]);
            }

        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            echo json_encode(['error' => 'Error fetching products. Please try again later.']);
        }
    }

    public function createProduct() {
        header('Content-Type: application/json');

        $requestData = json_decode(file_get_contents('php://input'), true);

        $requiredFields = ['name', 'description', 'price', 'image_url', 'stock'];
        foreach ($requiredFields as $field) {
            if (empty($requestData[$field])) {
                echo json_encode(['error' => 'Missing required field: ' . $field]);
                return;
            }
        }

        if ($requestData['price'] <= 0) {
            echo json_encode(['error' => 'Price must be greater than 0']);
            return;
        }
        if ($requestData['stock'] < 0) {
            echo json_encode(['error' => 'Stock cannot be negative']);
            return;
        }

        try {
            $productId = $this->product->createProduct(
                $requestData['name'],
                $requestData['description'],
                $requestData['price'],
                $requestData['image_url'],
                $requestData['stock']
            );

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

    public function updateProduct() {
        header('Content-Type: application/json');

        $requestData = json_decode(file_get_contents('php://input'), true);

        // Input Validation: Check for required fields
        if (empty($requestData['id'])) {
            echo json_encode(['error' => 'Missing product ID']);
            return;
        }
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
            $affectedRows = $this->product->updateProduct(
                $requestData['id'],
                $requestData['name'],
                $requestData['description'],
                $requestData['price'],
                $requestData['image_url'],
                $requestData['stock']
            );

            if ($affectedRows > 0) {
                echo json_encode(['success' => true, 'message' => 'Product updated successfully']);
            } else {
                echo json_encode(['error' => 'Product update failed']);
            }
        } catch (Exception $e) {
            error_log("Error updating product: " . $e->getMessage());
            echo json_encode(['error' => 'Error updating product']);
        }
    }

    public function deleteProduct($id) {
        header('Content-Type: application/json');
    
        try {
            $existingProduct = $this->product->getProductById($id);
            if (!$existingProduct) {
                echo json_encode(['error' => 'Product not found']);
                return;
            }
    
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

    public function getProduct($id) {
        header('Content-Type: application/json');
    
        try {
            $product = $this->product->getProductById($id);
            if ($product) {
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
            }
        } catch (Exception $e) {
            error_log("Error fetching product: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Error fetching product']);
        }
    }

    // Manage Relationships

    public function getRelatedProducts($id) {
        header('Content-Type: application/json');
    
        try {
            $relatedProducts = $this->product->getRelatedProducts($id);
    
            // Debugging line to confirm correct data
            error_log("Related Products: " . print_r($relatedProducts, true));
    
            if (!empty($relatedProducts)) {
                echo json_encode(['related_products' => $relatedProducts]);
            } else {
                echo json_encode(['message' => 'No related products found']);
            }
        } catch (Exception $e) {
            error_log("Error fetching related products: " . $e->getMessage());
            echo json_encode(['error' => 'Error fetching related products']);
        }
    }
    

    public function addProductRelationship() {
        header('Content-Type: application/json');

        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['product_id']) || empty($requestData['related_product_id'])) {
            echo json_encode(['error' => 'Missing required fields: product_id or related_product_id']);
            return;
        }

        try {
            $affectedRows = $this->product->addProductRelationship(
                $requestData['product_id'],
                $requestData['related_product_id']
            );

            if ($affectedRows > 0) {
                echo json_encode(['success' => true, 'message' => 'Product relationship added successfully']);
            } else {
                echo json_encode(['error' => 'Failed to add product relationship']);
            }
        } catch (Exception $e) {
            error_log("Error adding product relationship: " . $e->getMessage());
            echo json_encode(['error' => 'Error adding product relationship']);
        }
    }

    public function removeProductRelationship() {
        header('Content-Type: application/json');

        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['product_id']) || empty($requestData['related_product_id'])) {
            echo json_encode(['error' => 'Missing required fields: product_id or related_product_id']);
            return;
        }

        try {
            $affectedRows = $this->product->removeProductRelationship(
                $requestData['product_id'],
                $requestData['related_product_id']
            );

            if ($affectedRows > 0) {
                echo json_encode(['success' => true, 'message' => 'Product relationship removed successfully']);
            } else {
                echo json_encode(['error' => 'Failed to remove product relationship']);
            }
        } catch (Exception $e) {
            error_log("Error removing product relationship: " . $e->getMessage());
            echo json_encode(['error' => 'Error removing product relationship']);
        }
    }
}
