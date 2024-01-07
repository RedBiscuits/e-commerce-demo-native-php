<?php

namespace App\Controllers;

use App\Core\Controller\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Show all products as a JSON response.
     *
     * @return void
     */
    public function show()
    {
        $products = new Product();
        $this->jsonResponse($products->all());
    }

    /**
     * Create a new product based on the request data.
     *
     * @return void
     */
    public function create()
    {
        // Global request
        $data = $_REQUEST;

        // Get product type and uppercase first letter
        $product = $this->model(ucfirst($data['productType']));
        
        $product->add($data);
    }

    /**
     * Delete products based on the request data.
     *
     * @return void
     */
    public function delete()
    {
        $data = $_REQUEST;
        $product = new Product();
        $product->delete($data);
    }
}
