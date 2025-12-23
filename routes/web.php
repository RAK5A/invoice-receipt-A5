<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login',function(){
    return view('auth.login');
})->name('login');

Route::get('/register',function(){
    return view('auth.register');  
})->name('register');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    
    // Profile
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    // Invoices
    Route::prefix('invoices')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create');
        Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
        Route::get('/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
        Route::put('/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
        Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
        Route::get('/download-csv', [InvoiceController::class, 'downloadCsv'])->name('invoices.download-csv');
        // Route::post('/{invoice}/email', [InvoiceController::class, 'sendEmail'])->name('invoices.send-email');
        Route::get('/{invoice}/pdf', [InvoiceController::class, 'generatePdf'])->name('invoices.pdf');
    });

    // Products
    Route::resource('products', ProductController::class);
    Route::get('/products/category/{categoryID}', [ProductController::class, 'getByCategory'])->name('products.by-category');

    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Customers
    Route::resource('customers', CustomerController::class);

    // Users (Admin Only)
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
