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

        return Product::where('user_id', Auth::user()->id)->get();
    }

    public function storeProduct(Request $request)
    {

        try {
            if ($request->search != "") {
                $response = Http::get('https://es.openfoodfacts.org/api/v2/product/' . $request->search);
                $data = $response->json();

                $imageUrl = substr($data['product']['image_url'], strpos($data['product']['image_url'], 'products') + strlen('products') + 1);
                if(isset($data['product']['product_name_es'])){
                    $name = $data['product']['product_name_es'];
                }
                else if($data['product']['product_name_en']){
                    $name = $data['product']['product_name_en'];
                }
                if (isset($data['product']['categories_imported'])) {
                    $category = $data['product']['categories_imported'];
                } else $category = '';
                if (isset($data['product']['stores'])) {
                    $stores = $data['product']['stores'];
                } else $stores = '';
                $datos = [
                    'user_product_code' => $data['product']['id'],
                    'user_product_name' => $name,
                    'user_product_brand' => $data['product']['brands'],
                    'user_product_category' => $category,
                    'user_product_store_location' => $stores,
                    'user_product_nutri_score' => $data['product']['nutriscore_grade'],
                    'user_product_image' => $imageUrl,
                ];
                $user = Auth::user();

                $products = Product::where('user_product_code', $datos['user_product_code']);
                $datos['user_id'] = $user->id;

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
        $product = Product::find($id);

        return view('product-info', ['product' => $product]);
    }
}
