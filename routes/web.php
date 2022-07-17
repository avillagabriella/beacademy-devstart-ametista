<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    AddressController,
    CategoryController,
    ProductController,
};

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
})->name('index');


Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');

    //     Route::get('/{id}', [ProductController::class, 'show'])->name('show');

    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');

    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProductController::class, 'update'])->name('update');
});

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');

    //     Route::get('/{id}', [CategoryController::class, 'show'])->name('show');

    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');

    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
});

Route::resource('categories', CategoryController::class);

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');

    Route::get('/{id}', [UserController::class, 'show'])->name('show');

    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');

    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');

    Route::prefix('/{userId}/addresses')->name('addresses.')->group(function () {
        Route::get('/', [AddressController::class, 'index'])->name('index');

        Route::get('/create', [AddressController::class, 'create'])->name('create');
        Route::post('/', [AddressController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AddressController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AddressController::class, 'update'])->name('update');

        Route::delete('/{id}', [AddressController::class, 'destroy'])->name('destroy');
    });
});

Auth::routes();

Route::get('/app', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
