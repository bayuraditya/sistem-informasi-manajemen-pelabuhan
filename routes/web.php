<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\OperatorController;

use App\Http\Controllers\UserController;
use App\Models\Operator;
use App\Models\Passenger;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [GuestController::class, 'index'])->name('home');
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware((['auth']))->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['role:admin'])->group(function(){
        // Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    });
    Route::middleware(['role:master'])->group(function(){
        Route::prefix('master')->group(function () {
            // Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
            Route::get('/', [MasterController::class, 'index'])->name('master.index');

            Route::prefix('passenger')->group(function () {
                Route::get('/', [masterController::class, 'passenger'])->name('master.passenger.index');
                Route::post('/store', [MasterController::class, 'storePassenger'])->name('master.passenger.store');
                // Route::get('/{id}', [OperatorController::class, 'show'])->name('operator.passenger.show'); //ini keknya gaperlu
                Route::get('/{id}', [MasterController::class, 'editPassenger'])->name('operator.passenger.edit');
                Route::put('/{id}', [MasterController::class, 'updatePassenger'])->name('operator.passenger.update');
                Route::delete('/{id}', [MasterController::class, 'destroyPassenger'])->name('master.passenger.destroy');
            });
            Route::prefix('ship')->group(function () {
                Route::get('/', [MasterController::class, 'ship'])->name('master.ship.index');
                Route::post('/store', [MasterController::class, 'storeShip'])->name('master.ship.store');
                // Route::get('/{id}', [OperatorController::class, 'show'])->name('operator.passenger.show'); //ini keknya gaperlu
                Route::get('/{id}', [MasterController::class, 'editShip'])->name('master.ship.edit');
                Route::put('/{id}', [MasterController::class, 'updateShip'])->name('master.ship.update');
                Route::delete('/{id}', [MasterController::class, 'destroyShip'])->name('master.ship.destroy');
            });

           
            Route::prefix('operator')->group(function () {
                Route::get('/', [MasterController::class, 'operator'])->name('master.operator.index');
                Route::post('/store', [MasterController::class, 'storeOperator'])->name('master.operator.store');
                // Route::get('/{id}', [OperatorController::class, 'show'])->name('operator.passenger.show'); //ini keknya gaperlu
                Route::get('/{id}', [MasterController::class, 'editOperator'])->name('master.operator.edit');
                Route::put('/{id}', [MasterController::class, 'updateOperator'])->name('master.operator.update');
                Route::delete('/{id}', [MasterController::class, 'destroyOperator'])->name('master.operator.destroy');
            });

            Route::prefix('route')->group(function () {
                Route::get('/', [MasterController::class, 'route'])->name('master.route.index');
                Route::post('/store', [MasterController::class, 'storeRoute'])->name('master.route.store');
                // Route::get('/{id}', [OperatorController::class, 'show'])->name('operator.passenger.show'); //ini keknya gaperlu
                Route::get('/{id}', [MasterController::class, 'editRoute'])->name('master.route.edit');
                Route::put('/{id}', [MasterController::class, 'updateRoute'])->name('master.route.update');
                Route::delete('/{id}', [MasterController::class, 'destroyRoute'])->name('master.route.destroy');
            });

            Route::prefix('users')->group(function () {
                Route::get('/', [MasterController::class, 'users'])->name('master.user.index');
                Route::post('/store', [MasterController::class, 'storeUser'])->name('master.user.store');
                // Route::get('/{id}', [OperatorController::class, 'show'])->name('operator.passenger.show'); //ini keknya gaperlu
                Route::get('/{id}', [MasterController::class, 'editUser'])->name('master.user.edit');
                Route::put('/{id}', [MasterController::class, 'updateUser'])->name('master.user.update');
                Route::delete('/{id}', [MasterController::class, 'destroyUser'])->name('master.user.destroy');
            });
                // ----------------------
              // ----------------------
                // ----------------------
                  // ----------------------

         

         

            Route::prefix('review')->group(function () {
                Route::get('/', [MasterController::class, 'route'])->name('master.review.index');
                Route::post('/store', [MasterController::class, 'storeRoute'])->name('master.route.store');
                // Route::get('/{id}', [OperatorController::class, 'show'])->name('operator.passenger.show'); //ini keknya gaperlu
                Route::get('/{id}', [MasterController::class, 'editRoute'])->name('master.route.edit');
                Route::put('/{id}', [MasterController::class, 'updateRoute'])->name('master.route.update');
                Route::delete('/{id}', [MasterController::class, 'destroyRoute'])->name('master.route.destroy');
            });

            Route::prefix('profile')->group(function () {
                Route::get('/', [masterController::class, 'editProfile'])->name('master.profile.edit');
                Route::put('/update/{id}', [MasterController::class, 'updateProfile'])->name('admin.update');
                Route::get('/change-password', [MasterController::class, 'showChangePasswordForm'])->name('adminShowChangePasswordForm');
                Route::put('/change-password/{id}', [MasterController::class, 'changePassword'])->name('changePassword');
            });

            // Route::delete('/passenger/{id}', [MasterController::class, 'destroy'])->name('passenger.destroy');
            // Route::get('/operator', [MasterController::class, 'index'])->name('master.operator');
            // Route::get('/ship', [OperatorController::class, 'index'])->name('operator.ship');
            // Route::get('/route', [MasterController::class, 'index'])->name('master.route');
            // Route::get('/users', [MasterController::class, 'index'])->name('master.users');
            // Route::get('/account', [MasterController::class, 'index'])->name('master.account');
        });
    });
    Route::middleware(['role:operator'])->group(function(){
        Route::prefix('operator')->group(function () {
            // Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
            Route::get('/', [OperatorController::class, 'index'])->name('operator.index');

        });
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