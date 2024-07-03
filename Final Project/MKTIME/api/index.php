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
        if (preg_match('/\/api\/users\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {  
            require_once 'UserApiController.php';
            $userApiController = new UserApiController();
            $userId = $matches[1];
            $userApiController->getUserById($userId);
        } else {
            switch ($_SERVER['REQUEST_URI']) {
                case '/api/users':
                    require_once 'UserApiController.php';
                    $userApiController = new UserApiController();
                    $userApiController->getAllUsers();
                    break;
                case '/api/products':
                    require_once 'ProductApiController.php';
                    $productApiController = new ProductApiController();
                    $productApiController->getAllProducts();
                    break;
                default:
                    echo json_encode(['error' => 'Invalid GET endpoint']);
            }
        }
        break;
    
    case 'PUT':
        if (preg_match('/\/api\/users\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {  
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
            // ... (your existing DELETE logic for users) ...
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
