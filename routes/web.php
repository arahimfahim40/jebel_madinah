<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view("auth/login");
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

require_once('admin_route.php');
require_once('customer_route.php');