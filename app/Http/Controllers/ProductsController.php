<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    function index(){
        $products = $this->getAllProducts();

        return view('products', ['products' => $products]);
    }

    public function getAllProducts(){
        return Product::all();
    }
}
