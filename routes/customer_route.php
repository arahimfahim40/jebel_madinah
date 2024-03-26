<?php


use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;

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

//Route::group(['middleware' => 'auth:customer'], function () {
Route::middleware('auth:customer')->group(function () {

    Route::get('/customer/logout', [AuthController::class, 'logout_customer'])->name('customer.logout');

    Route::get('/customer/dashboard', [HomeController::class, 'index'])->name('customer.home.index');
    // Vehicles Routes
    Route::get('/customer/vehicles', [VehicleController::class, 'index'])->name('customer.vehicles.index');
    Route::get('/customer/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('customer.vehicles.show');

    Route::get('/customer/vehicles_cost_analysis', [VehicleController::class, 'cost_analysis'])->name('customer.vehicles.cost_analysis');
    Route::get('/customer/vehicles_dateline', [VehicleController::class, 'dateline'])->name('customer.vehicles.dateline');
    Route::get('/customer/vehicles_summary', [VehicleController::class, 'summary'])->name('customer.vehicles.summary');

    // Invoice Routes
    Route::get('/customer/invoices', [InvoiceController::class, 'index'])->name('customer.invoices.index');
    Route::get('/customer/invoices/{invoice}', [InvoiceController::class, 'show'])->name('customer.invoices.show');

 });