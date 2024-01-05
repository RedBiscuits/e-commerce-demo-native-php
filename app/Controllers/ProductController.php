<?php

namespace App\Controllers;

use App\Core\Controller\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show()
    {
        $products = new Product();
        $this->view('product-list', $products->all());
    }

    public function add()
    {
        $this->view('product-add');
    }

    public function create()
    {
        // Global request
        $data = $_REQUEST;
        // Get product type and uppercase first letter
        $product = $this->model(ucfirst($data['productType']));
        
        $product->add($data);
        $this->redirect('/');
    }

    public function delete()
    {
        $data = $_REQUEST;
        $product = new Product();
        $product->delete($data);
        $this->redirect('/');
    }
}