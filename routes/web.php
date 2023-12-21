<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProductController::class, 'index']);
Route::get('products/show/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('products/purchase', [ProductController::class, 'purchase'])->name('products.purchase');

Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('add.to.cart');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('delete.cart.product')->middleware('web');
Route::patch('/cart/update', [CartController::class, 'update']);
Route::get('/cart', [CartController::class, 'index']);

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
