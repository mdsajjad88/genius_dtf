<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarchentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
Route::get('/', function () {
    return view('marchent.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/marchent/dashboard', [MarchentController::class, 'index'])->name('marchent.dashboard.index');
    Route::controller(StoreController::class)->group(function(){
        Route::get('/marchent/store-list', 'index')->name('store.list');
        Route::get('/marchent/create-store', 'create')->name('store.create');
        Route::post('/marchent/store-store', 'store')->name('store.store');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/marchent/category-list',  'index')->name('category.list');
        Route::get('/marchent/create-category', 'create')->name('category.create');
        Route::post('/marchent/store-category',  'store')->name('category.store');
        Route::get('/get-categories', 'getCategoriesByStore')->name('get.categories');

    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/marchent/product-list',  'index')->name('product.list');
        Route::get('/marchent/create-product', 'create')->name('product.create');
        Route::post('/marchent/store-product',  'store')->name('product.store');

    });


});

require __DIR__.'/auth.php';
