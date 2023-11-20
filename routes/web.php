<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;

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
    return view('welcome');
});

Route::middleware('auth','admin')->prefix('admin')->group(function () {

Route::get('/dashboard',[ReportController::class,'dashboard'])->name('dashboard');
Route::get('/reports',[ReportController::class,'monthlyReport'])->name('report');

//-------------------------------payment-------------------------------------------
Route::get('/customers', [CustomerController::class,'index']);
//------------------------------transaction--------------------------------------------

Route::resource('transactions',TransactionController::class);
//-------------------------------payment-------------------------------------------

Route::resource('payments',PaymentController::class);
Route::get('payments/create/{transaction}',[PaymentController::class,'create_transaction_payment'])->name('create_transaction_payment');

});
//--------------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
