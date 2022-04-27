<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
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
            Route::get('/',[CategoryController::class,'index'])->name('categoryIndex');
            Route::post('/',[CategoryController::class,'store'])->name('categoryStore');
            Route::post('/update',[CategoryController::class,'update'])->name('categoryUpdate');
            Route::delete('/{category}',[CategoryController::class,'destroy'])->name('categoryDestroy');
        });

        #Product
        Route::prefix('products')->group(function () {
            Route::get('/',[ProductController::class,'index'])->name('productIndex');
//            Route::post('/',[CategoryController::class,'store'])->name('categoryStore');
//            Route::post('/update',[CategoryController::class,'update'])->name('categoryUpdate');
            Route::delete('/{product}',[ProductController::class,'destroy'])->name('productDestroy');
            Route::post('/import/{product}',[ProductController::class,'import'])->name('productImport');
        });

    });
});
