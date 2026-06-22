<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;

// New specialized controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RetributionController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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
            Route::get('/', [DashboardController::class, 'index'])->name('master.index');
            Route::get('/export', [DashboardController::class, 'exportDashboard'])->name('master.export');
            Route::prefix('passenger')->group(function () {
                Route::get('/', [PassengerController::class, 'passenger'])->name('master.passenger.index');
                Route::get('/datatable', [PassengerController::class, 'datatable'])->name('master.passenger.datatable');
                Route::post('/store', [PassengerController::class, 'storePassenger'])->name('master.passenger.store');
                Route::get('/{id}', [PassengerController::class, 'editPassenger'])->name('master.passenger.edit');
                Route::put('/{id}', [PassengerController::class, 'updatePassenger'])->name('master.passenger.update');
                Route::delete('/{id}', [PassengerController::class, 'destroyPassenger'])->name('master.passenger.destroy');
                Route::post('/export', [PassengerController::class, 'exportPassenger'])->name('master.passenger.export');
                Route::post('/export-excel', [PassengerController::class, 'exportExcel'])->name('master.passenger.exportExcel');
            });
            Route::prefix('retribution')->group(function () {
                Route::prefix('target')->group(function () {
                    // Route::get('/', [RetributionController::class, 'retribution'])->name('master.retribution.index');
                    Route::post('/store', [RetributionController::class, 'storeTargetRetribution'])->name('master.target.retribution.store');
                    Route::get('/{id}', [RetributionController::class, 'editTargetRetribution'])->name('master.target.retribution.edit');
                    Route::put('/{id}', [RetributionController::class, 'updateTargetRetribution'])->name('master.target.retribution.update');
                    Route::delete('/{id}', [RetributionController::class, 'destroyTargetRetribution'])->name('master.target.retribution.destroy');
                    // Route::post('/export', [RetributionController::class, 'exportRetribusi'])->name('master.retribusi.export');

                });
                Route::get('/', [RetributionController::class, 'retribution'])->name('master.retribution.index');
                Route::get('/datatable/targets', [RetributionController::class, 'datatableTargets'])->name('master.retribution.datatable.targets');
                Route::get('/datatable/passengers', [RetributionController::class, 'datatablePassengers'])->name('master.retribution.datatable.passengers');
                Route::get('/modal/{id}', [RetributionController::class, 'loadModal'])->name('master.retribution.modal');
                Route::post('/export-targets', [RetributionController::class, 'exportTargets'])->name('master.retribution.exportTargets');
                Route::post('/export-passengers', [RetributionController::class, 'exportPassengers'])->name('master.retribution.exportPassengers');
                    Route::post('/store', [RetributionController::class, 'storeRetribution'])->name('master.retribution.store');
                    Route::get('/{id}', [RetributionController::class, 'editRetribution'])->name('master.retribution.edit');
                    Route::put('/{id}', [RetributionController::class, 'updateRetribution'])->name('master.retribution.update');
                    Route::delete('/{id}', [RetributionController::class, 'destroyRetribution'])->name('master.retribution.destroy');

            });
            Route::prefix('ship')->group(function () {
                Route::get('/', [ShipController::class, 'ship'])->name('master.ship.index');
                Route::post('/store', [ShipController::class, 'storeShip'])->name('master.ship.store');
                Route::get('/{id}', [ShipController::class, 'editShip'])->name('master.ship.edit');
                Route::put('/{id}', [ShipController::class, 'updateShip'])->name('master.ship.update');
                Route::delete('/{id}', [ShipController::class, 'destroyShip'])->name('master.ship.destroy');
            });
            Route::prefix('operator')->group(function () {
                Route::get('/', [OperatorController::class, 'operator'])->name('master.operator.index');
                Route::post('/store', [OperatorController::class, 'storeOperator'])->name('master.operator.store');
                Route::get('/{id}', [OperatorController::class, 'editOperator'])->name('master.operator.edit');
                Route::put('/{id}', [OperatorController::class, 'updateOperator'])->name('master.operator.update');
                Route::delete('/{id}', [OperatorController::class, 'destroyOperator'])->name('master.operator.destroy');
            });
            Route::prefix('route')->group(function () {
                Route::get('/', [RouteController::class, 'route'])->name('master.route.index');
                Route::post('/store', [RouteController::class, 'storeRoute'])->name('master.route.store');
                Route::get('/{id}', [RouteController::class, 'editRoute'])->name('master.route.edit');
                Route::put('/{id}', [RouteController::class, 'updateRoute'])->name('master.route.update');
                Route::delete('/{id}', [RouteController::class, 'destroyRoute'])->name('master.route.destroy');
            });
            Route::prefix('users')->group(function () {
                Route::get('/', [UserController::class, 'users'])->name('master.user.index');
                Route::post('/store', [UserController::class, 'storeUser'])->name('master.user.store');
                Route::get('/{id}', [UserController::class, 'editUser'])->name('master.user.edit');
                Route::put('/{id}', [UserController::class, 'updateUser'])->name('master.user.update');
                Route::delete('/{id}', [UserController::class, 'destroyUser'])->name('master.user.destroy');
            });
            Route::prefix('review')->group(function () {
                Route::get('/', [ReviewController::class, 'review'])->name('master.review.index');
                Route::put('/{id}', [ReviewController::class, 'updateReview'])->name('master.review.update');
            });
            Route::prefix('profile')->group(function () {
                Route::get('/', [ProfileController::class, 'editProfile'])->name('master.profile.edit');
                Route::put('/update/{id}', [ProfileController::class, 'updateProfile'])->name('master.profile.update');
                Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('master.profile.showChangePasswordForm');
                Route::put('/change-password/{id}', [ProfileController::class, 'changePassword'])->name('master.profile.changePassword');
            });
         ;
        });
    });
});

