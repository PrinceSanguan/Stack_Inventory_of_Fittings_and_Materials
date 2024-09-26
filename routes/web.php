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
Route::delete('/admin/dashboard/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.delete-category');

Route::get('/admin/record-day', [AdminController::class, 'recordDay'])->name('admin.record-day');
Route::get('/admin/record-week', [AdminController::class, 'recordWeek'])->name('admin.record-week');
Route::get('/admin/record-month', [AdminController::class, 'recordMonth'])->name('admin.record-month');

Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
Route::post('/admin/category', [AdminController::class, 'addCategory'])->name('admin.add-category');
});


// Logout Function Here //
Route::get('/logout', function (Request $request) {
    Session::flush();
    Auth::logout();
  
    return redirect()->route('welcome');
  })->name('logout');
// Logout Function Here //