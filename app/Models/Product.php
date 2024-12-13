<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_product_id';

    protected $table = 'user_products';
    protected $fillable = [
        'user_product_code',
        'user_product_name',
        'user_product_brand',
        'user_product_category',
        'user_product_store_location',
        'user_product_nutri_score',
        'user_product_image',
        'user_id',
        'user_product_price'
    ];

    public static function getUserProducts($id)
    {
        return Product::where('user_id', $id)->get();
    }
    public static function getUserProductById($id){
        return self::find($id);
    }

    public static function getApiProduct($search)
    {
        return Http::get('https://es.openfoodfacts.org/api/v2/product/' . $search);
    }
    public static function generateProductArray($data)
    {
        $imageUrl = substr($data['product']['image_url'], strpos($data['product']['image_url'], 'products') + strlen('products') + 1);
        $price = rand(100, 400) / 100;
        if (isset($data['product']['product_name_es'])) {
            $name = $data['product']['product_name_es'];
        } else if ($data['product']['product_name_en']) {
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
            'user_product_price' => $price,
        ];
        $userId = Auth::user()->id;
        $datos['user_id'] = $userId;

        return $datos;
    }
    public static function getProductByCode($code){
        return Product::where('user_product_code', $code);
    }
}
