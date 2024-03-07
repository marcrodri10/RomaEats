<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DishController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserDishController;
use App\Http\Controllers\OrderDishController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/dishes', [DishController::class, 'index'])->name('dishes');
Route::get('/dish/{id}', [DishController::class, 'showDish'])->name('dishes.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipe.index');
    Route::post('/save-recipe', [RecipeController::class, 'saveRecipe'])->name('recipe.save');
    Route::get('/recipe/{id}', [RecipeController::class, 'showRecipe'])->name('recipe.show');
    Route::get('/mydishes', [UserDishController::class, 'index'])->name('mydishes.index');
    Route::post('/save-dish', [UserDishController::class, 'saveUserDish'])->name('mydishes.save');
    Route::get('/mydish/{id}', [UserDishController::class, 'showUserDish'])->name('mydishes.show');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/save-product', [ProductController::class, 'storeProduct'])->name('save.product');
    Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('product.show');
    Route::get('/getProducts', [ProductController::class, 'getAllProducts'])->name('product.getAll');
    Route::post('/addOrder', [OrderDishController::class, 'addOrder'])->name('order.add');
    Route::get('/order', [OrderDishController::class, 'index'])->name('order.index');
    Route::get('/order/{id}', [OrderController::class, 'showOrder'])->name('order.show');
    Route::post('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/myorders', [OrderController::class, 'index'])->name('myorders.index');

});

Route::middleware(['auth', 'employee',])->group(function(){
    Route::get('/orders', [OrderController::class, 'orders'])->name('employee.orders');
    Route::get('/allOrderAddress', [OrderController::class, 'getAllOrderAddress'])->name('employee.orders.getAllOrderAddress');
    Route::post('/route/{id}', [OrderController::class, 'showOrderMap'])->name('employee.orders.showOrderMap');
    Route::get('/order/deliveryRoute', [OrderController::class, 'showDeliveryRoute'])->name('employee.orders.deliveryRoute');
});

require __DIR__.'/auth.php';
