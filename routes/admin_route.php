<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoicePaymentController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\LocationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\HomeController;

Route::get('/',function(){
    return view("auth/login");
});

Route::get('/login', function () {
    return view('auth/login');
});

/* Route::middleware('auth')->group(function(){
    Route::get('/user',[UserController::class,'user'])->name('user');
    Route::post('/user',[UserController::class,'create'])->name('user.create');
});   */  




//Auth::routes();

// Route::middleware('auth:web')->group(function () {

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    // user section 
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('home.index')->middleware(['can:dashboard-view']);

    Route::get('admin/user', [UserController::class,'index'])->name('user.index')->middleware(['can:user-view']);
    Route::get('admin/user/create', [UserController::class,'create'])->name('user.create')->middleware(['can:user-create']);
    Route::post('admin/user/store', [UserController::class,'store'])->name('user.store')->middleware(['can:user-create']);
    Route::get('admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware(['can:user-edit']);
    Route::put('admin/user/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware(['can:user-edit']);
    Route::get('admin/user/{id}', [UserController::class, 'show'])->name('user.show')->middleware(['can:user-view']);
    Route::delete('admin/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware(['can:user-delete']);

    // User Permissions
    Route::get('admin/permission', [PermissionController::class,'index'])->name('permission.index')->middleware(['can:permission-view']);

    // User Roles
    Route::get('admin/role', [RoleController::class,'index'])->name('role.index')->middleware(['can:role-view']);
    Route::get('admin/role/create', [RoleController::class,'create'])->name('role.create')->middleware(['can:role-create']);
    Route::post('admin/role/store', [RoleController::class,'store'])->name('role.store')->middleware(['can:role-create']);
    Route::get('/admin/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware(['can:role-edit']);
    Route::put('/admin/role/update/{id}', [RoleController::class, 'update'])->name('role.update')->middleware(['can:role-edit']);
    Route::get('/admin/role/{id}', [RoleController::class, 'show'])->name('role.show')->middleware(['can:role-view']);

    Route::get('/admin_shipment_summary', 'admin\HomeController@shipment_summary')->name('shipment_summary_admin');
    Route::get('/admin_vehicle_summary', 'admin\HomeController@vehicle_summary')->name('vehicle_summary_admin');
    Route::get('/admin_message', 'admin\HomeController@message')->name('message_admin');
    Route::get('/delete_vehicle_admin/{id}', 'admin\VehicleController@delete_vehicle')->name('delete_vehicle_admin');
    
    Route::get('/admin_sidebar_count', [HomeController::class, 'admin_sidebar_count'])->name('admin_sidebar_count');
    Route::get('/admin_sidebar_sub_count',  [HomeController::class, 'admin_sidebar_sub_count'])->name('admin_sidebar_sub_count');

    // Customers Routes
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/admin/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/admin/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/admin/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/admin/s2s_customers', [CustomerController::class, 's2s_customers'])->name('s2s_customers');

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

    
    Route::post('/admin/vehicle_change_status', [VehicleController::class, 'change_status'])->name('vehicles.change_status')->middleware(['can:vehicle-change-status']);
    Route::get('/admin/vehicles_cost_analysis', [VehicleController::class, 'cost_analysis'])->name('vehicles.cost_analysis')->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles_dateline', [VehicleController::class, 'dateline'])->name('vehicles.dateline')->middleware(['can:vehicle-view']);
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