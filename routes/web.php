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
        Route::prefix('operator')->group(function () {
            // Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
            Route::get('/', [OperatorController::class, 'index'])->name('operator.index');
            Route::get('/passenger', [OperatorController::class, 'passenger'])->name('operator.passenger');
            Route::get('/operator', [OperatorController::class, 'index'])->name('operator.operator');
            Route::get('/ship', [OperatorController::class, 'index'])->name('operator.ship');
            Route::get('/route', [OperatorController::class, 'index'])->name('operator.route');
            Route::get('/users', [OperatorController::class, 'index'])->name('operator.users');
            Route::get('/account', [OperatorController::class, 'index'])->name('operator.account');
        });
    });
    Route::middleware(['role:master'])->group(function(){
        Route::get('/master', [MasterController::class, 'index'])->name('master.index');
    });
});

/*
 views

guest
- home
master
- login
- CRUD user
* CRUD,cetak operator 
* CRUD,cetak ship
* CRUD,cetak passenger
* approve reviews
admin
- login
- view operator
- view ship
- view passenger
operator
- login
- CRUD,cetak operator 
- CRUD,cetak ship
- CRUD,cetak passenger
- approve reviews 
 
 */