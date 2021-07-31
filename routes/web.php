<?php

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationAreasController;

// home page
Route::get('/', [HomeController::class, 'get_home_page'])->name("home_page");
Route::get('/home', [HomeController::class, 'get_home_page']);
Route::get('/index', [HomeController::class, 'get_home_page']);

// locations
Route::prefix('/locations')->name('locations.')->group(function () {
    // areas
    Route::prefix('/areas')->name('areas.')->group(function () {
        Route::get('/', [LocationAreasController::class, 'show'])->name('show');
        Route::post('/add', [LocationAreasController::class, 'add'])->name('add');
        Route::post('/update', [LocationAreasController::class, 'update'])->name('update');
        Route::delete('/delete', [LocationAreasController::class, 'delete'])->name('delete');
    });
});
