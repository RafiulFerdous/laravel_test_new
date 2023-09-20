<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/registration', [UserController::class, 'registration']);

Route::group([ 'middleware' => ['auth:sanctum', 'admin']], function () {

    Route::prefix('brand')->group(function () {
        Route::post('/addbrand', [BrandController::class, 'create']);
        Route::get('/getallbrand', [BrandController::class, 'index']);

    });

    Route::prefix('category')->group(function () {
        Route::post('/addcategory', [CategoryController::class, 'create']);
        Route::get('/getallcategory', [CategoryController::class, 'index']);

    });

    Route::prefix('product')->group(function () {
        Route::post('/addproduct', [ProductController::class, 'create']);
        Route::get('/getallproducts', [ProductController::class, 'index']);


    });

    Route::prefix('department')->group(function () {
        Route::post('/adddepartment', [DepartmentController::class, 'create']);
        Route::get('/getalldepartment', [DepartmentController::class, 'index']);

//        add new department stock
        Route::put('/addnewdepartment-stock', [DepartmentController::class, 'update']);


    });

    Route::prefix('Invoice')->group(function () {
        Route::post('/generateinvoice', [InvoiceController::class, 'create']);



    });

    Route::post('/logout', [UserController::class, 'logout']);

});
