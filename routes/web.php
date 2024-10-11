<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\OperatorController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function () {

    Route::get('/', [GuestController::class, 'index'])->name('home');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware((['auth']))->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['role:admin'])->group(function(){
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    });
    Route::middleware(['role:operator'])->group(function(){
        Route::get('/operator', [OperatorController::class, 'index'])->name('operator.index');
    });
    Route::middleware(['role:master'])->group(function(){
        Route::get('/master', [MasterController::class, 'index'])->name('master.index');
    });
});