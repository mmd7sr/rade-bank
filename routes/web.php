<?php

use App\Http\Controllers\Banking\BankCardInfoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/banking/card-info', [BankCardInfoController::class, 'create'])->name('banking.card-info.create');
    Route::post('/banking/card-info', [BankCardInfoController::class, 'store'])->name('banking.card-info.store');
});

require __DIR__.'/auth.php';
