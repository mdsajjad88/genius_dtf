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
Route::get('/', [CategoryController::class, 'showHomePage'])->name('home');
Route::get('/dashboard', function () {
    return view('marchent.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/merchant/dashboard', [MarchentController::class, 'index'])->name('marchent.dashboard.index');
    Route::controller(StoreController::class)->group(function(){
        Route::get('/merchant/store-list', 'index')->name('store.list');
        Route::get('/merchant/create-store', 'create')->name('store.create');
        Route::post('/merchant/store-store', 'store')->name('store.store');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/merchant/category-list',  'index')->name('category.list');
        Route::get('/merchant/create-category', 'create')->name('category.create');
        Route::post('/merchant/store-category',  'store')->name('category.store');
        Route::get('/get-categories', 'getCategoriesByStore')->name('get.categories');

    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/merchant/product-list',  'index')->name('product.list');
        Route::get('/merchant/create-product', 'create')->name('product.create');
        Route::post('/merchant/store-product',  'store')->name('product.store');

    });


});

require __DIR__.'/auth.php';
