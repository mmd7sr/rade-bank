<?php

use App\Http\Controllers\Banking\AccountToShebaController;
use App\Http\Controllers\Banking\BankCardInfoController;
use App\Http\Controllers\Banking\CardToShebaController;
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

    Route::get('/banking/card-to-sheba', [CardToShebaController::class, 'create'])->name('banking.card-to-sheba.create');
    Route::post('/banking/card-to-sheba', [CardToShebaController::class, 'store'])->name('banking.card-to-sheba.store');

    Route::get('/banking/account-to-sheba', [AccountToShebaController::class, 'create'])->name('banking.account-to-sheba.create');
    Route::post('/banking/account-to-sheba', [AccountToShebaController::class, 'store'])->name('banking.account-to-sheba.store');
});

require __DIR__.'/auth.php';
