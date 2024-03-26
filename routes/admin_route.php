<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoicePaymentController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\HomeController;

//Auth::routes();
Route::middleware('auth:user')->group(function () {

    Route::get('logout', [AuthController::class, 'logout_user'])->name('users.logout');
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('home.index')->middleware(['can:dashboard-view']);

    // user section 
    Route::get('admin/users', [UserController::class,'index'])->name('users.index')->middleware(['can:user-view']);
    Route::get('admin/users/create', [UserController::class,'create'])->name('users.create')->middleware(['can:user-create']);
    Route::post('admin/users/store', [UserController::class,'store'])->name('users.store')->middleware(['can:user-create']);
    Route::get('admin/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware(['can:user-edit']);
    Route::put('admin/users/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware(['can:user-edit']);
    Route::get('admin/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware(['can:user-view']);
    Route::delete('admin/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['can:user-delete']);

    // Customers Routes
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.index')->middleware(['can:customer-view']);
    Route::get('/admin/customers/create', [CustomerController::class, 'create'])->name('customers.create')->middleware(['can:customer-create']);
    Route::post('/admin/customers', [CustomerController::class, 'store'])->name('customers.store')->middleware(['can:customer-create']);
    Route::get('/admin/customers/{id}', [CustomerController::class, 'show'])->name('customers.show')->middleware(['can:customer-view']);
    Route::get('/admin/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit')->middleware(['can:customer-edit']);
    Route::put('admin/customers/{id}', [CustomerController::class, 'update'])->name('customers.update')->middleware(['can:customer-edit']);
    Route::delete('/admin/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy')->middleware(['can:customer-delete']);
    Route::get('/admin/s2s_customers', [CustomerController::class, 's2s_customers'])->name('s2s_customers');

    // User Permissions
    Route::get('admin/permissions', [PermissionController::class,'index'])->name('permissions.index')->middleware(['can:permission-view']);

    // User Roles
    Route::get('admin/roles', [RoleController::class,'index'])->name('roles.index')->middleware(['can:role-view']);
    Route::get('admin/roles/create', [RoleController::class,'create'])->name('roles.create')->middleware(['can:role-create']);
    Route::post('admin/roles/store', [RoleController::class,'store'])->name('roles.store')->middleware(['can:role-create']);
    Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware(['can:role-edit']);
    Route::put('/admin/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware(['can:role-edit']);
    Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('roles.show')->middleware(['can:role-view']);
    
    Route::get('/admin_sidebar_count', [HomeController::class, 'admin_sidebar_count'])->name('admin_sidebar_count');
    Route::get('/admin_sidebar_sub_count',  [HomeController::class, 'admin_sidebar_sub_count'])->name('admin_sidebar_sub_count');

    // Locations Routes
    Route::get('/admin/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/admin/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/admin/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::get('/admin/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
    Route::get('/admin/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/admin/locations/{location}', [LocationController::class, 'update'])->name('locations.update');
    Route::delete('/admin/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');
    
    // Vehicles Routes
    Route::get('/admin/vehicles', [VehicleController::class, 'index'])->name('vehicles.index')->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create')->middleware(['can:vehicle-create']);
    Route::post('/admin/vehicles', [VehicleController::class, 'store'])->name('vehicles.store')->middleware(['can:vehicle-create']);
    Route::get('/admin/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show')->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit')->middleware(['can:vehicle-edit']);
    Route::put('/admin/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update')->middleware(['can:vehicle-edit']);
    Route::delete('/admin/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy')->middleware(['can:vehicle-delete']);

    
    Route::post('/admin/vehicles_change_status', [VehicleController::class, 'change_status'])->name('vehicles.change_status')->middleware(['can:vehicle-change-status']);
    Route::get('/admin/vehicles_cost_analysis', [VehicleController::class, 'cost_analysis'])->name('vehicles.cost_analysis')->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles_summary', [VehicleController::class, 'summary'])->name('vehicles.summary')->middleware(['can:vehicle-view']);

    // Invoice Routes
    Route::get('/admin/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/admin/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/admin/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/admin/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/admin/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/admin/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/admin/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    // Invoice Payment Routes
    Route::get('/admin/invoice_payments', [InvoicePaymentController::class, 'index'])->name('invoice_payments.index');
    Route::get('/admin/invoice_payments/create', [InvoicePaymentController::class, 'create'])->name('invoice_payments.create');
    Route::post('/admin/invoice_payments', [InvoicePaymentController::class, 'store'])->name('invoice_payments.store');
    Route::get('/admin/invoice_payments/{invoice_payment}', [InvoicePaymentController::class, 'show'])->name('invoice_payments.show');
    Route::get('/admin/invoice_payments/{invoice_payment}/edit', [InvoicePaymentController::class, 'edit'])->name('invoice_payments.edit');
    Route::put('/admin/invoice_payments/{invoice_payment}', [InvoicePaymentController::class, 'update'])->name('invoice_payments.update');
    Route::delete('/admin/invoice_payments/{invoice_payment}', [InvoicePaymentController::class, 'destroy'])->name('invoices.destroy');

});