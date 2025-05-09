<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'userOrders'])->name('orders.user');
});

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::post('/order', [App\Http\Controllers\OrderController::class, 'store'])->middleware('auth')->name('order.store');

Route::get('/category/{category}', [ProductController::class, 'categoryProducts'])->name('category.products');

// 後台路由群組
Route::prefix('admin')
    ->middleware(['web', 'auth', AdminMiddleware::class])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', AdminProductController::class);
        Route::resource('orders', AdminOrderController::class);
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
    });

require __DIR__.'/auth.php';
