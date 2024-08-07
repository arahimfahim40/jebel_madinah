<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerReportController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoicePaymentController;
use App\Http\Controllers\Admin\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OwnerController;

Route::middleware('auth:user')->group(function () {

    Route::get('admin/profile', [AuthController::class, 'admin_profile'])
        ->name('users.profile');
    Route::post('admin/change_password', [AuthController::class, 'change_password'])
        ->name('users.change_password');

    Route::get('logout', [AuthController::class, 'logout_user'])
        ->name('users.logout');
    Route::get('admin/dashboard', [HomeController::class, 'index'])
        ->name('user.home.index')
        ->middleware(['can:dashboard-view']);


    // user section 
    Route::get('admin/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware(['can:user-view']);
    Route::get('admin/users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware(['can:user-create']);
    Route::post('admin/users/store', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware(['can:user-create']);
    Route::get('admin/users/edit/{id}', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware(['can:user-edit']);
    Route::put('admin/users/update/{id}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware(['can:user-edit']);
    Route::get('admin/users/{id}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware(['can:user-view']);
    Route::delete('admin/users/delete/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware(['can:user-delete']);


    // Customers Routes
    Route::get('/admin/customers', [CustomerController::class, 'index'])
        ->name('customers.index')
        ->middleware(['can:customer-view']);
    Route::get('/admin/customers/create', [CustomerController::class, 'create'])
        ->name('customers.create')
        ->middleware(['can:customer-create']);
    Route::post('/admin/customers', [CustomerController::class, 'store'])
        ->name('customers.store')
        ->middleware(['can:customer-create', 'can:invoice-create']);
    Route::get('/admin/customers/{id}', [CustomerController::class, 'show'])
        ->name('customers.show')
        ->middleware(['can:customer-view']);
    Route::get('/admin/customers/{id}/edit', [CustomerController::class, 'edit'])
        ->name('customers.edit')
        ->middleware(['can:customer-edit']);
    Route::put('admin/customers/{id}', [CustomerController::class, 'update'])
        ->name('customers.update')
        ->middleware(['can:customer-edit']);
    Route::delete('/admin/customers/{id}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy')
        ->middleware(['can:customer-delete']);
    Route::get('/admin/s2s_customers', [CustomerController::class, 's2s_customers'])
        ->name('s2s_customers');


    // User Permissions
    Route::get('admin/permissions', [PermissionController::class, 'index'])
        ->name('permissions.index')
        ->middleware(['can:permission-view']);

    // User Roles
    Route::get('admin/roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware(['can:role-view']);
    Route::get('admin/roles/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware(['can:role-create']);
    Route::post('admin/roles/store', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware(['can:role-create']);
    Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware(['can:role-edit']);
    Route::put('/admin/roles/update/{id}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware(['can:role-edit']);
    Route::get('/admin/roles/{id}', [RoleController::class, 'show'])
        ->name('roles.show')
        ->middleware(['can:role-view']);

    Route::get('/admin_sidebar_count', [HomeController::class, 'admin_sidebar_count'])
        ->name('admin_sidebar_count');
    Route::get('/admin_sidebar_sub_count',  [HomeController::class, 'admin_sidebar_sub_count'])
        ->name('admin_sidebar_sub_count');

    // Owners Routes
    Route::get('/admin/owners', [OwnerController::class, 'index'])
        ->name('owners.index')
        ->middleware(['can:owner-view']);
    Route::get('/admin/owners/create', [OwnerController::class, 'create'])
        ->name('owners.create')
        ->middleware(['can:owner-create']);
    Route::post('/admin/owners', [OwnerController::class, 'store'])
        ->name('owners.store')
        ->middleware(['can:owner-create']);
    Route::get('/admin/owners/{id}', [OwnerController::class, 'show'])
        ->name('owners.show')
        ->middleware(['can:owner-view']);
    Route::get('/admin/owners/{id}/edit', [OwnerController::class, 'edit'])
        ->name('owners.edit')
        ->middleware(['can:owner-edit']);
    Route::put('/admin/owners/{id}', [OwnerController::class, 'update'])
        ->name('owners.update')
        ->middleware(['can:owner-edit']);
    Route::delete('/admin/owners/{id}', [OwnerController::class, 'destroy'])
        ->name('owners.destroy')
        ->middleware(['can:owner-delete']);


    // Vehicles Routes
    Route::get('/admin/vehicles', [VehicleController::class, 'index'])
        ->name('vehicles.index')
        ->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles/create', [VehicleController::class, 'create'])
        ->name('vehicles.create')
        ->middleware(['can:vehicle-create']);
    Route::post('/admin/vehicles', [VehicleController::class, 'store'])
        ->name('vehicles.store')
        ->middleware(['can:vehicle-create']);
    Route::get('/admin/vehicles/{vehicle}', [VehicleController::class, 'show'])
        ->name('vehicles.show')
        ->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])
        ->name('vehicles.edit')
        ->middleware(['can:vehicle-edit']);
    Route::put('/admin/vehicles/{vehicle}', [VehicleController::class, 'update'])
        ->name('vehicles.update')
        ->middleware(['can:vehicle-edit']);
    Route::delete('/admin/vehicles/{vehicle}', [VehicleController::class, 'destroy'])
        ->name('vehicles.destroy')
        ->middleware(['can:vehicle-delete']);

    Route::post('/admin/vehicles_change_status', [VehicleController::class, 'change_status'])
        ->name('vehicles.change_status')
        ->middleware(['can:vehicle-change-status']);
    Route::get('/admin/vehicles_cost_analysis', [VehicleController::class, 'cost_analysis'])
        ->name('vehicles.cost_analysis')
        ->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles_summary', [VehicleController::class, 'summary'])
        ->name('vehicles.summary')
        ->middleware(['can:vehicle-view']);
    Route::get('/admin/vehicles_trash_list', [VehicleController::class, 'trash_list'])
        ->name('vehicles.trash_list')
        ->middleware(['can:vehicle-trash-list']);
    Route::get('/admin/vehicles_restore/{vehicle}', [VehicleController::class, 'restore'])
        ->name('vehicles.restore')
        ->middleware(['can:vehicle-restore']);


    // Invoice Routes
    Route::get('/admin/invoices', [InvoiceController::class, 'index'])
        ->name('invoices.index')
        ->middleware(['can:invoice-view']);
    Route::get('/admin/invoices/create', [InvoiceController::class, 'create'])
        ->name('invoices.create')
        ->middleware(['can:invoice-create']);
    Route::post('/admin/invoices', [InvoiceController::class, 'store'])
        ->name('invoices.store')
        ->middleware(['can:invoice-create']);
    Route::get('/admin/invoices/{invoice}', [InvoiceController::class, 'show'])
        ->name('invoices.show')
        ->middleware(['can:invoice-view']);
    Route::get('/admin/invoices/edit/{id}', [InvoiceController::class, 'edit'])
        ->name('invoices.edit')
        ->middleware(['can:invoice-edit']);
    Route::put('/admin/invoices/update/{id}', [InvoiceController::class, 'update'])
        ->name('invoices.update')
        ->middleware(['can:invoice-edit']);
    Route::delete('/admin/invoices/{invoice}', [InvoiceController::class, 'destroy'])
        ->name('invoices.destroy')
        ->middleware(['can:invoice-delete']);
    Route::post('/admin/invoices_change_status', [InvoiceController::class, 'change_status'])
        ->name('invoices.change_status')
        ->middleware(['can:invoice-change-status']);

    // Route::get('/get_vehicles_open_of_customer', [InvoiceController::class, 'get_vehicles_open_of_customer'])
    // ->name('get_vehicles_open_of_customer');
    Route::get('/invoice_pdf/{id}/pdf', [InvoiceController::class, 'invoice_pdf'])
        ->name('invoice_pdf')
        ->middleware(['can:invoice-view']);
    Route::get('/view_single_invoce', [InvoiceController::class, 'view_single_invoice'])
        ->name('view_single_invoice')
        ->middleware(['can:invoice-view']);
    Route::get('/admin/invoices_trash_list', [InvoiceController::class, 'trash_list'])
        ->name('invoices.trash_list')
        ->middleware(['can:invoice-trash-list']);
    Route::get('/admin/invoices_restore/{invoice}', [InvoiceController::class, 'restore'])
        ->name('invoices.restore')
        ->middleware(['can:invoice-restore']);


    // Invoice Payment Routes
    Route::get('/admin/invoice_payments', [InvoicePaymentController::class, 'index'])
        ->name('invoice_payments.index');
    Route::get('/admin/invoice_payments/create', [InvoicePaymentController::class, 'create'])
        ->name('invoice_payments.create')
        ->middleware(['can:payment-add']);
    Route::post('/admin/invoice_payments', [InvoicePaymentController::class, 'store'])
        ->name('invoice_payments.store')
        ->middleware(['can:payment-add']);
    Route::get('/admin/invoice_payments/{invoice_payment}', [InvoicePaymentController::class, 'show'])
        ->name('invoice_payments.show');
    Route::get('/admin/invoice_payments/{invoice_payment}/edit', [InvoicePaymentController::class, 'edit'])
        ->name('invoice_payments.edit')
        ->middleware(['can:payment-edit']);
    Route::put('/admin/invoice_payments/{id}', [InvoicePaymentController::class, 'update'])
        ->name('invoice_payments.update')
        ->middleware(['can:payment-edit']);
    Route::delete('/invoice_payments/{id}', [InvoicePaymentController::class, 'destroy'])
        ->name('invoice_payments.destroy')
        ->middleware(['can:payment-delete']);


    // invoice customer reporting
    Route::get('/admin/reports/customer_list', [CustomerReportController::class, 'list'])
        ->name('customers.reports.list')
        ->middleware(['can:customer-report-view']);
    Route::get('/admin/reports/customer_view/{customer_id}', [CustomerReportController::class, 'view'])
        ->name('customers.reports.view')
        ->middleware(['can:customer-report-view']);
    Route::get('/admin/reports/customer_pdf/{customer_id}', [CustomerReportController::class, 'pdf'])
        ->name('customers.reports.pdf')
        ->middleware(['can:customer-report-view']);
});