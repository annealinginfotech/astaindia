<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\BillingController;

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
    return view('login');
})->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login-operation');

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::resource('/billing', BillingController::class);
    Route::get('/billing-print', [BillingController::class, 'savePrint'])->name('billing.save-print');
    Route::get('bill-receipt-download/{id}', [BillingController::class, 'downloadPayslip'])->name('download-payslip');
    Route::get('/bill-export/download', [BillingController::class, 'export'])->name('export.bill');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
