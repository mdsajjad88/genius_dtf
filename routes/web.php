<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarchentController;

Route::get('/', [MarchentController::class, 'showRegisterForm']);
Route::get('/login', [MarchentController::class, 'login'])->name('login.view');
Route::resource('marchent', MarchentController::class);
