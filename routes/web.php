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

/// Admin Contoller ///
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Logout Function Here //
Route::get('/logout', function (Request $request) {
    Session::flush();
    Auth::logout();
  
    return redirect()->route('welcome');
  })->name('logout');
// Logout Function Here //