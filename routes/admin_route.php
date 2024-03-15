<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoicePaymentController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::middleware('auth:web')->group(function () {

    Route::get('/dashboards', 'admin\HomeController@dashboard')->name('dashboard_admin');
    Route::post('/admin_login', 'admin\LoginController@login')->name('admin_login');
    Route::get('/admin_shipment_summary', 'admin\HomeController@shipment_summary')->name('shipment_summary_admin');
    Route::get('/admin_vehicle_summary', 'admin\HomeController@vehicle_summary')->name('vehicle_summary_admin');
    Route::get('/admin_sidebar_count', 'admin\HomeController@admin_sidebar_count')->name('admin_sidebar_count');
    Route::get('/admin_sidebar_sub_count', 'admin\HomeController@admin_sidebar_sub_count')->name('admin_sidebar_sub_count');
    Route::get('/admin_message', 'admin\HomeController@message')->name('message_admin');
    Route::get('/delete_vehicle_admin/{id}', 'admin\VehicleController@delete_vehicle')->name('delete_vehicle_admin');

    // Customers Routes
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/admin/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/admin/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/admin/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Locations Routes
    Route::get('/admin/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/admin/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/admin/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::get('/admin/locations/{customer}', [LocationController::class, 'show'])->name('locations.show');
    Route::get('/admin/locations/{customer}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/admin/locations/{customer}', [LocationController::class, 'update'])->name('locations.update');
    Route::delete('/admin/locations/{customer}', [LocationController::class, 'destroy'])->name('locations.destroy');
    
    // Vehicles Routes
    Route::get('/admin/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/admin/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/admin/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/admin/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::get('/admin/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/admin/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/admin/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    Route::get('/admin/vehicles_cost_analysis', [VehicleController::class, 'cost_analysis'])->name('vehicles.cost_analysis');
    Route::get('/admin/vehicles_dateline', [VehicleController::class, 'dateline'])->name('vehicles.dateline');
    Route::get('/admin/vehicles_summary', [VehicleController::class, 'summary'])->name('vehicles.summary');

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

// });