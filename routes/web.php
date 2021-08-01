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
use App\Http\Controllers\LocationActivityController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\CurrencyController;

Route::prefix('/')->middleware(['auth:sanctum', 'verified'])->group(function () {
    // home page
    Route::get('/', [HomeController::class, 'get_home_page'])->name("home_page");
    Route::get('/home', [HomeController::class, 'get_home_page']);
    Route::get('/index', [HomeController::class, 'get_home_page']);
    Route::get('/dashboard', [HomeController::class, 'get_home_page'])->name("dashboard");

    // locations
    Route::prefix('/locations')->name('locations.')->group(function () {
        // locations
        Route::get('/show', [LocationAreasController::class, 'show'])->name('show');
        Route::post('/add', [LocationAreasController::class, 'add'])->name('add');
        Route::post('/update', [LocationAreasController::class, 'update'])->name('update');
        Route::delete('/delete', [LocationAreasController::class, 'delete'])->name('delete');
        // areas
        Route::prefix('/areas')->name('areas.')->group(function () {
            Route::get('/', [LocationAreasController::class, 'show'])->name('show');
            Route::post('/add', [LocationAreasController::class, 'add'])->name('add');
            Route::post('/update', [LocationAreasController::class, 'update'])->name('update');
            Route::delete('/delete', [LocationAreasController::class, 'delete'])->name('delete');
        });
        // activities
        Route::prefix('/activities')->name('activities.')->group(function () {
            Route::get('/', [LocationActivityController::class, 'show'])->name('show');
            Route::post('/add', [LocationActivityController::class, 'add'])->name('add');
            Route::post('/update', [LocationActivityController::class, 'update'])->name('update');
            Route::delete('/delete', [LocationActivityController::class, 'delete'])->name('delete');
        });
    });

    // payments
    Route::prefix('/payments')->name('payments.')->group(function () {
        // payment_types
        Route::prefix('/payment-types')->name('payment_types.')->group(function () {
            Route::get('/', [PaymentTypeController::class, 'show'])->name('show');
            Route::post('/add', [PaymentTypeController::class, 'add'])->name('add');
            Route::post('/update', [PaymentTypeController::class, 'update'])->name('update');
            Route::delete('/delete', [PaymentTypeController::class, 'delete'])->name('delete');
        });
        // currencies
        Route::prefix('/currencies')->name('currencies.')->group(function () {
            Route::get('/', [CurrencyController::class, 'show'])->name('show');
            Route::post('/add', [CurrencyController::class, 'add'])->name('add');
            Route::post('/update', [CurrencyController::class, 'update'])->name('update');
            Route::delete('/delete', [CurrencyController::class, 'delete'])->name('delete');
        });
    });
});
