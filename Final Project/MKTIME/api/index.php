<?php
// api/index.php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        switch ($_SERVER['REQUEST_URI']) {
            case '/api/user/register':
                require_once 'UserApiController.php';
                $userApiController = new UserApiController();
                $userApiController->registerAction();
                break;
            case '/api/products':
                require_once 'ProductApiController.php';
                $productApiController = new ProductApiController();
                $productApiController->createProduct();
                break;
            default:
                echo json_encode(['error' => 'Invalid POST endpoint']);
        }
        break;

        case 'GET':
            if (preg_match('/\/api\/users(\/(\d+))?/', $_SERVER['REQUEST_URI'], $matches)) {  // User routes (single or all)
                require_once 'UserApiController.php';
                $userApiController = new UserApiController();
                if (isset($matches[2])) { // User ID exists, get single user
                    $userApiController->getUserById($matches[2]);
                } else { // No ID, get all users
                    $userApiController->getAllUsers();
                }
            } elseif (preg_match('/\/api\/products\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {  // Single product route (API)
                require_once 'ProductApiController.php';
                $productApiController = new ProductApiController();
                $productId = $matches[1];
                $productApiController->getProduct($productId);
            } elseif (preg_match('/\/views\/product\.php\?id=(\d+)/', $_SERVER['REQUEST_URI'], $matches)) { // Single product route (view)
                require_once 'ProductApiController.php';
                $productApiController = new ProductApiController();
                $productId = $matches[1];
                $productApiController->getProduct($productId);
                exit(); // Stop further processing to return only JSON
            } elseif (preg_match('/\/api\/products/', $_SERVER['REQUEST_URI'], $matches)) { // Product route (API)
                require_once 'ProductApiController.php';
                $productApiController = new ProductApiController();
                $productApiController->getAllProducts();
            } else {
                echo json_encode(['error' => 'Invalid GET endpoint']);
            }
            break;
    
    case 'PUT':
        if (preg_match('/\/api\/users\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {  // User update route
            require_once 'UserApiController.php';
            $userApiController = new UserApiController();
            $userId = $matches[1];
            $userApiController->updateUserDetails($userId);
        } else {
            echo json_encode(['error' => 'Invalid PUT endpoint']);
        }
        break;

    case 'DELETE':
        if (preg_match('/\/api\/users\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
            require_once 'UserApiController.php';
            $userApiController = new UserApiController();
            $userId = $matches[1];
            $userApiController->deleteUser($userId);
        } elseif (preg_match('/\/api\/products\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {  // Product delete route
            require_once 'ProductApiController.php';
            $productApiController = new ProductApiController();
            $productId = $matches[1];
            $productApiController->deleteProduct($productId);
        } else {
            echo json_encode(['error' => 'Invalid DELETE endpoint']);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid request method']);
}
