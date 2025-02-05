<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/marchent/store-list', [StoreController::class, 'index'])->name('store.list');
    Route::get('/marchent/create-store', [StoreController::class, 'create'])->name('store.create');
    Route::post('/marchent/store-store', [StoreController::class, 'store'])->name('store.store');
    Route::get('/marchent/category-list', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/marchent/create-category', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/marchent/store-category', [CategoryController::class, 'store'])->name('category.store');

});

require __DIR__.'/auth.php';
