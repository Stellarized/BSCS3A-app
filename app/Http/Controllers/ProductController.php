<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\TaskService;

class productController extends Controller
{
    public function __construct(
        //dependency Injection
        protected TaskService $taskService
    ){}

    //Display a listing of the resource

    public function index(ProductService $productService)
    {
        $newProduct = [
            'id' => 4,
            'name' => 'Orange',
            'category' => 'fruit'
        ];
        $productService->insert($newProduct);
        $this->taskService->add("Add to cart");
        $this->taskService->add("Checkout");

        $data = [
            'products' => $productService->listProducts(),
            'tasks' => $this->taskService->getALLtasks()
        ];

        return view('products.index',$data);
    }

    public function show(ProductService $productService, string $id)
    {
        $product = collect($productService->listProducts())->filter(function($item) use ($id){
        return $item['id'] == $id;
    })->first();

    return $product;
}
}