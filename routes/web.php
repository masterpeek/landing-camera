<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('portfolio/{portfolio:slug}', [HomeController::class, 'portfolio']);
Route::get('category/{category:slug}', [HomeController::class, 'category']);
Route::get('product/{product:slug}', [HomeController::class, 'product']);

Route::get('login', [AuthController::class, 'showLogin']);
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister']);
Route::post('register', [AuthController::class, 'register']);

Route::get('image/show/{image:slug}', [ImageController::class, 'show']);

Route::group(['prefix' => 'admin', 'middleware' => 'adminAuth'], function () {
    Route::get('index', [AdminController::class, 'index']);
    Route::get('dashboard',  [AdminController::class, 'index']);

    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/create', [ProductController::class, 'create']);
    Route::post('product', [ProductController::class, 'store']);
    Route::get('product/{product:slug}', [ProductController::class, 'show']);
    Route::get('product/{product:slug}/edit', [ProductController::class, 'edit']);
    Route::put('product/{product:slug}', [ProductController::class, 'update']);
    Route::delete('product/{product:slug}', [ProductController::class, 'destroy']);

    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/create', [CategoryController::class, 'create']);
    Route::post('category', [CategoryController::class, 'store']);
    Route::get('category/{category:slug}', [CategoryController::class, 'show']);
    Route::get('category/{category:slug}/edit', [CategoryController::class, 'edit']);
    Route::put('category/{category:slug}', [CategoryController::class, 'update']);
    Route::delete('category/{category:slug}', [CategoryController::class, 'destroy']);

    Route::get('portfolio', [PortfolioController::class, 'index']);
    Route::get('portfolio/create', [PortfolioController::class, 'create']);
    Route::post('portfolio', [PortfolioController::class, 'store']);
    Route::get('portfolio/{portfolio:slug}', [PortfolioController::class, 'show']);
    Route::get('portfolio/{portfolio:slug}/edit', [PortfolioController::class, 'edit']);
    Route::put('portfolio/{portfolio:slug}', [PortfolioController::class, 'update']);
    Route::delete('portfolio/{portfolio:slug}', [PortfolioController::class, 'destroy']);
    Route::delete('portfolio/{portfolio:slug}/image', [PortfolioController::class, 'destroyImage']);

    Route::get('logout', [AuthController::class, 'adminLogout']);
});
