<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CurriculumProgressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin_login_form');
Route::get('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm'])->name('admin_register_form');

Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin_login');
Route::post('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'adminRegister'])->name('admin_register');
Route::post('/admin/logout', [\App\Http\Controllers\Auth\LoginController::class, 'adminLogout'])->name('admin_logout');

Route::middleware('auth:admin')->group(
    function () {
        Route::get('/admin/top', [ArticleController::class, 'adminTop'])->name("admin_top");
    }
);
