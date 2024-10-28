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


/*

guest
- home
- ships
- operator
- review
master
- login
- CRUD,cetak passenger
- CRUD operator 
- CRUD ship
- CRUD user
- approve reviews
admin
- login
- view passenger
- view operator
- view ship
- view reviews
operator
- login
- CRUD,cetak passenger
- CRUD operator 
- CRUD ship
- approve reviews
 
 */
Route::get('/', [GuestController::class, 'index'])->name('home');
Route::post('/review/store', [GuestController::class, 'storeReview']);
Route::get('/reviews', [GuestController::class, 'reviews']);
Route::get('/operators', [GuestController::class, 'operators']);
Route::get('/boats', [GuestController::class, 'boats']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
   
});


Route::middleware((['auth']))->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware(['checkRole:operator|master|admin'])->group(function(){
        Route::prefix('master')->group(function () {
            Route::get('/', [MasterController::class, 'index'])->name('master.index');
            Route::prefix('passenger')->group(function () {
                Route::get('/', [masterController::class, 'passenger'])->name('master.passenger.index');
                Route::post('/store', [MasterController::class, 'storePassenger'])->name('master.passenger.store');
                Route::get('/{id}', [MasterController::class, 'editPassenger'])->name('master.passenger.edit');
                Route::put('/{id}', [MasterController::class, 'updatePassenger'])->name('master.passenger.update');
                Route::delete('/{id}', [MasterController::class, 'destroyPassenger'])->name('master.passenger.destroy');
                Route::post('/export', [MasterController::class, 'exportPassenger'])->name('master.passenger.export');
            });
            Route::prefix('retribution')->group(function () {
                Route::get('/', [masterController::class, 'retribution'])->name('master.retribution.index');
                Route::post('/store', [MasterController::class, 'storeRetribution'])->name('master.retribution.store');
                Route::get('/{id}', [MasterController::class, 'editRetribution'])->name('operator.retribution.edit');
                Route::put('/{id}', [MasterController::class, 'updateRetribution'])->name('operator.retribution.update');
                Route::delete('/{id}', [MasterController::class, 'destroyRetribution'])->name('master.retribution.destroy');
                // Route::post('/export', [MasterController::class, 'exportRetribusi'])->name('master.retribusi.export');
            });
            Route::prefix('ship')->group(function () {
                Route::get('/', [MasterController::class, 'ship'])->name('master.ship.index');
                Route::post('/store', [MasterController::class, 'storeShip'])->name('master.ship.store');
                Route::get('/{id}', [MasterController::class, 'editShip'])->name('master.ship.edit');
                Route::put('/{id}', [MasterController::class, 'updateShip'])->name('master.ship.update');
                Route::delete('/{id}', [MasterController::class, 'destroyShip'])->name('master.ship.destroy');
            });
            Route::prefix('operator')->group(function () {
                Route::get('/', [MasterController::class, 'operator'])->name('master.operator.index');
                Route::post('/store', [MasterController::class, 'storeOperator'])->name('master.operator.store');
                Route::get('/{id}', [MasterController::class, 'editOperator'])->name('master.operator.edit');
                Route::put('/{id}', [MasterController::class, 'updateOperator'])->name('master.operator.update');
                Route::delete('/{id}', [MasterController::class, 'destroyOperator'])->name('master.operator.destroy');
            });
            Route::prefix('route')->group(function () {
                Route::get('/', [MasterController::class, 'route'])->name('master.route.index');
                Route::post('/store', [MasterController::class, 'storeRoute'])->name('master.route.store');
                Route::get('/{id}', [MasterController::class, 'editRoute'])->name('master.route.edit');
                Route::put('/{id}', [MasterController::class, 'updateRoute'])->name('master.route.update');
                Route::delete('/{id}', [MasterController::class, 'destroyRoute'])->name('master.route.destroy');
            });
            Route::prefix('users')->group(function () {
                Route::get('/', [MasterController::class, 'users'])->name('master.user.index');
                Route::post('/store', [MasterController::class, 'storeUser'])->name('master.user.store');
                Route::get('/{id}', [MasterController::class, 'editUser'])->name('master.user.edit');
                Route::put('/{id}', [MasterController::class, 'updateUser'])->name('master.user.update');
                Route::delete('/{id}', [MasterController::class, 'destroyUser'])->name('master.user.destroy');
            });
            Route::prefix('review')->group(function () {
                Route::get('/', [MasterController::class, 'Review'])->name('master.review.index');
                Route::put('/{id}', [MasterController::class, 'updateReview'])->name('master.review.update');
            });
            Route::prefix('profile')->group(function () {
                Route::get('/', [masterController::class, 'editProfile'])->name('master.profile.edit');
                Route::put('/update/{id}', [MasterController::class, 'updateProfile'])->name('master.profile.update');
                Route::get('/change-password', [MasterController::class, 'showChangePasswordForm'])->name('master.profile.showChangePasswordForm');
                Route::put('/change-password/{id}', [MasterController::class, 'changePassword'])->name('master.profile.changePassword');
            });
         ;
        });
        
    });
    // Route::middleware(['role:operator'])->group(function(){
    //     Route::prefix('master')->group(function () {
    //         Route::get('/', [MasterController::class, 'index'])->name('master.index');

    //         Route::prefix('passenger')->group(function () {
    //             Route::get('/', [masterController::class, 'passenger'])->name('master.passenger.index');
    //             Route::post('/store', [MasterController::class, 'storePassenger'])->name('master.passenger.store');
    //             Route::get('/{id}', [MasterController::class, 'editPassenger'])->name('operator.passenger.edit');
    //             Route::put('/{id}', [MasterController::class, 'updatePassenger'])->name('operator.passenger.update');
    //             Route::delete('/{id}', [MasterController::class, 'destroyPassenger'])->name('master.passenger.destroy');
    //         });
    //         Route::prefix('ship')->group(function () {
    //             Route::get('/', [MasterController::class, 'ship'])->name('master.ship.index');
    //             Route::post('/store', [MasterController::class, 'storeShip'])->name('master.ship.store');
    //             Route::get('/{id}', [MasterController::class, 'editShip'])->name('master.ship.edit');
    //             Route::put('/{id}', [MasterController::class, 'updateShip'])->name('master.ship.update');
    //             Route::delete('/{id}', [MasterController::class, 'destroyShip'])->name('master.ship.destroy');
    //         });

    //         Route::prefix('operator')->group(function () {
    //             Route::get('/', [MasterController::class, 'operator'])->name('master.operator.index');
    //             Route::post('/store', [MasterController::class, 'storeOperator'])->name('master.operator.store');
    //             Route::get('/{id}', [MasterController::class, 'editOperator'])->name('master.operator.edit');
    //             Route::put('/{id}', [MasterController::class, 'updateOperator'])->name('master.operator.update');
    //             Route::delete('/{id}', [MasterController::class, 'destroyOperator'])->name('master.operator.destroy');
    //         });

    //         Route::prefix('route')->group(function () {
    //             Route::get('/', [MasterController::class, 'route'])->name('master.route.index');
    //             Route::post('/store', [MasterController::class, 'storeRoute'])->name('master.route.store');
    //             Route::get('/{id}', [MasterController::class, 'editRoute'])->name('master.route.edit');
    //             Route::put('/{id}', [MasterController::class, 'updateRoute'])->name('master.route.update');
    //             Route::delete('/{id}', [MasterController::class, 'destroyRoute'])->name('master.route.destroy');
    //         });

    //         // Route::prefix('users')->group(function () {
    //         //     Route::get('/', [MasterController::class, 'users'])->name('master.user.index');
    //         //     Route::post('/store', [MasterController::class, 'storeUser'])->name('master.user.store');
    //         //     Route::get('/{id}', [MasterController::class, 'editUser'])->name('master.user.edit');
    //         //     Route::put('/{id}', [MasterController::class, 'updateUser'])->name('master.user.update');
    //         //     Route::delete('/{id}', [MasterController::class, 'destroyUser'])->name('master.user.destroy');
    //         // });
            
    //         Route::prefix('review')->group(function () {
    //             Route::get('/', [MasterController::class, 'Review'])->name('master.review.index');
    //             Route::put('/{id}', [MasterController::class, 'updateReview'])->name('master.review.update');
    //         });
    
    //         Route::prefix('profile')->group(function () {
    //             Route::get('/', [masterController::class, 'editProfile'])->name('master.profile.edit');
    //             Route::put('/update/{id}', [MasterController::class, 'updateProfile'])->name('master.profile.update');
    //             Route::get('/change-password', [MasterController::class, 'showChangePasswordForm'])->name('master.profile.showChangePasswordForm');
    //             Route::put('/change-password/{id}', [MasterController::class, 'changePassword'])->name('master.profile.changePassword');
    //         });
    //         // crud users
    //     });
    // });
   
});

