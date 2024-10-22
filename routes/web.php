<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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


// Welcome Page ///
Route::get('/', [LoginController::class, 'index'])->name('welcome');
Route::post('/', [LoginController::class, 'loginForm'])->name('login.form');


Route::middleware(['auth'])->group(function () {
/// Admin Contoller ///
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/dashboard', [AdminController::class, 'updateCategory'])->name('admin.update-category');
Route::delete('/admin/dashboard/delete/{id}/{category}', [AdminController::class, 'deleteCategory'])->name('admin.delete-category');

Route::get('/admin/purchase', [AdminController::class, 'purchase'])->name('admin.purchase');
Route::post('/admin/purchase/get-descriptions', [AdminController::class, 'getDescriptions']);
Route::post('/admin/purchase/get-item-details', [AdminController::class, 'getItemDetails']);

Route::post('/admin/purchase', [AdminController::class, 'addPurchase'])->name('admin.add-purchase');

Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
Route::post('/admin/category', [AdminController::class, 'addItem'])->name('admin.add-item');

Route::get('/admin/connection', [AdminController::class, 'connection'])->name('admin.connection');

Route::get('/admin/repair', [AdminController::class, 'repair'])->name('admin.repair');

Route::get('/admin/subsidy', [AdminController::class, 'subsidy'])->name('admin.subsidy');

Route::get('/admin/donation', [AdminController::class, 'donation'])->name('admin.donation');

Route::get('/admin/maintenance', [AdminController::class, 'maintenance'])->name('admin.maintenance');

Route::get('/admin/mswd', [AdminController::class, 'mswd'])->name('admin.mswd');

Route::get('/admin/accountable', [AdminController::class, 'accountable'])->name('admin.accountable');

Route::get('/admin/purchase-history', [AdminController::class, 'purchaseHistory'])->name('admin.purchase-history');
});


// Logout Function Here //
Route::get('/logout', function (Request $request) {
    Session::flush();
    Auth::logout();
  
    return redirect()->route('welcome');
  })->name('logout');
// Logout Function Here //