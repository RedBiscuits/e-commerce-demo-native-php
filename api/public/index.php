<?php

// Import necessary classes
use App\Controllers\ProductController;
use App\Core\Request\Request;
use App\Core\Router\Router;

// Include autoloader and application configuration
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/app.php';

// Define the application root directory
define('APP_ROOT', dirname(__DIR__));

// Instantiate the router with a new request
$router = new Router(new Request());

// Define routes
$router->get('/', [ProductController::class, 'show']);          // Route for showing products
$router->post('/delete-products', [ProductController::class, 'delete']);  // Route for deleting products

$router->post('/add-product', [ProductController::class, 'create']);      // Route for adding a new product

// Execute the router to handle the incoming request
$router->go();
