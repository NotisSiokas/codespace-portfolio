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
            default:
                echo json_encode(['error' => 'Invalid POST endpoint']);
        }
        break;

    case 'GET':
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
        break;

    default:
        echo json_encode(['error' => 'Invalid request method']);
}
