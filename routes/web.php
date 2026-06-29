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

Route::get('/dashboard', function () {
    // Get top 5 buyers by count of purchases, or total spent. Let's do by count or sum of quantity.
    // We will group by nama_pembeli.
    $topBuyers = \App\Models\Transaction::selectRaw('nama_pembeli, COUNT(id) as total_transactions, SUM(total) as total_nominal, SUM(quantity) as total_quantity, MAX(product_description) as top_product')
        ->groupBy('nama_pembeli')
        ->orderByDesc('total_transactions') // Using total transactions as "pembelian terbanyak"
        ->limit(5)
        ->get();

    return view('dashboard', compact('topBuyers'));
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('transactions', TransactionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';