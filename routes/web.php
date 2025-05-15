<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TransactionAndTransferController;
use App\Http\Controllers\UserContoller;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('test');
});

// login
Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
  Route::post('/login', [LoginController::class, 'login']);
});
Route::middleware(['auth'])->post('/logout', [LoginController::class, 'logout'])->name('logout');


// admin routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
  Route::resource('branches', BranchController::class);
  Route::resource('employees', EmployeeController::class);
});


// employee routes
Route::middleware(['auth', 'isEmployee'])->prefix('employee')->name('employee.')->group(function () {
  Route::resource('customers', CustomerController::class);

  Route::get('/transfer', [TransactionAndTransferController::class, 'transfer'])->name('transfer');
  Route::get('/transaction', [TransactionAndTransferController::class, 'transaction'])->name('transaction');
  Route::post('/performTransfer', [TransactionAndTransferController::class, 'performTransfer'])->name('performTransfer');
  Route::post('/performTransaction', [TransactionAndTransferController::class, 'performTransaction'])->name('performTransaction');
});


// customer routes
Route::middleware(['auth', 'isCustomer'])->group(function () {
  Route::get('/customer', function () {
    return view('customer.index');
  })->name('customer.index');
});