<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/', function () {
    return redirect('/invoices');
});

// Auth routes (setup Laravel Breeze if you want login system)
Route::middleware(['auth'])->group(function () {
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{id}/pdf', [InvoiceController::class, 'download'])->name('invoices.pdf');
}); */

Route::get('/', function () {
    return redirect()->route('invoices.index');
});

// Customer Routes
Route::resource('customers', CustomerController::class);

// Invoice Routes
Route::resource('invoices', InvoiceController::class);