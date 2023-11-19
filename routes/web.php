<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

// Page
Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::middleware(['auth', 'second'])->group(function () {

});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin-dashboard',function(){
        return view('admin.index');
    });

    Route::get('/list-category', [CategoryController::class, 'list_category']);
    Route::match(['GET', 'POST'], '/create-category', [CategoryController::class, 'create_category']);
    Route::match(['GET', 'POST'], '/edit-category/{id}', [CategoryController::class, 'edit_category']);
    Route::delete('/delete-category/{id}', [CategoryController::class, 'delete']);
    Route::get('/search', [CategoryController::class, 'search']);

    Route::get('/list-product', [ProductController::class, 'list_product']);
    Route::match(['GET', 'POST'], '/create-product', [ProductController::class, 'create_product']);
    Route::match(['GET', 'POST'], '/edit-product/{id}', [ProductController::class, 'edit_product']);
    Route::delete('/delete-product/{id}', [ProductController::class, 'delete']);
    Route::get('/search', [ProductController::class, 'search']);

    Route::get('/list-brand', [BrandController::class, 'list_brand']);
    Route::match(['GET', 'POST'], '/create-brand', [BrandController::class, 'create_brand']);
    Route::match(['GET', 'POST'], '/edit-brand/{id}', [BrandController::class, 'edit_brand']);
    Route::delete('/delete-brand/{id}', [BrandController::class, 'delete']);
    Route::get('/search', [BrandController::class, 'search']);

    Route::get('/list-order', [OrderController::class, 'list_order']);
    Route::post('/update-status/{id}', [OrderController::class, 'update_status']);
    Route::get('/order-detail/{id}', [OrderController::class, 'order_detail']);


    Route::get('/list-user',[UserController::class,'list_user']);
    Route::post('/update-position/{id}', [UserController::class, 'update_position']);

    Route::get('/list-comment',[CommentController::class,'list_comment']);

});

// Start Order
Route::middleware(['auth'])->group(function () {
    Route::get('/view-cart',[HomeController::class, 'view_cart'])->name('view_cart');
    Route::get('/check-out', [HomeController::class, 'check_out'])->name('check_out');
    Route::get('/my-order', [HomeController::class, 'my_order'])->name('my_order');
    Route::get('/my-order-detail/{id}', [HomeController::class, 'my_order_detail'])->name('my_order_detail');
    Route::get('/cancel-order/{id}',[HomeController::class, 'cancel_order'])->name('cancel_order');
    Route::get('/order-history',[HomeController::class, 'order_history'])->name('order_history');
    Route::post('/place-order',[HomeController::class, 'place_order'])->name('place_order');
    Route::post('/stripe-order/{total}',[HomeController::class, 'stripe_order'])->name('stripe_order');
    Route::get('/destroy-cart/{id}',[HomeController::class, 'destroy_cart'])->name('destroy_cart');
    Route::post('/update-cart',[HomeController::class, 'update_cart'])->name('update_cart');
    Route::post('/comment/{id}',[HomeController::class, 'comment'])->name('comment_product');

});
Route::post('/add-to-cart',[HomeController::class, 'add_cart'])->name('add_cart');
Route::post('/delete-cart',[HomeController::class, 'delete_cart'])->name('delete_cart');

// End Order

Route::get('/product-detail/{id}',[HomeController::class, 'product_detail'])->name('product_detail');

Route::get('/filter-product',[HomeController::class, 'filter_product'])->name('filter_product');
Route::get('/filter-price',[HomeController::class, 'filter_price'])->name('filter_price');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
