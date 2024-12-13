<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    //
    function index()
    {
        if(Auth::check()){
            $products = $this->getAllProducts();
            return view('products', ['products' => $products]);
        }


    }

    public function getAllProducts()
    {

        return Product::getUserProducts(Auth::user()->id);
    }

    public function storeProduct(Request $request)
    {

        try {
            if ($request->search != "") {
                $response = Product::getApiProduct($request->search);

                $data = $response->json();
                
                if($data['status'] == 0) throw new Exception('El producto no existe o el código de barras que has introducido es incorrecto.');
                
                $datos = Product::generateProductArray($data);

                $products = Product::getProductByCode($datos['user_product_code']);
                
                if ($products->count() == 0) {
                    Product::create($datos);
                    return Redirect::route('products')->with('product_add', 'added');
                } else throw new Exception('Producto ya existe');
            }
            else throw new Exception('Input vacío', 701);
        } catch (Exception $e) {
            return Redirect::route('products')->with('error', $e->getMessage());;
        }
    }

    public function showProduct(Request $request){
        $id = $request->route('id');
        $product = Product::getUserProductById($id);

        return view('product-info', ['product' => $product]);
    }
}
