<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\TransactionController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buat-admin', function () {
    User::create([
        'name' => 'admin',
        'email' => 'pcraft@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]);

    return 'User admin berhasil dibuat!';
});

// Dashboard standar untuk semua user yang sudah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// AREA KHUSUS ADMIN (Hanya user dengan role 'admin' yang bisa masuk)
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('transactions', TransactionController::class);
});

// AREA PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SEMUA SISTEM LOGIN
require __DIR__.'/auth.php';