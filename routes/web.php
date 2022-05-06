<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::group(['middleware' => ['auth']], function () {
    // Route::get("/home", [HomeController::class, "index"])->name("home");
    Route::get("/home", [ProductController::class, "index"])->name("top");
    Route::get("/products/{product}/edit", [ProductController::class, "edit"])->name("edit");
    Route::get("/products/create",[ProductController::class,"create"])->name("create");
    Route::post("/products/store", [ProductController::class, "store"])->name("store");
    Route::patch("/products/{product}", [ProductController::class, "update"])->name("update");
    Route::delete("/products/{product}", [ProductController::class, "destroy"])->name("destroy");
});
