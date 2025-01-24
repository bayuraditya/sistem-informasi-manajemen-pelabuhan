<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Models\Operator;
use App\Models\Passenger;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;


 
Route::get('/', [PengaduanController::class, 'index'])->name('guest');
Route::get('/create', [PengaduanController::class, 'pengaduan']);
Route::prefix('pengaduan')->group(function () {
    Route::get('/', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::post('/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    
    Route::get('/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show'); 
    Route::get('/{id}', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
   
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'index']);

Route::middleware((['auth']))->group(function(){
    Route::middleware(['checkRole:admin'])->group(function(){
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index']);

        });
    });


});



// page:

// home
// menu form pengaduan

// login
// home data pengaduan
// profile?




// form pengaduan:
//   nik
//   nama
//   no hp
//   email
//   alamat
//   judul
//   deskripsi
//   file(foto dll)
