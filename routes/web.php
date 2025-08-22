<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('expenses', ExpenseController::class)->except('show');
    Route::get('expenses/monthly-summary', [ExpenseController::class, 'monthlySummary'])->name('expenses.monthly-summary');
});
