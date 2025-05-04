<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProfileController;

// Auth routes with email verification
Auth::routes(['verify' => true]);

// Localization route
Route::get('index/{locale}', [HomeController::class, 'lang'])->name('lang');

// Root route (redirect ke dashboard berdasarkan role)
Route::get('/', [HomeController::class, 'root'])->middleware('auth')->name('root');

// Routes yang hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Dashboard routes berdasarkan role
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/driver/dashboard', [HomeController::class, 'driverDashboard'])->name('driver.dashboard');
    Route::get('/customer/dashboard', [HomeController::class, 'customerDashboard'])->name('customer.dashboard');

    // Admin routes - hanya bisa diakses oleh admin
    Route::middleware(['admin'])->group(function () {
        // Customers routes
        Route::get('/customers', [CustomersController::class, 'index'])->name('customer.index');
        Route::get('/customers/create', [CustomersController::class, 'create'])->name('customer.create');
        Route::post('/customers', [CustomersController::class, 'store'])->name('customer.store');
        Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit'])->name('customer.edit');
        Route::put('/customers/{customer}', [CustomersController::class, 'update'])->name('customer.update');
        Route::delete('/customers/{customer}', [CustomersController::class, 'destroy'])->name('customer.destroy');
    });

    // Paket routes - dapat diakses oleh admin dan driver
    Route::middleware(['can_manage_paket'])->group(function () {
        Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
        Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
        Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
        Route::get('/paket/{paket}/edit', [PaketController::class, 'edit'])->name('paket.edit');
        Route::put('/paket/{paket}', [PaketController::class, 'update'])->name('paket.update');
        Route::delete('/paket/{paket}', [PaketController::class, 'destroy'])->name('paket.destroy');
        Route::put('/paket/{paket}/status', [PaketController::class, 'updateStatus'])->name('paket.updateStatus');
    });

// Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


    // Catch-all route: pastikan hanya diakses saat login
    Route::get('{any}', [HomeController::class, 'index'])->where('any', '.*')->name('index');
});
