<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SlideshowController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [HomepageController::class, "index"]);
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [DashboardController::class, "index"]);
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
    Route::get('image', [ImageController::class, "index"]);
    Route::post('image', [ImageController::class, "store"]);
    Route::delete('image/{id}', [ImageController::class, "destroy"]);
    Route::post('imagekategori', [KategoriController::class, "uploadimage"]);
    Route::delete('imagekategori/{id}', [KategoriController::class, "deleteimage"]);
    Route::post('produkimage', [ProdukController::class, "uploadimage"]);
    Route::delete('produkimage/{id}', [ProdukController::class, "deleteimage"]);
    Route::resource('slideshow', SlideshowController::class);
  });
  