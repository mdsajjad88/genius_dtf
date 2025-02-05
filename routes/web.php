<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarchentController;
use App\Http\Controllers\StoreController;
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

});

require __DIR__.'/auth.php';
