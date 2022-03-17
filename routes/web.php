<?php

use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StoreController::class, "index"])->name("store");
Route::post('/addtocart', [StoreController::class, 'addtocart'])->name('addcart');
Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::post('update-cart', [StoreController::class, 'updatecart'])->name('update.cart');
Route::post('remove-from-cart', [StoreController::class, 'deleteitem'])->name('remove.cart');
Route::post('/subscribe', [StoreController::class, 'subscribe'])->name('subscribe');
Route::post('/success', [store::class, 'success'])->name('success');

Route::get('/dashboard', [Dashboardcontroller::class, "index"])->middleware(['auth'])->name('dashboard');
Route::get('/products', [ProductsController::class, "index"])->middleware(['auth'])->name('products');
Route::get('/products.add', [ProductsController::class, "create"])->middleware(['auth'])->name('products.add');
Route::post('/products.store', [ProductsController::class, "store"])->middleware(['auth'])->name('products.store');

Route::get('/products/edit/{id}', [ProductsController::class, "edit"])->middleware(['auth'])->name('products.edit');
Route::post('/products/update', [ProductsController::class, "update"])->middleware(['auth'])->name('products.update');
Route::post('/products/destroy', [ProductsController::class, "destroy"])->middleware(['auth'])->name('products.destroy');

Route::get('/mailable', function () {
    $cart = session('cart');

    return new App\Mail\OrderShipped($cart);
});

require __DIR__.'/auth.php';
