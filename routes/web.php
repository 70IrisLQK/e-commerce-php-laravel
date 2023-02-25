<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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
//User
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

// Home category
Route::get('/category/{categoryId}', [CategoryController::class, 'showCategoryHome']);
Route::get('/brand/{brandId}', [BrandController::class, 'showBrandHome']);
Route::get('/product/{productId}', [ProductController::class, 'productDetail']);

// Admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'showDashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//Category
Route::get('/categories', [CategoryController::class, 'listCategories']);
Route::get('/add-category', [CategoryController::class, 'createCategory']);
Route::get('/update-category/{categoryId}', [CategoryController::class, 'updateCategory']);
Route::get('/delete-category/{categoryId}', [CategoryController::class, 'deleteCategory']);

Route::get('/active-category/{categoryId}', [CategoryController::class, 'activeCategory']);
Route::get('/inactive-category/{categoryId}', [CategoryController::class, 'inactiveCategory']);

Route::post('/save-category', [CategoryController::class, 'saveCategory']);
Route::post('/edit-category/{categoryId}', [CategoryController::class, 'editCategory']);

//Brand
Route::get('/brands', [BrandController::class, 'listBrand']);
Route::get('/add-brand', [BrandController::class, 'addBrand']);

Route::get('/inactive-brand/{brandId}', [BrandController::class, 'inactiveBrand']);
Route::get('/active-brand/{brandId}', [BrandController::class, 'activeBrand']);

Route::get('/delete-brand/{brandId}', [BrandController::class, 'deleteBrand']);
Route::get('/update-brand/{brandId}', [BrandController::class, 'updateBrand']);

Route::post('/edit-brand/{brandId}', [BrandController::class, 'editBrand']);
Route::post('/save-brand', [BrandController::class, 'saveBrand']);

//Product
Route::get('/products', [ProductController::class, 'listProduct']);
Route::get('/add-product', [ProductController::class, 'createProduct']);

Route::get('/active-product/{productId}', [ProductController::class, 'activeProduct']);
Route::get('/inactive-product/{productId}', [ProductController::class, 'inactiveProduct']);
Route::get('/update-product/{productId}', [ProductController::class, 'updateProduct']);

Route::get('/delete-product/{productId}', [ProductController::class, 'deleteProduct']);

Route::post('/save-product', [ProductController::class, 'saveProduct']);
Route::post('/edit-product/{productId}', [ProductController::class, 'editProduct']);

//Save cart
Route::get('/show-cart', [CartController::class, 'showCart']);
Route::post('/save-cart', [CartController::class, 'saveCart']);