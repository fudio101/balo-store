<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
//Admin login
Route::get('/admin/login', [AdminController::class, 'loginIndex'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login']);

//Admin
Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout');

    Route::get('/', [AdminController::class, 'index']);

    Route::prefix('admin')->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('main', [AdminController::class, 'index']);

        #Category
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categoryIndex');
            Route::post('/', [CategoryController::class, 'store'])->name('categoryStore');
            Route::post('/update', [CategoryController::class, 'update'])->name('categoryUpdate');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categoryDestroy');
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('productIndex');
            Route::get('/create', [ProductController::class, 'create'])->name('productCreate');
            Route::post('/store', [ProductController::class, 'store'])->name('productStore');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('productEdit');
            Route::post('/update/{product}', [ProductController::class, 'update'])->name('productUpdate');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('productDestroy');
            Route::post('/import/{product}', [ProductController::class, 'import'])->name('productImport');
        });

        #Product
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('orderIndex');
//            Route::get('/create', [ProductController::class, 'create'])->name('productCreate');
//            Route::post('/store', [ProductController::class, 'store'])->name('productStore');
//            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('productEdit');
//            Route::post('/update/{product}', [ProductController::class, 'update'])->name('productUpdate');
//            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('productDestroy');
//            Route::post('/import/{product}', [ProductController::class, 'import'])->name('productImport');
        });

        #Discount
        Route::prefix('discounts')->group(function () {
            Route::get('/', [DiscountController::class, 'index'])->name('discountIndex');
            Route::get('/create', [DiscountController::class, 'create'])->name('discountCreate');
            Route::post('/store', [DiscountController::class, 'store'])->name('discountStore');
            Route::get('/edit/{discount}', [DiscountController::class, 'edit'])->name('discountEdit');
            Route::post('/update/{discount}', [DiscountController::class, 'update'])->name('discountUpdate');
            Route::delete('/{discount}', [DiscountController::class, 'destroy'])->name('discountDestroy');
        });

        #User
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('userIndex');
            Route::get('/create', [UserController::class, 'create'])->name('userCreate');
            Route::post('/store', [UserController::class, 'store'])->name('userStore');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('userDestroy');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('userEdit');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('userUpdate');
        });

    });
});
